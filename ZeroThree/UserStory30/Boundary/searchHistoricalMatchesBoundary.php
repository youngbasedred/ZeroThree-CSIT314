<?php
require_once __DIR__ . '/../Controller/searchHistoricalMatchesController.php';

class searchHistoricalMatchesBoundary {

    public function getSearchFilters() {
        return [
            "category_id"   => $_POST['category_id'] ?? '',
            "service_date"  => $_POST['service_date'] ?? ''
        ];
    }

    public function display() {
        $controller = new searchHistoricalMatchesController();
        $userID = 11; // sample logged-in PIN

        $results = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $filters = $this->getSearchFilters();
            $results = $controller->search($userID, $filters);
        }

        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Historical Completed Matches</title>
        </head>
        <body>

        <h2>Search Completed Matches</h2>

        <form method="POST">

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

        <?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>

            <?php if (empty($results)): ?>
                <p>No Records Found.</p>
            <?php else: ?>

                <table border="1" cellpadding="10">
                    <tr>
                        <th>Match ID</th>
                        <th>Service Date</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Description</th>
                    </tr>

                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?= $row['match_id'] ?></td>
                            <td><?= $row['service_date'] ?></td>
                            <td><?= $row['category_name'] ?></td>
                            <td><?= $row['title'] ?></td>
                            <td><?= $row['location'] ?></td>
                            <td><?= $row['description'] ?></td>
                        </tr>
                    <?php endforeach; ?>

                </table>

            <?php endif; ?>

        <?php endif; ?>

        </body>
        </html>
        <?php
    }
}
?>
