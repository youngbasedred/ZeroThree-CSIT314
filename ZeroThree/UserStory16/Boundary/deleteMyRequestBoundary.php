<?php
require_once __DIR__ . '/../Controller/deleteMyRequestController.php';

class deleteMyRequestBoundary {

    private $controller;

    public function __construct() {
        $this->controller = new deleteMyRequestController();
    }

    // Reads form confirmation (Yes/No)
    public function getConfirmation() {
        return isset($_POST['confirm']) && $_POST['confirm'] === "yes";
    }

    public function displayConfirmation($requestID) {
        ?>
        <form method="POST">
            <input type="hidden" name="request_id" value="<?= $requestID ?>">
            <p>Are you sure you want to delete Request #<?= $requestID ?>?</p>
            <button name="confirm" value="yes">Yes</button>
            <button name="confirm" value="no">No</button>
        </form>
        <?php
    }

    public function display($userID) {

        $requests = $this->controller->loadUserRequests($userID);

        $selectedID = $_POST['request_id'] ?? "";

        if (isset($_POST['delete'])) {
            $this->displayConfirmation($selectedID);
            return;
        }

        if (isset($_POST['confirm'])) {
            if ($this->getConfirmation()) {
                $success = $this->controller->delete($selectedID);

                if ($success) {
                    echo "<p style='color:green;'>Request #$selectedID deleted successfully!</p>";
                } else {
                    echo "<p style='color:red;'>Failed to delete request.</p>";
                }
            } else {
                echo "<p style='color:orange;'>Deletion canceled.</p>";
            }

            // refresh request list
            $requests = $this->controller->loadUserRequests($userID);
        }

        ?>
        <h2>Delete My Request</h2>

        <form method="POST">

            <label>Select Request:</label><br>
            <select name="request_id" required>
                <option value="">-- Select Request --</option>

                <?php foreach ($requests as $r): ?>
                    <option value="<?= $r['request_id'] ?>">
                        <?= $r['request_id'] ?> - <?= htmlspecialchars($r['title']) ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            <button type="submit" name="delete"
                    onclick="return confirm('Do you want to delete this request?');">
                Delete Request
            </button>

        </form>
        <?php
    }
}
?>
