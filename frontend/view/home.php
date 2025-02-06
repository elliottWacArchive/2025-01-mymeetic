
<?php
include 'backend/functions/checkIdentification.php';
?>

<head>
    <script src="backend/controller/search.js"></script>
    <script src="backend/controller/result.js"></script>
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
            <?php include 'frontend/widget/finishConfiguration.php' ?>
        </div>
    <?php include 'frontend/widget/footer.php' ?>
    </div>
</body>
