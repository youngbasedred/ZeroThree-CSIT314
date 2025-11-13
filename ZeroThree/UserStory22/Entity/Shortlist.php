<?php
require_once __DIR__ . '/../database.php';

class Shortlist {

    // Add request to CSR's shortlist
    public function addToShortlist($csrId, $requestId) {
        $db = new Database();
        $conn = $db->getConnection();

        // Check if already saved
        $check = $conn->prepare("SELECT * FROM shortlist WHERE csr_user_id = :csr AND request_id = :req");
        $check->execute(['csr' => $csrId, 'req' => $requestId]);

        if ($check->rowCount() > 0) {
            return false; // already exists
        }

        // Insert new shortlist entry
        $stmt = $conn->prepare("
            INSERT INTO shortlist (csr_user_id, request_id, created_at)
            VALUES (:csr, :req, NOW())
        ");
        return $stmt->execute(['csr' => $csrId, 'req' => $requestId]);
    }

    // Fetch saved shortlist
    public function getSavedShortlist($csrId) {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "SELECT s.shortlist_id, r.request_id, r.title, r.description, r.location
                FROM shortlist s
                INNER JOIN requests r ON s.request_id = r.request_id
                WHERE s.csr_user_id = :csr";

        $stmt = $conn->prepare($sql);
        $stmt->execute(['csr' => $csrId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch only unsaved requests
    public function getUnsavedRequests($csrId) {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "SELECT r.request_id, r.title
                FROM requests r
                WHERE r.request_id NOT IN (
                    SELECT request_id FROM shortlist WHERE csr_user_id = :csr
                )";

        $stmt = $conn->prepare($sql);
        $stmt->execute(['csr' => $csrId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
