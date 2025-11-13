<?php
require_once __DIR__ . '/../Entity/Request.php';

class createRequestController {

    public function createRequest($userID, $data) {
        // validation example
        if (empty($data['title']) || empty($data['description']) || empty($data['category_id'])) {
            return ["error" => "All fields are required."];
        }

        // Entity call
        $request = new Request();
        $requestID = $request->createRequest($userID, $data);

        return ["success" => true, "request_id" => $requestID];
    }
}
?>
