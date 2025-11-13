<?php
require_once __DIR__ . '/Boundary/updateMyRequestBoundary.php';

$userID = 11; // Your PIN user

$boundary = new updateMyRequestBoundary();
$boundary->displayUpdateRequest($userID);
?>
