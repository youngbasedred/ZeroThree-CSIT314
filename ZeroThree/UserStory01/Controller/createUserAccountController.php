<?php

require_once __DIR__ . '/../Entity/UserAccount.php';

class createUserAccountController
{
    private $userAccount;

    public function __construct()
    {
        $this->userAccount = new UserAccount();
    }

    /**
     * Create a new user account.
     */
    public function createUserAccount(
        string $username,
        string $password,
        string $email,
        string $phone,
        int $profile_id
    ): bool {
        // Basic validation example
        if (empty($username) || empty($password) || empty($email) || $profile_id === 0) {
            return false;
        }

        // Prevent duplicate emails
        if ($this->userAccount->emailExists($email)) {
            return false;
        }

        // Controller → Entity
        return $this->userAccount->createUserAccount(
            $username,
            $password,
            $email,
            $phone,
            $profile_id
        );
    }

    /**
     * Get all active profiles for the dropdown.
     * Boundary → Controller → Entity
     */
    public function getActiveProfiles(): array
    {
        return $this->userAccount->getActiveProfiles();
    }

    /**
     * Expose email check if boundary wants to call it.
     */
    public function emailExists(string $email): bool
    {
        return $this->userAccount->emailExists($email);
    }
}
