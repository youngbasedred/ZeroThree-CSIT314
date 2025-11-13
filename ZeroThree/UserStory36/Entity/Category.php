<?php
require_once __DIR__ . '/../database.php';

class Category {

    // Fetch all categories for listing
    public function getAll() {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->query("SELECT * FROM service_categories ORDER BY category_id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Delete category by ID
    public function deleteByID($categoryID) {
        $db = new Database();
        $conn = $db->getConnection();

        // Ensure no requests are using this category (optional)
        $sql = "DELETE FROM service_categories WHERE category_id = :category_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':category_id', $categoryID, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
?>
