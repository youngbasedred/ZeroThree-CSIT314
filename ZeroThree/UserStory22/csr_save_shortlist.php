<?php
session_start();
require_once __DIR__ . '/Boundary/csrShortlistBoundary.php';

// assume CSR is logged in
$csrId = $_SESSION['user_id'];

$page = new csrShortlistBoundary();
$page->display($csrId);
?>
