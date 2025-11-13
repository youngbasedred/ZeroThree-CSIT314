<?php

if (!class_exists('Database')) {

    class Database
    {
        private $host   = "localhost";
        private $user   = "root";
        private $pass   = "";
        private $dbname = "zerothree";
        private $conn;

        public function getConnection()
        {
            // create connection
            $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

            // check connection
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }

            return $this->conn;
        }
    }
}
