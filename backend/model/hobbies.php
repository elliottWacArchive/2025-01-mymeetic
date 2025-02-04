<?php

// include '../include/db.php';
// include 'user.php';
class Hobbies extends User
{
    public function addHobbies($hobbies, $token) {
        $hobbies_user = $this->getHobbies($token);
            if (!in_array($hobbies, $hobbies_user)) {
                $sql = "INSERT INTO user_hobbies (id_user, id_hobbies) VALUES ((SELECT id FROM user WHERE token = :token), (SELECT id FROM hobbies WHERE name = :hobbies))";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':token', $token);
                $stmt->bindParam(':hobbies', $hobbies);
                $stmt->execute();
                return true;
            }
        return false;
    }

    public function getHobbies($token) {
        $hobbies = [];
        $sql = "SELECT * FROM user JOIN user_hobbies ON user.id = id_user JOIN hobbies ON id_hobbies = hobbies.id WHERE `token` = :token";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as $row) {
            $hobbies[] = $row['name'];
        }
        return $hobbies;
    }
}

// $Hobbies = new Hobbies();
// var_dump($Hobbies->getHobbies('60c40a32fed8a3d950378e1ab8c92b19'));
// var_dump($Hobbies->addHobbies('art', '60c40a32fed8a3d950378e1ab8c92b19'));
