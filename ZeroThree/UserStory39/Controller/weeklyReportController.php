<?php
require_once __DIR__ . '/../Boundary/GenerateWeeklyReportBoundary.php';
require_once __DIR__ . '/../Entity/Report.php';

class WeeklyReportController
{
    private $boundary;
    private $entity;

    public function __construct()
    {
        $this->boundary = new GenerateWeeklyReportBoundary();
        $this->entity = new Report();
    }

    public function getReportByWeek()
    {
        // display page
        $this->boundary->displayGenerateReport();

        // handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['generate'])) {
            $dates = $this->boundary->getSelectedWeek();
            $startDate = $dates['start_date'];
            $endDate = $dates['end_date'];

            if (!$startDate || !$endDate) {
                echo "<p style='color:red;'>Please select both start and end dates.</p>";
                return;
            }

            if ($endDate < $startDate) {
                echo "<p style='color:red;'>End date cannot be earlier than start date.</p>";
                return;
            }

            // fetch data
            $totalRequests = $this->entity->countRequestsBetween($startDate, $endDate);
            $totalConfirmed = $this->entity->countConfirmedBetween($startDate, $endDate);

            // prepare result
            $reportData = [
                'totalRequests' => $totalRequests,
                'totalConfirmed' => $totalConfirmed
            ];

            // display report
            $this->boundary->displayReport($reportData, $startDate, $endDate);
        }
    }
}
