<?php
require_once __DIR__ . '/../Controller/csrShortlistController.php';

class csrShortlistBoundary {

    private $controller;

    public function __construct() {
        $this->controller = new csrShortlistController();
    }

    public function display($csrId) {

        $message = "";

        // Handle saving
        if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['request_id'])) {
            $requestId = $_POST['request_id'];
            $success = $this->controller->add($csrId, $requestId);

            $message = $success ? "Request saved to shortlist!" : "This request is already saved.";
        }

        // Fetch lists
        $unsaved = $this->controller->getUnsaved($csrId);
        $saved = $this->controller->getSaved($csrId);
        ?>

        <h2>CSR - Save Requests to Shortlist</h2>

        <!-- Message -->
        <?php if (!empty($message)): ?>
            <p><strong><?= $message ?></strong></p>
        <?php endif; ?>

        <!-- Dropdown of unsaved requests -->
        <form method="POST">
            <label>Requests not yet saved:</label><br>

            <select name="request_id" required>
                <option value="">-- Select Request --</option>
                <?php foreach ($unsaved as $req): ?>
                    <option value="<?= $req['request_id'] ?>">
                        <?= $req['title'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Save to Shortlist</button>
        </form>

        <hr>

        <h3>Saved Shortlist</h3>

        <?php if (empty($saved)): ?>
            <p>No requests saved yet.</p>
        <?php else: ?>
            <table border="1" cellpadding="10">
                <tr>
                    <th>Request ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Location</th>
                </tr>

                <?php foreach ($saved as $item): ?>
                    <tr>
                        <td><?= $item['request_id'] ?></td>
                        <td><?= htmlspecialchars($item['title']) ?></td>
                        <td><?= htmlspecialchars($item['description']) ?></td>
                        <td><?= htmlspecialchars($item['location']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <?php
    }
}
?>
