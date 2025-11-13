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

    /**
     * Get profile_name from user_profiles for a given profile_id.
     * This profile_name is what we'll store in users.role.
     */
    private function getProfileNameById(int $profile_id): ?string
    {
        $sql = "SELECT profile_name 
                FROM user_profiles 
                WHERE profile_id = :profile_id
                  AND profile_status = 'ACTIVE'
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':profile_id' => $profile_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && isset($row['profile_name'])) {
            return $row['profile_name'];
        }

        return null;
    }

    /**
     * Return all active user profiles for the dropdown.
     */
    public function getActiveProfiles(): array
    {
        $sql = "SELECT profile_id, profile_name
            FROM user_profiles
            WHERE profile_status = 'ACTIVE'
            ORDER BY profile_name ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Create a new user account.
     * Boundary → Controller → Entity → DB
     */
    public function createUserAccount(
        string $username,
        string $password,
        string $email,
        string $phone,
        int $profile_id
    ): bool {
        // 1. Look up the profile name for this profile_id
        $profileName = $this->getProfileNameById($profile_id);

        if ($profileName === null) {
            // Invalid or inactive profile
            return false;
        }

        // 2. Use the profile name directly as the role
        $role = $profileName;

        $sql = "INSERT INTO users (
                    profile_id,
                    username,
                    role,
                    password,
                    email,
                    phone,
                    status
                )
                VALUES (
                    :profile_id,
                    :username,
                    :role,
                    :password,
                    :email,
                    :phone,
                    'ACTIVE'
                )";

        $stmt = $this->conn->prepare($sql);

        try {
            return $stmt->execute([
                ':profile_id' => $profile_id,
                ':username'   => $username,
                // for a real app, hash the password:
                // ':password' => password_hash($password, PASSWORD_DEFAULT),
                ':role'       => $role,
                ':password'   => $password,
                ':email'      => $email,
                ':phone'      => $phone,
            ]);
        } catch (PDOException $e) {
            // error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Check if an email already exists in users table.
     */
    public function emailExists(string $email): bool
    {
        $sql = "SELECT 1 FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        return (bool) $stmt->fetchColumn();
    }
}
