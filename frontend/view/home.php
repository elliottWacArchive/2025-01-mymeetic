
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
    <script src="backend/controller/search.js"></script>
    <title>Home</title>
</head>
<body>
    <?php include 'frontend/widget/header.php' ?>
    <div id="center">
    <?php
        echo 'welcome ' . $_COOKIE['username'];
    ?>
    <?php include 'frontend/widget/logoutBtn.php'; ?>
    <?php include 'frontend/widget/footer.php' ?>
    </div>
</body>
