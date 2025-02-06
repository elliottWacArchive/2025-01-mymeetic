<?php

include '../include/db.php';
include '../model/user.php';

// $elliott = new User();
// $elliott->addUser('kk', 'kk', 'Ramet', 'cc@fr.cc', '1234', '1999-07-07', 'mtp', 'male');

if (isset($_GET['token'], $_GET['param'], $_GET['value'])) {
    $token = $_GET['token'];
    $param = $_GET['param'];
    $value = $_GET['value'];
    $user = new User();
    $result = $user->setUser($token, $param, $value);
    echo json_encode(['result' => $result]);
}