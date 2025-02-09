<?php

class Messages extends Database
{
    public function getConversations($id)
    {
        $sql = "SELECT * FROM `conversation` WHERE `user1` = :id1 OR `user2` = :id2";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id1', $id);
        $stmt->bindParam(':id2', $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function issetConversation($user1, $user2)
    {
        $tab = $this->getConversations($user1);
        if ($tab == []) {
            return false;
        } else {
            foreach ($tab as $conversation) {
                if ($conversation['user1'] == $user1 && $conversation['user2'] == $user2) {
                    return true;
                }
                if ($conversation['user1'] == $user2 && $conversation['user2'] == $user1) {
                    return true;
                }
            }
            return false;
        }
    }

    public function getMessages($id)
    {
        $sql = "SELECT * FROM `message` WHERE `conversation` = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function sendMessage($userid, $id, $message)
    {
        $sql = "INSERT INTO `message` (`id`, `conversation`, `sender`, `message`)
        VALUES (NULL, :id, :userid, :message)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':userid', $userid);
        $stmt->bindParam(':message', $message);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function createConversation($user1, $user2)
    {
        $isset = $this->issetConversation($user1, $user2);
        if ($isset) {
            return false;
        }
        $sql = "INSERT INTO `conversation` (`id`, `user1`, `user2`) VALUES (NULL, :user1, :user2)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user1', $user1);
        $stmt->bindParam(':user2', $user2);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
