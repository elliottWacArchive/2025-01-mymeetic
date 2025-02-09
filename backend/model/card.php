<?php

// include '../include/db.php';
// include 'user.php';
// include 'hobbies.php';

class Card extends Database
{
    public $id;
    public $username;
    public $firstname;
    public $pp;
    public $age;
    public $city;
    public $hobbies;
    public $isLiked;
    public function __construct($id)
    {
        parent::__construct();
        $this->id = $id;
        $this->username = $this->getUserWithId($id, 'username');
        $this->firstname = $this->getUserWithId($id, 'firstname');
        $this->pp = $this->getUserWithId($id, 'pp');
        $this->age = $this->getUserWithId($id, 'age');
        $this->city = $this->getUserWithId($id, 'city');
        $this->hobbies = $this->getHobbiesWithId($id);
        $this->isLiked = $this->isLiked($_COOKIE['id'], $id);
    }

    private function getUserWithId($id, $param)
    {
        $sql = "SELECT * FROM `user` WHERE `id` = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result[$param];
    }

    private function getHobbiesWithId($id)
    {
        $hobbies = [];
        $sql = "SELECT * FROM user JOIN user_hobbies ON user.id = id_user 
        JOIN hobbies ON id_hobbies = hobbies.id WHERE `id_user` = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as $row) {
            $hobbies[] = $row['name'];
        }
        return $hobbies;
    }

    private function isLiked($userid, $likedid)
    {
        $sql = "SELECT * FROM `is_match` WHERE `id_user` = :userid AND `id_cible` = :likedid";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':userid', $userid);
        $stmt->bindParam(':likedid', $likedid);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
// $card = new Card(9);
// echo ($card->username . "\n" . $card->firstname . "\n" . $card->age . "\n" . $card->city . "\n");
