<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profilePicture'])) {
    include '../include/db.php';
    include '../model/user.php';
    $res = [];
    $res["return"] = false;
    $target_dir = "../storage/pp/";
    $cookie_id = isset($_COOKIE['id']) ? $_COOKIE['id'] : die();
    $target_file = $target_dir . basename($_FILES["profilePicture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // le fichier est une image réelle
    $check = getimagesize($_FILES["profilePicture"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $res["echo"] = "Le fichier n'est pas une image!";
        $uploadOk = 0;
    }

    // taille du fichier
    if ($_FILES["profilePicture"]["size"] > 500000) {
        $res["echo"] = "La taille de l'image est trop large!";
        $uploadOk = 0;
    }

    // formats de fichiers
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $res["echo"] = "Seulements les fichiers JPG, JPEG, PNG et GIF sont supportés!";
        $uploadOk = 0;
    }

    // verif d'erreurs
    if ($uploadOk == 0) {
        $res["echo"] = "Votre fichier n'a pas été envoyé!";
    } else {
        $src = null;
        if ($imageFileType == 'jpg' || $imageFileType == 'jpeg') {
            $src = imagecreatefromjpeg($_FILES["profilePicture"]["tmp_name"]);
        } elseif ($imageFileType == 'png') {
            $src = imagecreatefrompng($_FILES["profilePicture"]["tmp_name"]);
        } elseif ($imageFileType == 'gif') {
            $src = imagecreatefromgif($_FILES["profilePicture"]["tmp_name"]);
        }

        if ($src) {
            $width = imagesx($src);
            $height = imagesy($src);
            $size = min($width, $height);
            $dst = imagecreatetruecolor($size, $size);
            $target_file = $target_dir . $cookie_id . '.jpg';
            imagecopyresampled($dst, $src, 0, 0, ($width - $size) / 2, ($height - $size) / 2, $size, $size, $size, $size);
            imagejpeg($dst, $target_file);

            imagedestroy($src);
            imagedestroy($dst);

            $filename = $cookie_id . '.jpg';
            $token = $_COOKIE['token'];
            $user = new User();
            $result = $user->setUser($token, "pp", $filename);
            if ($result) {
                $res["echo"] = "Votre photo de profil a été mise à jour!";
                $res["return"] = true;
            } else {
                $res["echo"] = "Oups! Une erreur est survenue!";
            }
        } else {
            $res["echo"] = "Oups! Une erreur est survenue!";
        }
    }
    echo json_encode($res);
}
