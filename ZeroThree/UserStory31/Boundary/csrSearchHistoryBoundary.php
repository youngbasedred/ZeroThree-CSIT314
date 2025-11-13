<?php
require_once __DIR__ . '/../Controller/csrSearchHistoryController.php';

class csrSearchHistoryBoundary {

    private $controller;

    public function __construct() {
        $this->controller = new csrSearchHistoryController();
    }

    public function getFilters() {
        return [
            "title"        => $_POST['title'] ?? "",
            "description"  => $_POST['description'] ?? "",
            "location"     => $_POST['location'] ?? "",
            "category_id"  => $_POST['category_id'] ?? "",
            "service_date" => $_POST['service_date'] ?? ""
        ];
    }

    public function display() {
        $results = [];

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $filters = $this->getFilters();
            $results = $this->controller->searchHistory($filters);
        }

        ?>
        <h2>CSR - Search Completed Volunteer Service History</h2>

        <!-- FILTER FORM -->
        <form method="POST">

            <label>Title (Keyword):</label><br>
            <input type="text" name="title"><br><br>

            <label>Description (Keyword):</label><br>
            <input type="text" name="description"><br><br>

            <label>Location (Keyword):</label><br>
            <input type="text" name="location" placeholder="e.g., west, bedok, jurong"><br><br>

            <label>Service Category:</label><br>
            <select name="category_id">
                <option value="">-- Any --</option>
                <option value="1">Food Distribution</option>
                <option value="2">Elderly Care</option>
                <option value="3">Education Support</option>
                <option value="4">Environmental Cleanup</option>
                <option value="5">Healthcare Aid</option>
            </select><br><br>

            <label>Service Date:</label><br>
            <input type="date" name="service_date"><br><br>

            <button type="submit">Search</button>
        </form>

        <hr>

        <!-- RESULTS -->
        <?php if ($_SERVER['REQUEST_METHOD'] === "POST"): ?>
            <?php if (empty($results)): ?>
                <p>No completed services found.</p>
            <?php else: ?>
                <table border="1" cellpadding="10">
                    <tr>
                        <th>Match ID</th>
                        <th>Service Date</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Category</th>
                    </tr>

                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?= $row['match_id'] ?></td>
                            <td><?= $row['service_date'] ?></td>
                            <td><?= htmlspecialchars($row['title']) ?></td>
                            <td><?= htmlspecialchars($row['description']) ?></td>
                            <td><?= htmlspecialchars($row['location']) ?></td>
                            <td><?= $row['category_name'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        <?php endif; ?>

        <?php
    }
}
?>
