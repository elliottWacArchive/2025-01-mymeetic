<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="frontend/css/style.css">
    <link rel="stylesheet" href="frontend/css/fonts.css">
    <script src="backend/controller/cookie.js" defer></script>
    <link rel="icon" href="frontend/img/icon.png" type="image/x-icon">
</head>
<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/':
        require __DIR__ . '/frontend/view/login.php';
        break;
    case '/home':
        require __DIR__ . '/frontend/view/home.php';
        break;
    case '/login':
        require __DIR__ . '/frontend/view/login.php';
        break;
    case '/inscription':
        require __DIR__ . '/frontend/view/signup.php';
        break;
    case '/settings':
        require __DIR__ . '/frontend/view/settings.php';
        break;
    case '/messages':
        require __DIR__ . '/frontend/view/messages.php';
        break;
    default:
        require __DIR__ . '/frontend/view/404.php';
        break;
}

?>

</html>
