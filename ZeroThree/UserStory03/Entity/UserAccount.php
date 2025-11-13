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

    public function updateUserAccount(string $email, string $field, string $newValue): bool
    {

        $allowedFields = ['username', 'phone', 'status', 'password', 'email', 'role'];
        if (!in_array($field, $allowedFields, true)) {
            return false;
        }


        $sql = "UPDATE users SET $field = ? WHERE email = ?";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return false;
        }


        $stmt->bind_param('ss', $newValue, $email);

        if (!$stmt->execute()) {
            return false;
        }

        return true;
    }
}
