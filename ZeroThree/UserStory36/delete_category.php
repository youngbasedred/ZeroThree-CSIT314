<?php
require_once __DIR__ . '/Controller/deleteCategoryController.php';

$controller = new deleteCategoryController();
$message = "";

// Handle delete inside the same page
if (isset($_POST['delete_id'])) {
    $categoryID = intval($_POST['delete_id']);
    if ($controller->delete($categoryID)) {
        $message = "Category #$categoryID deleted successfully!";
    } else {
        $message = "Failed to delete category.";
    }
}

// Load all categories
$categories = $controller->getAllCategories();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Categories</title>
</head>
<body>

<h2>Service Categories</h2>

<?php if (!empty($message)): ?>
    <p style="color:green;"><?= $message ?></p>
<?php endif; ?>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Category Name</th>
        <th>Description</th>
        <th>Is Active</th>
        <th>Action</th>
    </tr>

    <?php foreach ($categories as $cat): ?>
        <tr>
            <td><?= $cat['category_id'] ?></td>
            <td><?= $cat['category_name'] ?></td>
            <td><?= $cat['description'] ?></td>
            <td><?= $cat['is_active'] ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="delete_id" value="<?= $cat['category_id'] ?>">
                    <button type="submit" onclick="return confirm('Delete this category?');">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

</body>
</html>
