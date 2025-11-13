<?php
require_once __DIR__ . '/../Boundary/GenerateDailyReportBoundary.php';
require_once __DIR__ . '/../Entity/Report.php';

class DailyReportController
{
    private $boundary;
    private $entity;

    public function __construct()
    {
        $this->boundary = new GenerateDailyReportBoundary();
        $this->entity = new Report();
    }

    public function getReportByDate()
    {
        // display report page
        $this->boundary->displayGenerateReport();

        // handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['generate'])) {
            $date = $this->boundary->getSelectedDate();

            if (!$date) {
                echo "<p style='color:red;'>Please select a date to generate the report.</p>";
                return;
            }

            // fetch counts
            $totalRequests = $this->entity->countRequestsByDate($date);
            $totalConfirmed = $this->entity->countConfirmedByDate($date);

            // prepare result
            $reportData = [
                'totalRequests' => $totalRequests,
                'totalConfirmed' => $totalConfirmed
            ];

            // Sdisplay report
            $this->boundary->displayReport($reportData, $date);
        }
    }
}
