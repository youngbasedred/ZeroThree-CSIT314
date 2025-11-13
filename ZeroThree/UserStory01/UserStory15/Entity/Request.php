<?php
require_once __DIR__ . '/../database.php';

class Request {

    // Get all requests by PIN for dropdown
    public function findByUserID($userID) {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "SELECT * FROM requests WHERE pin_user_id = :uid ORDER BY created_at DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':uid', $userID);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get one request
    public function findByID($requestID) {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "SELECT * FROM requests WHERE request_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $requestID);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a request
    public function update($requestID, $data) {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "UPDATE requests SET
                    title = :title,
                    description = :description,
                    location = :location,
                    preferred_date = :preferred_date,
                    category_id = :category_id,
                    updated_at = NOW()
                WHERE request_id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":title",          $data['title']);
        $stmt->bindParam(":description",    $data['description']);
        $stmt->bindParam(":location",       $data['location']);
        $stmt->bindParam(":preferred_date", $data['preferred_date']);
        $stmt->bindParam(":category_id",    $data['category_id']);
        $stmt->bindParam(":id",             $requestID);

        return $stmt->execute() ? $requestID : null;
    }
}
?>
