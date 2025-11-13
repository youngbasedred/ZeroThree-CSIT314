<?php
require_once __DIR__ . '/../Entity/Category.php';

class deleteCategoryController {

    public function delete($categoryID) {
        $category = new Category();
        return $category->deleteByID($categoryID);
    }

    public function getAllCategories() {
        $category = new Category();
        return $category->getAll();
    }
}
?>
