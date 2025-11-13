<?php
require_once __DIR__ . '/../Controller/updateCategoryController.php';
require_once __DIR__ . '/../Entity/Category.php';

class updateCategoryBoundary {

    private $controller;
    private $categoryEntity;

    public function __construct() {
        $this->controller = new updateCategoryController();
        $this->categoryEntity = new Category();
    }

    public function getFormData() {
        return [
            "category_name" => $_POST['category_name'] ?? "",
            "description"   => $_POST['description'] ?? ""
        ];
    }

    public function displayUpdateCategory() {

        $categories = $this->categoryEntity->getAll();

        $selectedID = $_POST['category_id'] ?? "";

        // When a category is selected from dropdown
        $selectedCategory = $selectedID ? 
            $this->controller->getCategory($selectedID) : null;

        // When user submits updated form
        if (isset($_POST['update'])) {
            $data = $this->getFormData();
            $result = $this->controller->update($selectedID, $data);
        }
        ?>

        <h2>Update Volunteer Service Category</h2>

        <!-- Category Picker -->
        <form method="POST">
            <label>Select Category ID:</label><br>
            <select name="category_id" onchange="this.form.submit()" required>
                <option value="">-- Select Category --</option>

                <?php foreach ($categories as $c): ?>
                    <option value="<?= $c['category_id'] ?>"
                        <?= ($selectedID == $c['category_id']) ? 'selected' : '' ?>>
                        <?= $c['category_id'] ?> - <?= $c['category_name'] ?>
                    </option>
                <?php endforeach; ?>

            </select>
        </form>
        <br>

        <?php if ($selectedCategory): ?>

            <?php if (!empty($result)): ?>
                <?php if ($result['success']): ?>
                    <p style="color:green;">Category updated successfully!</p>
                <?php else: ?>
                    <ul style="color:red;">
                        <?php foreach ($result['errors'] as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            <?php endif; ?>

            <form method="POST">
                <input type="hidden" name="category_id" value="<?= $selectedID ?>">

                <label>Category ID (Read Only):</label><br>
                <input type="text" value="<?= $selectedID ?>" readonly><br><br>

                <label>Category Name:</label><br>
                <input type="text" name="category_name"
                       value="<?= $selectedCategory['category_name'] ?>" required><br><br>

                <label>Description:</label><br>
                <textarea name="description" required><?= $selectedCategory['description'] ?></textarea><br><br>

                <button type="submit" name="update">Update Category</button>
            </form>

        <?php endif; ?>

        <?php
    }
}
?>
