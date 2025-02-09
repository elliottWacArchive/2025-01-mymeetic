<?php
    require '../include/db.php';
    require '../model/card.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

    $user = new Card($id);
?>
<div class="user-card">
    <div class="pp-container">
        <?php echo "<img src='backend/storage/pp/" . $user->pp . "'>"; ?>
    </div>
    <div class="info-container">
        <div class="username">
            <?php echo $user->username; ?>
        </div>
        <div class="firstname">
            <?php echo $user->firstname; ?>
        </div>
        <div class="age">
            <?php echo $user->age; ?> ans
        </div>
        <div class="city">
            <?php echo $user->city; ?>
        </div>
        <div class="hobbies">
            <?php
                $hobbies = $user->hobbies;
            foreach ($hobbies as $hobby) {
                echo "<div class='hobbies-item'>" . $hobby . "</div>";
            }
            ?>
        </div>
        <div class="interact">
            <?php echo "<div class='like' onclick='like(" . $id . ")'>"; ?>
                <?php
                if ($user->isLiked) {
                    echo "<img src='frontend/img/liked.min.svg' id='likeImg-" . $id . "' alt=''>";
                } else {
                    echo "<img src='frontend/img/like.svg' id='likeImg-" . $id . "' alt=''>";
                }
                ?>
            </div>
            <?php echo "<div class='message' onclick='openConversation(" . $id . ")'>"; ?>
                <img src="frontend/img/message.svg" alt="">
            </div>
        </div>
    </div>
</div>