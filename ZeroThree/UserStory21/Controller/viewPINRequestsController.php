<?php
require_once __DIR__ . '/../Entity/Request.php';
require_once __DIR__ . '/../Boundary/viewPINRequestsBoundary.php';

class ViewPINRequestsController {
    private $boundary;
    private $entity;

    public function __construct() {
        $this->boundary = new ViewPINRequestsBoundary();
        $this->entity = new Request();
    }

    public function showPINRequests() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
            $filters = $this->boundary->getFilters();
            $requests = $this->entity->findByFilters($filters);
            $this->boundary->renderList($requests);
        } else {
            $requests = $this->entity->findByFilters(); // show all by default
            $this->boundary->renderList($requests);
        }
    }
}
?>
