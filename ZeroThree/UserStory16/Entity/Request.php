<?php
require_once __DIR__ . '/../database.php';

class Request {

    public function findByUserID($userID) {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "SELECT request_id, title 
                FROM requests 
                WHERE pin_user_id = :uid 
                ORDER BY created_at DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':uid', $userID);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteByID($requestID) {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "DELETE FROM requests WHERE request_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $requestID);
        return $stmt->execute();
    }
}
?>
