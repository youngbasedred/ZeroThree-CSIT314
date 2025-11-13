<?php
require_once __DIR__ . '/../Entity/Request.php';
require_once __DIR__ . '/../Boundary/SearchPINRequestsBoundary.php';

class SearchPINRequestsController {
    private $boundary;
    private $entity;

    public function __construct() {
        $this->boundary = new SearchPINRequestsBoundary();
        $this->entity = new Request();
    }

    public function search() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
            $filters = $this->boundary->getSearchInput();
            $results = $this->entity->findByFilters($filters);
            $this->boundary->displaySearchForm($results, $filters);
        } else {
            $this->boundary->displaySearchForm();
        }
    }
}
?>
