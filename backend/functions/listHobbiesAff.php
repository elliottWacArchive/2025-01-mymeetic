<?php

include 'backend/model/hobbies.php';

$hobbies = new Hobbies();
$allHobbies = $hobbies->listHobbies();
foreach ($allHobbies as $hobby) {
    echo '<div class="select" value=' . $hobby['id'] . '>' . $hobby['name'] . '</div>';
}
