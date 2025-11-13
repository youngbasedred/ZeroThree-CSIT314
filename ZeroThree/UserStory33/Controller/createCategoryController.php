<?php
require_once __DIR__ . '/../Entity/Category.php';
require_once __DIR__ . '/../Boundary/CreateCategoryBoundary.php';

class CreateCategoryController
{
    private $boundary;
    private $entity;

    public function __construct()
    {
        $this->boundary = new CreateCategoryBoundary();
        $this->entity = new Category();
    }

    public function createCategory()
    {
        // if form not submitted, display blank form
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->boundary->displayCreateCategory();
            return;
        }

        // get form data
        $data = $this->boundary->getFormData();

        // pass data to entity for processing
        $result = $this->entity->createCategory($data);

        // handle results
        if (isset($result['errors'])) {
            $this->boundary->displayCreateCategory($result['errors']);
        } else {
            $this->boundary->displaySuccess($result['category_id']);
        }
    }
}
