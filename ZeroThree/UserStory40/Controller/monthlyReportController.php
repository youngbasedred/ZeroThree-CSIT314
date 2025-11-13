<?php
require_once __DIR__ . '/../Boundary/GenerateMonthlyReportBoundary.php';
require_once __DIR__ . '/../Entity/report.php';

class MonthlyReportController
{
    private $boundary;
    private $entity;

    public function __construct()
    {
        $this->boundary = new GenerateMonthlyReportBoundary();
        $this->entity = new Report();
    }

    public function getReportByMonth()
    {
        // display the selection form
        $this->boundary->displayGenerateReport();

        // handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['generate'])) {
            $selection = $this->boundary->getSelectedMonth();
            $year = $selection['year'];
            $month = $selection['month'];

            if (!$year || !$month) {
                echo "<p style='color:red;'>Please select both year and month.</p>";
                return;
            }

            // retrieve report data
            $totalRequests = $this->entity->countRequestsInMonth($year, $month);
            $totalConfirmed = $this->entity->countConfirmedInMonth($year, $month);

            // prepare results
            $reportData = [
                'totalRequests' => $totalRequests,
                'totalConfirmed' => $totalConfirmed
            ];

            // display report
            $this->boundary->displayReport($reportData, $year, $month);
        }
    }
}
