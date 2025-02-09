<?php

include '../include/db.php';
include '../model/user.php';

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    if ($input) {
        $result = $user->search($input);
        echo json_encode(['result' => $result]);
    }
}
