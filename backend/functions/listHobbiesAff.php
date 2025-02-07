<?php

include 'backend/model/hobbies.php';

$hobbies = new Hobbies();
$allHobbies = $hobbies->listHobbies();
foreach ($allHobbies as $hobby) {
    echo '<div class="select" id=' . $hobby['id'] . '>' . $hobby['name'] . '</div>';
}
