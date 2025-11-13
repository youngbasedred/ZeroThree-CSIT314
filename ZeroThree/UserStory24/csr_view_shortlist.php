<?php
require_once 'Controller/csrviewShortlistController.php';

// Example: CSR with user_id = 41
$csrID = 41;

$controller = new CSRShortlistController();
$controller->listShortlist($csrID);
?>
