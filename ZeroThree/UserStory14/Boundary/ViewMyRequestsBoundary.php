<?php
require_once __DIR__ . '/../Controller/ViewMyRequestsController.php';

// Hardcode PIN user (like your test accounts)
$userID = 11;

$controller = new ViewMyRequestsController();
$requests = $controller->showMyRequests($userID);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Requests</title>
</head>
<body>

<h2>My Requests</h2>

<?php if (empty($requests)): ?>

    <p>No requests found.</p>

<?php else: ?>

    <table border="1" cellpadding="10">
        <tr>
            <th>Request ID</th>
            <th>Category</th>
            <th>Title</th>
            <th>Description</th>
            <th>Location</th>
            <th>Preferred Date</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>

        <?php foreach ($requests as $req): ?>
        <tr>
            <td><?= $req['request_id'] ?></td>
            <td><?= $req['category_name'] ?></td>
            <td><?= $req['title'] ?></td>
            <td><?= $req['description'] ?></td>
            <td><?= $req['location'] ?></td>
            <td><?= $req['preferred_date'] ?></td>
            <td><?= $req['status'] ?></td>
            <td><?= $req['created_at'] ?></td>
        </tr>
        <?php endforeach; ?>

    </table>

<?php endif; ?>

</body>
</html>
