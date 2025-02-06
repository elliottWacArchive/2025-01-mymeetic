<?php

include '../include/db.php';
include '../model/user.php';
include '../model/hobbies.php';

$hobbies = new Hobbies();
$allHobbies = $hobbies->listHobbies();
echo (json_encode($allHobbies));