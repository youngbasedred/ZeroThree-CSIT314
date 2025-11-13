<?php
require_once __DIR__ . '/Boundary/deleteMyRequestBoundary.php';

$userID = 11; // your PIN user

$boundary = new deleteMyRequestBoundary();
$boundary->display($userID);
?>
