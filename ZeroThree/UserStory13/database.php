<?php
class Database {
    private $host = "localhost";
    private $dbname = "zerothree";
    private $username = "root";
    private $password = "";

    public function getConnection() {
        try {
            $conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->username,
                $this->password
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;

        } catch (PDOException $e) {
            die("Database Connection Error: " . $e->getMessage());
        }
    }
}
?>
