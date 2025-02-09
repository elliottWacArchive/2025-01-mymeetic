<div id="header">
    <img id="logo" src="frontend/img/miku-logo.png" alt="" draggable="false">
    <div id="title" onclick="href('/home')">MeetVocaloid!</div>
    <div id="profile-container">
        <div class="list">
            <?php echo "<div id='username'>" . $_COOKIE['username'] . "</div>" ?> 
            <div id="param" onclick="href('/settings')">Paramètres</div>
            <?php include 'frontend/widget/logoutBtn.php'; ?>
        </div>
        <?php include 'frontend/widget/profilePicture.php' ?>
        <!-- <img id="profile" src="backend/storage/pp/default.jpg"> -->
    </div>
</div>
<script defer src="backend/controller/header.js"></script>