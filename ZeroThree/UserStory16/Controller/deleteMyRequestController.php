<?php
require_once __DIR__ . '/../Entity/Request.php';

class deleteMyRequestController {

    public function loadUserRequests($userID) {
        $entity = new Request();
        return $entity->findByUserID($userID);
    }

    public function delete($requestID) {
        $entity = new Request();
        return $entity->deleteByID($requestID);
    }
}
?>
