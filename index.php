<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/':
        require __DIR__ . '/frontend/view/signin.php';
        break;
    case '':
        require __DIR__ . '/frontend/view/signin.php';
        break;
    case '/login':
        require __DIR__ . '/frontend/view/login.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/frontend/view/404.php';
        break;
}
