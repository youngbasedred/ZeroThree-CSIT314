<?php
require_once __DIR__ . '/../database.php';

class Request {

    public function searchCompletedByUser($userID, $filters) {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "SELECT 
                    m.match_id,
                    m.service_date,
                    r.title,
                    r.location,
                    r.description,
                    c.category_name
                FROM matches m
                JOIN requests r ON m.request_id = r.request_id
                JOIN service_categories c ON r.category_id = c.category_id
                WHERE m.pin_user_id = :user_id
                AND m.status = 'COMPLETED'";

        // FILTERS
        if (!empty($filters['category_id'])) {
            $sql .= " AND r.category_id = :category_id";
        }

        if (!empty($filters['service_date'])) {
            $sql .= " AND m.service_date = :service_date";
        }

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':user_id', $userID);

        if (!empty($filters['category_id'])) {
            $stmt->bindParam(':category_id', $filters['category_id']);
        }
        if (!empty($filters['service_date'])) {
            $stmt->bindParam(':service_date', $filters['service_date']);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
