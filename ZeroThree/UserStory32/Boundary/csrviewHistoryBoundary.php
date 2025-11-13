<?php
require_once __DIR__ . '/../Controller/csrViewHistoryController.php';

class csrViewHistoryBoundary {

    private $controller;

    public function __construct() {
        $this->controller = new csrViewHistoryController();
    }

    public function display() {

        $completed = $this->controller->listCompletedRequest();
        ?>

        <h2>CSR - Completed Volunteer Service History</h2>

        <?php if (empty($completed)): ?>
            <p>No completed volunteer services found.</p>
        <?php else: ?>

            <table border="1" cellpadding="10">
                <tr>
                    <th>Match ID</th>
                    <th>Service Date</th>
                    <th>Request ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Location</th>
                    <th>Category</th>
                </tr>

                <?php foreach ($completed as $row): ?>
                    <tr>
                        <td><?= $row['match_id'] ?></td>
                        <td><?= $row['service_date'] ?></td>
                        <td><?= $row['request_id'] ?></td>
                        <td><?= htmlspecialchars($row['title']) ?></td>
                        <td><?= htmlspecialchars($row['description']) ?></td>
                        <td><?= htmlspecialchars($row['location']) ?></td>
                        <td><?= $row['category_name'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php endif; ?>

        <?php
    }
}
?>
