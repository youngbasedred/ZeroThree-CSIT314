<?php
require_once __DIR__ . '/../database.php';

class Request {

    // Used in User Story 13
    public function createRequest($userID, $data) {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "INSERT INTO requests 
                (pin_user_id, category_id, title, description, location, preferred_date)
                VALUES 
                (:pin_user_id, :category_id, :title, :description, :location, :preferred_date)";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':pin_user_id', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':category_id', $data['category_id'], PDO::PARAM_INT);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':location', $data['location']);
        $stmt->bindParam(':preferred_date', $data['preferred_date']);

        $stmt->execute();

        return $conn->lastInsertId();
    }

    // NEW — Used in User Story 135
    public function findByUserID($userID) {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "SELECT r.*, c.category_name
                FROM requests r
                JOIN service_categories c ON r.category_id = c.category_id
                WHERE r.pin_user_id = :user_id
                ORDER BY r.created_at DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
