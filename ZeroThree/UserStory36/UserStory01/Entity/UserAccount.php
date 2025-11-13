<?php

require_once __DIR__ . '/../Database.php';

class UserAccount
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function createUserAccount(
        string $username,
        string $password,
        string $email,
        string $phone,
        int $profile_id
    ): bool {

        $sql = "INSERT INTO users (profile_id, username, password, email, phone, status)
            VALUES (:profile_id, :username, :password, :email, :phone, 'ACTIVE')";

        $stmt = $this->conn->prepare($sql);

        try {
            return $stmt->execute([
                ':profile_id' => $profile_id,
                ':username'   => $username,
                ':password'   => $password,
                ':email'      => $email,
                ':phone'      => $phone,
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }


    public function emailExists(string $email): bool
    {
        $sql = "SELECT 1 FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        return (bool) $stmt->fetchColumn();
    }
}
