<?php

require_once __DIR__ . '/../Controller/createUserAccountController.php';

$controller  = new createUserAccountController();
$message     = '';
$messageType = ''; // 'success' or 'error'

// default form values for repopulation
$username   = '';
$email      = '';
$phone      = '';
$profile_id = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username   = trim($_POST['username'] ?? '');
    $password   = trim($_POST['password'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $phone      = trim($_POST['phone'] ?? '');
    $profile_id = (int)($_POST['profile_id'] ?? 0);

    if ($username === '' || $password === '' || $email === '' || $profile_id === 0) {
        $message = 'All required fields must be filled in.';
        $messageType = 'error';
    } else {
        if ($controller->emailExists($email)) {
            $message = 'Email already exists. Please use a different email.';
            $messageType = 'error';
        } else {
            $success = $controller->createUserAccount(
                $username,
                $password,
                $email,
                $phone,
                $profile_id
            );

            if ($success) {
                $message = 'User account created successfully.';
                $messageType = 'success';
                // clear form
                $username   = '';
                $email      = '';
                $phone      = '';
                $profile_id = 0;
            } else {
                $message = 'Failed to create user account. Please try again.';
                $messageType = 'error';
            }
        }
    }
}

// Boundary → Controller → Entity to get profiles for dropdown
$profiles = $controller->getActiveProfiles();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create User Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 480px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .message {
            padding: 10px;
            margin-bottom: 15px;
        }

        .message.success {
            background-color: #d2ffd2;
            border: 1px solid #00aa00;
        }

        .message.error {
            background-color: #ffd2d2;
            border: 1px solid #aa0000;
        }

        label {
            display: block;
            margin-top: 8px;
        }

        input,
        select {
            width: 100%;
            padding: 6px;
            margin-top: 4px;
            box-sizing: border-box;
        }

        button {
            margin-top: 15px;
            padding: 8px 16px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Create User Account</h2>

        <?php if ($message !== ''): ?>
            <div class="message <?php echo htmlspecialchars($messageType); ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <label for="username">Username:</label>
            <input
                type="text"
                id="username"
                name="username"
                required
                value="<?php echo htmlspecialchars($username); ?>">

            <label for="password">Password:</label>
            <input
                type="password"
                id="password"
                name="password"
                required>

            <label for="email">Email:</label>
            <input
                type="email"
                id="email"
                name="email"
                required
                value="<?php echo htmlspecialchars($email); ?>">

            <label for="phone">Phone:</label>
            <input
                type="text"
                id="phone"
                name="phone"
                value="<?php echo htmlspecialchars($phone); ?>">

            <label for="profile_id">Role / Profile:</label>
            <select id="profile_id" name="profile_id" required>
                <option value="">-- Select Role --</option>
                <?php foreach ($profiles as $profile): ?>
                    <option
                        value="<?php echo (int)$profile['profile_id']; ?>"
                        <?php echo ($profile_id == (int)$profile['profile_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($profile['profile_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Create User Account</button>
        </form>
    </div>
</body>

</html>