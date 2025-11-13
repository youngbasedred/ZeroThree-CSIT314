<?php
require_once __DIR__ . '/../Entity/Category.php';

class updateCategoryController {

    public function getCategory($categoryID) {
        $category = new Category();
        return $category->findById($categoryID);
    }

    public function update($categoryID, $data) {
        $errors = [];

        if (empty($data['category_name'])) {
            $errors[] = "Category name is required.";
        }
        if (empty($data['description'])) {
            $errors[] = "Description is required.";
        }

        if (!empty($errors)) {
            return ["success" => false, "errors" => $errors];
        }

        $category = new Category();
        $updatedID = $category->update($categoryID, $data);

        if ($updatedID) {
            return ["success" => true, "category_id" => $updatedID];
        }

        return ["success" => false, "errors" => ["Failed to update category."]];
    }
}
?>
