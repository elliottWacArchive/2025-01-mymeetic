<?php

class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "auguste007";
    private $dbname = "my_meetic";
    public $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "PDO : Connected successfully\n";
        } catch (PDOException $e) {
            echo "PDO : Connection failed: " . $e->getMessage() . "\n";
        }
    }
}
