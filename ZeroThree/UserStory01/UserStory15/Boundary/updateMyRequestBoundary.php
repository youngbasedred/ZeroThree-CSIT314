<?php
require_once __DIR__ . '/../Controller/updateMyRequestController.php';

class updateMyRequestBoundary {

    private $controller;

    public function __construct() {
        $this->controller = new updateMyRequestController();
    }

    public function getFormData() {
        return [
            "title"          => $_POST['title'] ?? "",
            "description"    => $_POST['description'] ?? "",
            "location"       => $_POST['location'] ?? "",
            "preferred_date" => $_POST['preferred_date'] ?? "",
            "category_id"    => $_POST['category_id'] ?? ""
        ];
    }

    public function displayUpdateRequest($userID) {

        // load list of user's requests for dropdown
        $requests = $this->controller->loadUserRequests($userID);

        $selectedID = $_POST['request_id'] ?? "";

        // load selected request data
        $selectedRequest = $selectedID ? 
            $this->controller->loadRequest($selectedID) : null;

        // form submitted?
        if (isset($_POST['update'])) {
            $data = $this->getFormData();
            $result = $this->controller->update($selectedID, $data);
        }

        ?>
        <h2>Update My Request</h2>

        <!-- Dropdown for choosing request -->
        <form method="POST">
            <label>Select Request to Edit:</label><br>
            <select name="request_id" onchange="this.form.submit()" required>
                <option value="">-- Select Request --</option>

                <?php foreach ($requests as $r): ?>
                    <option value="<?= $r['request_id'] ?>"
                        <?= ($selectedID == $r['request_id']) ? 'selected' : '' ?>>
                        <?= $r['request_id'] ?> - <?= htmlspecialchars($r['title']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
        <br>

        <?php if ($selectedRequest): ?>

            <?php if (!empty($result)): ?>
                <?php if ($result['success']): ?>
                    <p style="color:green;">Request updated successfully!</p>
                <?php else: ?>
                    <ul style="color:red;">
                        <?php foreach ($result['errors'] as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Request Form -->
            <form method="POST">
                <input type="hidden" name="request_id" value="<?= $selectedID ?>">

                <label>Title:</label><br>
                <input type="text" name="title"
                       value="<?= htmlspecialchars($selectedRequest['title']) ?>"
                       required><br><br>

                <label>Description:</label><br>
                <textarea name="description" required>
                    <?= htmlspecialchars($selectedRequest['description']) ?>
                </textarea><br><br>

                <label>Location:</label><br>
                <input type="text" name="location"
                       value="<?= htmlspecialchars($selectedRequest['location']) ?>"
                       required><br><br>

                <label>Preferred Date:</label><br>
                <input type="date" name="preferred_date"
                       value="<?= $selectedRequest['preferred_date'] ?>"
                       required><br><br>

                <label>Category:</label><br>
                <select name="category_id">
                    <option value="1" <?= $selectedRequest['category_id']==1?'selected':'' ?>>Food Distribution</option>
                    <option value="2" <?= $selectedRequest['category_id']==2?'selected':'' ?>>Elderly Care</option>
                    <option value="3" <?= $selectedRequest['category_id']==3?'selected':'' ?>>Education Support</option>
                    <option value="4" <?= $selectedRequest['category_id']==4?'selected':'' ?>>Environmental Cleanup</option>
                    <option value="5" <?= $selectedRequest['category_id']==5?'selected':'' ?>>Healthcare Aid</option>
                </select><br><br>

                <button type="submit" name="update">Update Request</button>
            </form>
        <?php endif; ?>
        <?php
    }
}
?>
