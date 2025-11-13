<?php
require_once __DIR__ . '/../Entity/CompletedRequest.php';

class csrViewHistoryController {

    public function listCompletedRequest() {
        $entity = new CompletedRequest();
        return $entity->viewHistoryByCsr();
    }
}
?>
