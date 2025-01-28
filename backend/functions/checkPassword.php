<?php

include '../include/db.php';
include '../model/user.php';

// $elliott = new User();
// $elliott->addUser('kk', 'kk', 'Ramet', 'cc@fr.cc', '1234', '1999-07-07', 'mtp', 'male');

if (isset($_GET['mail'], $_GET['password'])) {
    $mail = $_GET['mail'];
    $password = $_GET['password'];
    $user = new User();
    $result = $user->checkPassword($mail, $password);
    echo json_encode(['result' => $result]);
}

// $user = new User();
// $result = $user->checkPassword('elliott.ramet@nugget.fr', 'azerty42');
// echo ($result);
