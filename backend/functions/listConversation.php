<?php

    require '../include/db.php';
    require '../model/card.php';

if (isset($_GET['id']) && isset($_GET['user1']) && isset($_GET['user2'])) {
    $id = $_GET['id'];
    $user1 = $_GET['user1'];
    $user2 = $_GET['user2'];

    if ($user1 == $_COOKIE['id']) {
        $cible = $user2;
    } else {
        $cible = $user1;
    }
}
    $cible = new Card($cible);
    echo "<div class='conv' id='" . $id . "' onclick='openConversation(" . $id . ")'>" . $cible->username . "</div>";
