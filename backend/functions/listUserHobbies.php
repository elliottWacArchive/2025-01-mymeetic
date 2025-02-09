<?php

function getHobbies($id)
{
    $card = new Card($id);
    $hobbies = $card->hobbies;
    $hobbies = implode(', ', $hobbies);
    echo $hobbies;
}
