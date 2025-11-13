<?php
require_once __DIR__ . '/../Entity/Request.php';

class updateMyRequestController {

    public function update($requestID, $data) {

        $errors = [];
        if (empty($data['title']))        $errors[] = "Title is required.";
        if (empty($data['description']))  $errors[] = "Description is required.";
        if (empty($data['location']))     $errors[] = "Location is required.";
        if (empty($data['category_id']))  $errors[] = "Category is required.";
        if (empty($data['preferred_date'])) $errors[] = "Preferred date is required.";

        if (!empty($errors)) {
            return ["success" => false, "errors" => $errors];
        }

        $entity = new Request();
        $result = $entity->update($requestID, $data);

        if ($result !== null) {
            return ["success" => true, "request_id" => $result];
        }

        return ["success" => false, "errors" => ["Failed to update request."]];
    }

    public function loadRequest($requestID) {
        $entity = new Request();
        return $entity->findByID($requestID);
    }

    public function loadUserRequests($userID) {
        $entity = new Request();
        return $entity->findByUserID($userID);
    }
}
?>
