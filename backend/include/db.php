<?php

class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $pwd = "auguste007";
    private $dbname = "my_meetic";
    public $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->pwd);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // echo "PDO : Connected successfully\n";
        } catch (PDOException $e) {
            echo "PDO : Connection failed: " . $e->getMessage() . "\n";
        }
    }
}

// new Database();
