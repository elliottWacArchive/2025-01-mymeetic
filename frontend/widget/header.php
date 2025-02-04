<div id="header">
    <img id="logo" src="frontend/img/miku-logo.png" alt="" draggable="false">
    <div id="title">MeetVocaloid!</div>
    <div id="profile-container">
        <img id="profile" src="backend/storage/pp/default.jpg">
        <div class="list">
            <?php echo "<div id='username'>" . $_COOKIE['username'] . "</div>" ?> 
            <div id="param">Paramètres</div>
            <?php include 'frontend/widget/logoutBtn.php'; ?>
        </div>
    </div>
</div>