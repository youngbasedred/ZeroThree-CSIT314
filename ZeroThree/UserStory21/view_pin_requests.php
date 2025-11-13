<?php
require_once __DIR__ . '/Controller/ViewPINRequestsController.php';

// Simulate CSR logged into the system
$controller = new ViewPINRequestsController();
$controller->showPINRequests();
?>
