<?php
require_once __DIR__ . '/../Entity/CompletedRequest.php';

class csrSearchHistoryController {

    public function searchHistory($filters) {
        $entity = new CompletedRequest();
        return $entity->searchHistoryByCsr($filters);
    }
}
?>
