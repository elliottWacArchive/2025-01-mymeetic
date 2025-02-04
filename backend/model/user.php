<?php

// include '../include/db.php';

class User extends Database
{
    public function addUser($username, $firstname, $lastname, $mail, $password, $birthdate, $city, $gender)
    {
        $password = $this->hashPassword($password);
        $sql = "INSERT INTO `user` 
			(`id`, `username`, `firstname`, `lastname`, `mail`, `password`, `birthdate`, `city`, `gender`, `token`) 
			VALUES (NULL, :username, :firstname, :lastname, :mail, :password, :birthdate, :city, :gender, :token)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':birthdate', $birthdate);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':token', $this->createToken());
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getUser($token, $param)
    {
        $sql = "SELECT * FROM `user` WHERE `token` = :token";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result[$param];
    }

    public function login($mail, $password)
    {
        $output = [];
        if ($this->mailExist($mail)) {
            $sql = "SELECT * FROM `user` WHERE `mail` = :mail";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':mail', $mail);
            $stmt->execute();
            $result = $stmt->fetch();
            if ($this->verifyPassword($password, $result['password'])) {
                if ($this->isActive($result['token'])) {
                    $output['result'] = $result['token'];
                } else {
                    $output['result'] = false;
                    $output['error'] = "disable account";
                }
            } else {
                $output['result'] = false;
                $output['error'] = "password";
            }
        } else {
            $output['result'] = false;
            $output['error'] = "mail";
        }
        return $output;
    }

    public function createToken()
    {
        $token = bin2hex(random_bytes(16));
        return $token;
    }

    public function isToken($token)
    {
        $sql = "SELECT * FROM `user` WHERE `token` = :token";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getToken($id)
    {
        $sql = "SELECT `token` FROM `user` WHERE `id` = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['token'];
    }


    public function isActive($token)
    {
        $sql = "SELECT * FROM `user` WHERE `token` = :token";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result['active'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteAccount($token)
    {
        if ($this->isActive($token)) {
            $sql = "UPDATE `user` SET `active` = 0 WHERE `token` = :token";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':token', $token);
            if ($stmt->execute()) {
                return true;
            }
        }
        return false;
    }

    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function verifyPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
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

// $user = new User();
// $user->deleteAccount('60c40a32fed8a3d950378e1ab8c92b19');