<?php

include '../include/db.php';
include '../model/user.php';

if (isset($_GET['mail'])) {
    $mail = $_GET['mail'];
    $user = new User();
    $result = $user->mailExist($mail);
    echo json_encode(['result' => $result]);
}
