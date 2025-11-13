<?php
require_once __DIR__ . '/../Entity/Shortlist.php';

class csrShortlistController {

    public function add($csrId, $requestId) {
        $entity = new Shortlist();
        return $entity->addToShortlist($csrId, $requestId);
    }

    public function getSaved($csrId) {
        $entity = new Shortlist();
        return $entity->getSavedShortlist($csrId);
    }

    public function getUnsaved($csrId) {
        $entity = new Shortlist();
        return $entity->getUnsavedRequests($csrId);
    }
}
?>
