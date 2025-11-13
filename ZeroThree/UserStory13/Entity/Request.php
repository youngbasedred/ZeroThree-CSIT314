<?php
require_once __DIR__ . '/../database.php';

class Request {

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
}
?>
