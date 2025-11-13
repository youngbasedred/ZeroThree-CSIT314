<?php
require_once __DIR__ . '/../database.php';

class Category {

    public function getAll() {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->query("SELECT * FROM service_categories ORDER BY category_id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($categoryID) {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "SELECT * FROM service_categories WHERE category_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $categoryID);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($categoryID, $data) {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "UPDATE service_categories SET 
                    category_name = :name,
                    description   = :description,
                    updated_at    = NOW()
                WHERE category_id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name',        $data['category_name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':id',          $categoryID);

        return $stmt->execute() ? $categoryID : null;
    }
}
?>
