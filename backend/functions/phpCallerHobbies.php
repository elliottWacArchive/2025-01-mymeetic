<?php
include '../include/db.php';
include '../model/user.php';
include '../model/hobbies.php';

if (isset($_GET['function'])) {
    $function = $_GET['function'];
    $var = [];
    $hobbies = new Hobbies();
    foreach ($_GET as $key => $value) {
        if ($key != 'function') {
            array_push($var, $value);
        }
    }
    $result = call_user_func_array([$hobbies, $function], $var);
    echo json_encode(['result' => $result]);
}