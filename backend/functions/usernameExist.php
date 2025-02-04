<?php

include '../include/db.php';
include '../model/user.php';

if (isset($_GET['username'])) {
    $mail = $_GET['username'];
    $user = new User();
    $result = $user->usernameExist($mail);
    echo json_encode(['result' => $result]);
}
