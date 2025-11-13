<?php
require_once __DIR__ . '/../Entity/Request.php';

class ViewMyRequestsController {

    public function showMyRequests($userID) {
        $request = new Request();
        $results = $request->findByUserID($userID);

        return $results;
    }
}
?>
