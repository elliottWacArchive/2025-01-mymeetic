
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
        <div id="search-section">
            <?php include 'frontend/widget/searchbar.php';?>
        </div>
        <div id="result-section">
            <?php echo 'welcome ' . $_COOKIE['username'];?>
            <?php include 'frontend/widget/logoutBtn.php'; ?>
        </div>
    <?php include 'frontend/widget/footer.php' ?>
    </div>
</body>
