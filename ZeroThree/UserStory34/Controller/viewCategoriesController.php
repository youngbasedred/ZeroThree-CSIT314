<?php
require_once __DIR__ . '/../Boundary/ViewCategoriesBoundary.php';
require_once __DIR__ . '/../Entity/Category.php';

class ViewCategoriesController {
    private $boundary;
    private $entity;

    public function __construct() {
        $this->boundary = new ViewCategoriesBoundary();
        $this->entity = new Category();
    }

    public function listAllCategories() {
        $categories = $this->entity->listAllCategories();
        $this->boundary->viewAllCategories($categories);
    }
}
?>
