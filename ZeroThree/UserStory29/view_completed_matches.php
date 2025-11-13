<?php
require_once 'Controller/HistoricalMatchesController.php';

// simulate logged-in PIN user (example: user_id = 11)
$userID = 11;

$controller = new HistoricalMatchesController();
$controller->showHistory($userID);
