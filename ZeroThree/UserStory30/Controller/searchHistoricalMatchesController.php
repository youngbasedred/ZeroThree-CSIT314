<?php
require_once __DIR__ . '/../Entity/Request.php';

class searchHistoricalMatchesController {

    public function search($userID, $filters) {
        $request = new Request();
        return $request->searchCompletedByUser($userID, $filters);
    }
}
?>
