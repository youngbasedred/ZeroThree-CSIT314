<?php
require_once __DIR__ . '/../database.php';

class CompletedRequest {

    public function viewHistoryByCsr() {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "SELECT 
                    m.match_id,
                    m.service_date,
                    r.request_id,
                    r.title,
                    r.description,
                    r.location,
                    c.category_name
                FROM matches m
                INNER JOIN requests r ON m.request_id = r.request_id
                INNER JOIN service_categories c ON r.category_id = c.category_id
                WHERE LOWER(m.status) = 'completed'
                ORDER BY m.service_date DESC";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
