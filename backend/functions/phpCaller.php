<?php

include '../include/db.php';
include '../model/user.php';

if (isset($_GET['function'])) {
    $function = $_GET['function'];
    $var = [];
    $user = new User();
    foreach ($_GET as $key => $value) {
        if ($key != 'function') {
            array_push($var, $value);
        }
    }
    $result = call_user_func_array([$user, $function], $var);
    echo json_encode(['result' => $result]);
}
