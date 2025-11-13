<?php
require_once __DIR__ . '/../Entity/Request.php';
require_once __DIR__ . '/../Boundary/RequestViewCountBoundary.php';

class RequestViewCountController {
    private $boundary;
    private $entity;

    public function __construct() {
        $this->boundary = new RequestViewCountBoundary();
        $this->entity = new Request();
    }

    public function showCount() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $requestID = $this->boundary->getSelectedRequestID();
            $viewCount = $this->entity->getViewCount($requestID);
            $this->boundary->displayViewCountForm($viewCount, $requestID);
        } else {
            $this->boundary->displayViewCountForm();
        }
    }
}
?>
