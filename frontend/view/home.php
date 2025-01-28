
<?php
include 'backend/include/db.php';
include 'backend/model/user.php';

if (isset($_COOKIE['token'])) {
    $token = $_COOKIE['token'];
    $user = new User();
    $result = $user->isToken($token);
    if (!$result) {
        header('Location: /');
    }
} else {
    header('Location: /');
}
?>

<head>
    <title>Home</title>
</head>
<body>
    welcome <?php echo $_COOKIE['username']; ?>
    <?php include 'frontend/widget/logoutBtn.php'; ?>
</body>
