<?php
session_start();

// redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - CSIT314</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f8f8;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h2 {
            background: #007bff;
            color: white;
            padding: 15px;
            margin: 0;
        }

        h3 {
            color: #333;
            margin-top: 40px;
        }

        button {
            display: block;
            width: 250px;
            margin: 8px auto;
            padding: 10px;
            border: none;
            background: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .logout {
            background: #dc3545;
        }

        .logout:hover {
            background: #a71d2a;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <h2>Welcome, <?= htmlspecialchars($username) ?> (<?= htmlspecialchars($role) ?>)</h2>
    <div class="container">
        <!-- Admin Section -->
        <?php if (strcasecmp($role, 'User Admin') === 0): ?>
            <h3>Admin Dashboard</h3>
            <button onclick="location.href='UserStory01/boundary/adminCreateAccountPage.php'">Create a User Account</button>
            <button onclick="location.href='UserStory02/boundary/adminViewAccountPage.php'">View User Accounts</button>
            <button onclick="location.href='UserStory03/boundary/adminUpdateAccountPage.php'">Update a User Account</button>
            <button onclick="location.href='UserStory04/boundary/adminSuspendAccountPage.php'">Suspend a User Account</button>
            <button onclick="location.href='UserStory05/boundary/adminSearchAccountPage.php'">Search for a User Account</button>
            <button onclick="location.href='UserStory06/boundary/adminCreateProfilePage.php'">Create a User Profile</button>
            <button onclick="location.href='UserStory07/boundary/adminViewProfilePage.php'">View User Profiles</button>
            <button onclick="location.href='UserStory08/boundary/adminUpdateProfilePage.php'">Update a User Profile</button>
            <button onclick="location.href='UserStory09/boundary/adminSuspendProfilePage.php'">Suspend a User Profile</button>
            <button onclick="location.href='UserStory10/boundary/adminSearchProfilePage.php'">Search for a User Profile</button>
        <?php endif; ?>

        <!-- PIN Section -->
        <?php if (strcasecmp($role, 'PIN') === 0): ?>
            <h3>PIN Dashboard</h3>
            <button onclick="location.href='UserStory13/boundary/createRequestBoundary.php'">Create Request</button>
            <button onclick="location.href='UserStory14/boundary/viewMyRequestsBoundary.php'">View My Requests</button>
            <button onclick="location.href='UserStory15/update_request.php'">Update My Requests</button>
            <button onclick="location.href='UserStory16/delete_request.php'">Delete Requests</button>
            <button onclick="location.href='UserStory17/search_request.php'">Search My Requests</button>
            <button onclick="location.href='UserStory27/view_request_views.php'">View Request Views</button>
            <button onclick="location.href='UserStory28/view_request_shortlists.php'">View Shortlists</button>
            <button onclick="location.href='UserStory29/view_completed_matches.php'">Completed Matches</button>
            <button onclick="location.href='UserStory30/searchhistoricalmatches.php'">Search Completed Matches</button>

        <?php endif; ?>

        <!-- CSR Section -->
        <?php if (strcasecmp($role, 'CSR') === 0): ?>
            <h3>CSR Dashboard</h3>
            <button onclick="location.href='UserStory20/search_pin_requests.php'">Search Requests</button>
            <button onclick="location.href='UserStory21/view_pin_requests.php'">View PIN Requests</button>
            <button onclick="location.href='UserStory22/csr_save_shortlist.php'">Save Shortlist</button>
            <button onclick="location.href='UserStory23/csr_search_shortlist.php'">Search Shortlist</button>
            <button onclick="location.href='UserStory24/csr_view_shortlist.php'">View Shortlist</button>
            <button onclick="location.href='UserStory31/csr_search_completed_history.php'">Search Completed</button>
            <button onclick="location.href='UserStory32/csr_view_completed_history.php'">View Completed</button>
        <?php endif; ?>

        <!-- Platform Manager Section -->
        <?php if (strcasecmp($role, 'PM') === 0 || strcasecmp($role, 'Platform Manager') === 0): ?>
            <h3>Platform Manager Dashboard</h3>
            <button onclick="location.href='UserStory33/create_category.php'">Create Category</button>
            <button onclick="location.href='UserStory34/view_categories.php'">View Categories</button>
            <button onclick="location.href='UserStory35/update_category.php'">Update Category</button>
            <button onclick="location.href='UserStory36/delete_category.php'">Delete Category</button>
            <button onclick="location.href='UserStory37/search_category.php'">Search Category</button>
            <button onclick="location.href='UserStory38/generate_daily_report.php'">Daily Report</button>
            <button onclick="location.href='UserStory39/generate_weekly_report.php'">Weekly Report</button>
            <button onclick="location.href='UserStory40/generate_monthly_report.php'">Monthly Report</button>
        <?php endif; ?>

        <button class="logout" onclick="location.href='logout.php'">Logout</button>
    </div>
</body>

</html>