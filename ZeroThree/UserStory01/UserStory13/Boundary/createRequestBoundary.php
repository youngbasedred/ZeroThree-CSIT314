<?php
require_once __DIR__ . '/../Controller/createRequestController.php';

// Hardcoded PIN user for demo
$userID = 11;

// When user submits the form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = [
        "title"          => $_POST['title'],
        "description"    => $_POST['description'],
        "category_id"    => $_POST['category_id'],
        "location"       => $_POST['location'],
        "preferred_date" => $_POST['preferred_date']
    ];

    $controller = new createRequestController();
    $result = $controller->createRequest($userID, $data);

    if (isset($result['error'])) {
        $errorMessage = $result['error'];
    } else {
        $successMessage = "Request Created Successfully! Request ID: " . $result['request_id'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Request</title>
</head>
<body>

<h2>Create Request</h2>

<?php if (!empty($errorMessage)): ?>
    <p style="color:red;"><?= $errorMessage ?></p>
<?php endif; ?>

<?php if (!empty($successMessage)): ?>
    <p style="color:green;"><?= $successMessage ?></p>
<?php endif; ?>

<form method="POST">

    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" required></textarea><br><br>

    <label>Category:</label><br>
    <select name="category_id" required>
        <option value="">-- Select Category --</option>
        <option value="1">Food Distribution</option>
        <option value="2">Elderly Care</option>
        <option value="3">Education Support</option>
        <option value="4">Environmental Cleanup</option>
        <option value="5">Healthcare Aid</option>
    </select><br><br>

    <label>Location:</label><br>
    <input type="text" name="location" required><br><br>

    <label>Preferred Date:</label><br>
    <input type="date" name="preferred_date" required><br><br>

    <button type="submit">Submit Request</button>

</form>

</body>
</html>
