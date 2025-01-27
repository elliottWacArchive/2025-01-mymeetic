<?php

include '../include/db.php';
include '../model/user.php';

// $elliott = new User();
// $elliott->addUser('kk', 'kk', 'Ramet', 'cc@fr.cc', '1234', '1999-07-07', 'mtp', 'male');

if (isset($_GET['mail'], $_GET['username'], $_GET['password'], $_GET['firstname'], $_GET['lastname'], $_GET['birthdate'], $_GET['city'], $_GET['gender'])) {
    $mail = $_GET['mail'];
    $username = $_GET['username'];
    $password = $_GET['password'];
    $firstname = $_GET['firstname'];
    $lastname = $_GET['lastname'];
    $birthdate = $_GET['birthdate'];
    $city = $_GET['city'];
    $gender = $_GET['gender'];
    $user = new User();
    $result = $user->addUser($username, $firstname, $lastname, $mail, $password, $birthdate, $city, $gender);
    echo json_encode(['result' => $result]);
}
