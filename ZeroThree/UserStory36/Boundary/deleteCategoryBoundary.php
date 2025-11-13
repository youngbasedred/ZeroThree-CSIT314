<?php
require_once __DIR__ . '/../Controller/deleteCategoryController.php';

class deleteCategoryBoundary {

    // Ask the user to confirm deletion
    public function displayConfirmation($categoryID) {
        ?>
        <html>
        <body>
        <h2>Delete Category #<?= $categoryID ?></h2>
        <p>Are you sure you want to delete this category?</p>

        <a href="deletecategory.php?confirm=yes&id=<?= $categoryID ?>">Yes</a>
        &nbsp;&nbsp;
        <a href="deletecategory.php?confirm=no">No</a>
        </body>
        </html>
        <?php
    }

    // Reads the user’s response
    public function getConfirmation() {
        return isset($_GET['confirm']) && $_GET['confirm'] === "yes";
    }
}
?>
