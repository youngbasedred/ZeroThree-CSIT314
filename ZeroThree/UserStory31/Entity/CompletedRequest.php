<?php
require_once __DIR__ . '/../database.php';

class CompletedRequest {

    public function searchHistoryByCsr($filters) {
        $db = new Database();
        $conn = $db->getConnection();

		$sql = "SELECT 
					m.match_id,
					m.service_date,
					r.request_id,
					r.title,
					r.description,
					r.location,
					c.category_name,
					m.status AS match_status
				FROM matches m
				JOIN requests r ON m.request_id = r.request_id
				JOIN service_categories c ON r.category_id = c.category_id
				WHERE LOWER(m.status) = 'completed' ";



        // Title keyword
        if (!empty($filters['title'])) {
            $sql .= " AND r.title LIKE :title ";
        }

        // Description keyword
        if (!empty($filters['description'])) {
            $sql .= " AND r.description LIKE :description ";
        }

        // Location keyword (key requirement)
        if (!empty($filters['location'])) {
            $sql .= " AND r.location LIKE :location ";
        }

        // Category filter
        if (!empty($filters['category_id'])) {
            $sql .= " AND r.category_id = :category_id ";
        }

        // Date filter
        if (!empty($filters['service_date'])) {
            $sql .= " AND m.service_date = :service_date ";
        }

        $stmt = $conn->prepare($sql);

        // Bind keywords
        if (!empty($filters['title'])) {
            $keyword = "%" . $filters['title'] . "%";
            $stmt->bindParam(':title', $keyword);
        }
        if (!empty($filters['description'])) {
            $keyword = "%" . $filters['description'] . "%";
            $stmt->bindParam(':description', $keyword);
        }
        if (!empty($filters['location'])) {
            $keyword = "%" . $filters['location'] . "%";
            $stmt->bindParam(':location', $keyword);
        }

        // Bind normal filters
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
