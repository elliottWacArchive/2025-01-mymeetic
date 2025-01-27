<?php

class User extends Database
{
    public function addUser($username, $firstname, $lastname, $mail, $password, $birthdate, $city, $gender)
    {
        $sql = "INSERT INTO `user` 
			(`id`, `username`, `firstname`, `lastname`, `mail`, `password`, `birthdate`, `city`, `gender`) 
			VALUES (NULL, :username, :firstname, :lastname, :mail, :password, :birthdate, :city, :gender)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':birthdate', $birthdate);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':gender', $gender);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function mailExist($mail)
    {
        $sql = "SELECT * FROM `user` WHERE `mail` = :mail";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function usernameExist($username)
    {
        $sql = "SELECT * FROM `user` WHERE `username` = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
// $elliott = new User();
// $elliott->addUser('liotou', 'Elliott', 'Ramet', 'cc@fr.cc', '1234', '1999-07-07', 'mtp', 'male');
