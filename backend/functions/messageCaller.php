<?php

include '../include/db.php';
include '../model/messages.php';

if (isset($_GET['function'])) {
    $function = $_GET['function'];
    $var = [];
    $messages = new Messages();

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

    $result = call_user_func_array([$messages, $function], $var);
    echo json_encode(['result' => $result]);
}
