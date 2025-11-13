<?php
session_start();
require_once 'database.php';

// If user already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$message = "";

// ----- DB connection (used for both GET + POST) -----
$db   = new Database();
$conn = $db->getConnection();

// ----- Load ALL profiles for dropdown -----
$profiles = [];
$resultProfiles = $conn->query("SELECT profile_id, profile_name, profile_status FROM user_profiles");
if ($resultProfiles) {
    $profiles = $resultProfiles->fetch_all(MYSQLI_ASSOC);
}

// ----- Handle login -----
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username       = trim($_POST['username']);
    $password       = trim($_POST['password']);
    $selectedProfileId = isset($_POST['profile_id']) ? (int)$_POST['profile_id'] : 0;

    if ($username === '' || $password === '' || $selectedProfileId <= 0) {
        $message = "❌ Please enter username, password, and select a profile.";
    } else {
        // Join users + user_profiles so we can check BOTH statuses
        $sql = "
            SELECT 
                u.user_id,
                u.username,
                u.password,
                u.role,
                u.status,
                u.profile_id,
                p.profile_name,
                p.profile_status
            FROM users u
            INNER JOIN user_profiles p ON u.profile_id = p.profile_id
            WHERE u.username = ? AND p.profile_id = ?
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $username, $selectedProfileId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // 🚫 1) Block suspended user account
            if (strtoupper($user['status']) !== 'ACTIVE') {
                $message = "❌ This account has been suspended. Please contact a User Admin.";
            }
            // 🚫 2) Block suspended profile (all users in that profile)
            elseif (strtoupper($user['profile_status']) !== 'ACTIVE') {
                $message = "❌ This user profile has been suspended. Please contact a User Admin.";
            }
            // ✅ 3) Password OK and both statuses ACTIVE
            elseif ($password === $user['password']) {   // use password_verify() if you hash later
                // Set session
                $_SESSION['user_id']   = $user['user_id'];
                $_SESSION['username']  = $user['username'];
                $_SESSION['role']      = $user['role'];
                $_SESSION['profile_id'] = $user['profile_id'];

                // Redirect (you can switch on $user['profile_name'] or $user['role'])
                header("Location: dashboard.php");
                exit();
            } else {
                $message = "❌ Incorrect password.";
            }
        } else {
            $message = "❌ No such user found for this profile.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - CSIT314</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            text-align: center;
            margin-top: 100px;
        }

        form {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            display: inline-block;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        input,
        select {
            margin: 10px;
            padding: 10px;
            width: 220px;
        }

        button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .msg {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h2>CSIT314 Login</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>

        <!-- dynamic profile dropdown -->
        <select name="profile_id" required>
            <option value="">-- Select User Profile --</option>
            <?php foreach ($profiles as $profile): ?>
                <option value="<?= $profile['profile_id']; ?>">
                    <?= htmlspecialchars($profile['profile_name']); ?>
                    <?php if (strtoupper($profile['profile_status']) !== 'ACTIVE'): ?>

                    <?php endif; ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <button type="submit">Login</button>
    </form>
    <div class="msg"><?= htmlspecialchars($message) ?></div>
</body>

</html>