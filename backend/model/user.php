<?php

// include '../include/db.php';
class User extends Database
{
    public function addUser($username, $firstname, $lastname, $mail, $password, $birthdate, $age, $city, $gender)
    {
        $password = $this->hashPassword($password);
        $sql = "INSERT INTO `user` 
			(`id`, `username`, `firstname`, `lastname`, `mail`, `password`, `birthdate`, `age`, `city`, `gender`, `token`) 
			VALUES (NULL, :username, :firstname, :lastname, :mail, :password, :birthdate, :age, :city, :gender, :token)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':birthdate', $birthdate);
        $stmt->bindParam(':age', $age);
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

    public function setUser($token, $param, $value)
    {
        $sql = "UPDATE `user` SET `$param` = :value WHERE `token` = :token";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':token', $token);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function search($input)
    {
        $input = json_decode($input, true);
        $city = $this->stringify($input, 'city');
        $gender = $this->stringify($input, 'gender');
        $age = $input['age'];
        $hobbies = $this->stringify($input, 'hobbies');
        $username = $this->stringify($input, 'username');
        $sql = "SELECT DISTINCT user.* FROM user LEFT JOIN user_hobbies ON user.id = id_user";
        $conditions = [];
        if (!empty($city)) {
            $conditions[] = "city IN ('$city')";
        }
        if (!empty($gender)) {
            $conditions[] = "gender IN ('$gender')";
        }
        if (!empty($age)) {
            if (in_array(46, $age)) {
                $conditions[] = "age > 45";
                $txt = "age > 45";
                if (count($age) > 1) {
                    $age = array_diff($age, [46]);
                    $age = implode("','", $age);
                    $txt .= " OR age IN ('$age')";
                }
                $conditions[] = $txt;
            } else {
                $conditions[] = "age IN ('$age')";
            }
        }
        if (!empty($hobbies)) {
            $conditions[] = "id_hobbies IN ('$hobbies')";
        }
        if (!empty($username)) {
            $conditions[] = "username LIKE '$username'";
        }
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }
        $sql .= " AND active = 1 AND user.id != :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $_COOKIE['id']);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $ids = [];
        foreach ($result as $row) {
            $ids[] = $row['id'];
        }
        return $ids;
    }

    function stringify($input, $key)
    {
        $tab = $input[$key];
        $output = implode("','", array_map('addslashes', $tab));
        return ($output);
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
// // $user->deleteAccount('60c40a32fed8a3d950378e1ab8c92b19');
// var_dump($user->search('{"city":["lyon"],"gender":[],"hobbies":[],"age":[],"username":[]}'));