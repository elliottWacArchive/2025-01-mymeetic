<?php

include '../include/db.php';
include '../model/user.php';

if (isset($_GET['function'])) {
    $function = $_GET['function'];
    $var = [];
    $user = new User();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        // file_put_contents('input_log.txt', print_r($input, true), FILE_APPEND);
        if ($input) {
            foreach ($input as $key => $value) {
                array_push($var, $value);
            }
        }
    } else {
        foreach ($_GET as $key => $value) {
            if ($key != 'function') {
                array_push($var, $value);
            }
        }
    }

    $result = call_user_func_array([$user, $function], $var);
    echo json_encode(['result' => $result]);
}
