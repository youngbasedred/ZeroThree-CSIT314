<?php
require_once 'Controller/SearchMyRequestsController.php';

// Simulate logged-in PIN user (e.g. user_id = 11)
$userID = 11;

$controller = new SearchMyRequestsController();
$controller->search($userID);
?>
