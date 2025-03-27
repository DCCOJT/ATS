<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$user_query = "SELECT * FROM users WHERE user_id = user_id";
$user_result = $conn->query($user_query);
$userData = mysqli_fetch_assoc($user_result);

// Get total applicants count
$applicants_query = "SELECT COUNT(*) as total FROM applicants";
$applicants_result = $conn->query($applicants_query);
$applicants_count = $applicants_result->fetch_assoc()['total'];

// Get monthly applicants data
$monthly_applicants_query = "SELECT 
    MONTH(application_date) as month, 
    COUNT(*) as count 
    FROM applicants 
    WHERE YEAR(application_date) = YEAR(CURRENT_DATE())
    GROUP BY MONTH(application_date)
    ORDER BY month";
$monthly_result = $conn->query($monthly_applicants_query);

// Initialize array with zeros for all months
$monthly_data = array_fill(1, 12, 0);

// Fill in actual data
while ($row = $monthly_result->fetch_assoc()) {
    $monthly_data[$row['month']] = $row['count'];
}

// Convert to JavaScript array
$monthly_json = json_encode(array_values($monthly_data));

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Splace BPO | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <!-- Favicon with multiple sizes -->
    <link rel="icon" href="splacelogobpo.png" type="image/x-icon">

    <link rel="preconnect" href="
    <link rel=" preconnect" href="URL_ADDRESS.googleapis.com">
    <link rel="preconnect" href="URL_ADDRESS.googleapis.com">
    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --primary-color: #FF1F66;
        }

        body {
            background-color: #f5f5f5;
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            background-color: var(--primary-color);
            transition: width 0.3s;
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            padding: 20px;
            color: white;
        }

        /* Add these styles after the existing sidebar styles */
        .sidebar-header img {
            width: 150px;
            height: auto;
            transition: all 0.3s;
            filter: brightness(0) invert(1);
        }

        /* Add spacing for welcome text */
        .welcome-text {
            margin-top: 20px;  /* Adds space between logo and welcome text */
        }

        .sidebar.collapsed .sidebar-header img {
            width: 40px;
            margin-left: 5px;
        }

        .sidebar.collapsed .welcome-text,
        .sidebar.collapsed .nav-item span {
            display: none;
        }

        .nav-item {
            padding: 15px 20px;
            color: white;
            cursor: pointer;
            transition: background 0.3s;
            white-space: nowrap;
            overflow: hidden;
        }

        /* Update the media query */
        @media (max-width: 768px) {
            .sidebar {
                width: var(--sidebar-collapsed-width);
            }
            .main-content {
                margin-left: var(--sidebar-collapsed-width);
            }
            .sidebar .welcome-text,
            .sidebar .nav-item span {
                display: none;
            }
            .sidebar-header img {
                width: 40px;
                margin-left: 5px;
            }
        }

        .nav-item:hover {
            background-color: rgba(255,255,255,0.1);
        }

        .nav-item i {
            width: 30px;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: margin-left 0.3s;
        }

        .main-content.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .stats-number {
            font-size: 2em;
            font-weight: bold;
            color: var(--primary-color);
        }

        .assessment-table {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        @media (max-width: 768px) {
            .sidebar {
                width: var(--sidebar-collapsed-width);
            }
            .main-content {
                margin-left: var(--sidebar-collapsed-width);
            }
            .sidebar-header span,
            .nav-item span {
                display: none;
            }
        }
        .assessment-table {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Add these new styles for icon colors */
        .stats-card h5 i,
        .assessment-table h5 i,
        .table th i {
            color: #FF1F66;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: var(--sidebar-collapsed-width);
            }}

            :root {
            --primary-color: #FF1F66;
        }

        body {
            background-color: #f5f5f5;
            font-family: 'Lexend', sans-serif;
        }

        .container {
            padding: 30px;
        }

        .applicants-table {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .table th i {
            color: var(--primary-color);
        }

        .btn-approve {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            transition: opacity 0.3s;
        }

        .btn-approve:hover {
            opacity: 0.9;
            color: white;
        }

        .btn-disapprove {
            background-color: #ff8fab;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            transition: opacity 0.3s;
        }

        .btn-disapprove:hover {
            opacity: 0.9;
            color: white;
        }

        .page-title {
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9em;
        }

        .status-pending {
            background-color: #ffd700;
            color: #000;
        }

        .status-approved {
            background-color: #28a745;
            color: white;
        }

        .status-disapproved {
            background-color: #dc3545;
            color: white;
        }    
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="splacelogo.png" alt="Splace Logo">
            <div class="welcome-text" style="text-align: center; font-size: 18px;">
                Welcome back<br>
                <strong>Recruitment</strong><br>
                <div style="font-size: 16px; margin-top: 5px;">
                    <?php 
                    date_default_timezone_set('America/New_York');
                    echo date('F j, Y'); ?>
                    <div id="clock" style="margin-top: 5px; font-weight: 500;"></div>
                </div>
            </div>
        </div>

<!-- Add this JavaScript before the closing </body> tag -->
<script>
    function updateClock() {
        const now = new Date();
        const options = { 
            hour: '2-digit', 
            minute: '2-digit',
            second: '2-digit',
            hour12: true
        };
        document.getElementById('clock').textContent = now.toLocaleTimeString('en-US', options);
    }
    
    // Update clock immediately and then every second
    updateClock();
    setInterval(updateClock, 1000);
</script>
        <div class="nav-item" onclick="window.location.href='dashboard.php'"><i class="fas fa-home"></i> <span>Home</span></div>
        <div class="nav-item" onclick="window.location.href='inbox.php'"><i class="fas fa-inbox"></i> <span>Inbox</span></div>
        <div class="nav-item" onclick="window.location.href='applicants-list.php'"><i class="fas fa-users"></i> <span>Applicants</span></div>
        <div class="nav-item" onclick="window.location.href='calendar.php'"><i class="fas fa-calendar"></i> <span>Calendar</span></div>
        <div class="nav-item" onclick="window.location.href='reports.php'"><i class="fas fa-chart-bar"></i> <span>Reports</span></div>
        <div class="nav-item" onclick="window.location.href='logout.php'"><i class="fas fa-sign-out"></i> <span>Log Out</span></div>
    </div>

    <div class="main-content" id="mainContent">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="stats-card">
                        <h5><i class="fas fa-users me-2"></i>Applicants</h5>
                        <div class="stats-number"><?php echo $applicants_count; ?></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <h5><i class="fas fa-user-plus me-2"></i>Registered Today</h5>
                        <div class="stats-number">0</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <h5><i class="fas fa-check-circle me-2"></i>Qualified</h5>
                        <div class="stats-number">3</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <h5><i class="fas fa-times-circle me-2"></i>Disqualified</h5>
                        <div class="stats-number">1</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="stats-card">
                        <h5><i class="fas fa-chart-line me-2"></i>Applicant Frequency</h5>
                        <div class="chart-container">
                            <canvas id="applicantFrequencyChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card">
                        <h5><i class="fas fa-chart-bar me-2"></i>Qualification Status</h5>
                        <div class="chart-container">
                            <canvas id="qualificationChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="assessment-table">
                        <h5><i class="fas fa-clipboard-list me-2"></i>Assessment Scores</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-user me-1"></i>Profile</th>
                                    <th><i class="fas fa-signature me-1"></i>First Name</th>
                                    <th><i class="fas fa-signature me-1"></i>Last Name</th>
                                    <th><i class="fas fa-percentage me-1"></i>Score</th>
                                    <th><i class="fas fa-info-circle me-1"></i>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>M</td>
                                    <td>Menard</td>
                                    <td>Desabilla</td>
                                    <td>80%</td>
                                    <td><span class="badge bg-success">Passed</span></td>
                                </tr>
                                <tr>
                                    <td>C</td>
                                    <td>Cristhel</td>
                                    <td>Timola</td>
                                    <td>50%</td>
                                    <td><span class="badge bg-danger">Failed</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Toggle Sidebar
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            sidebar.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            });

            // Applicant Frequency Chart
            // Update the monthly applicants query to use real-time data
            const frequencyCtx = document.getElementById('applicantFrequencyChart').getContext('2d');
            const applicantChart = new Chart(frequencyCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Applicants',
                        data: <?php echo $monthly_json; ?>,
                        borderColor: '#FF1F66',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
            
            // Add function to update chart
            function updateApplicantChart() {
                fetch('get_applicant_data.php')
                    .then(response => response.json())
                    .then(data => {
                        applicantChart.data.datasets[0].data = data;
                        applicantChart.update();
                    });
            }
            
            // Update chart every 5 seconds
            setInterval(updateApplicantChart, 5000);
            // Qualification Status Chart
            const qualificationCtx = document.getElementById('qualificationChart').getContext('2d');
            new Chart(qualificationCtx, {
                type: 'bar',
                data: {
                    labels: ['Qualified', 'Disqualified'],
                    datasets: [{
                        data: [3, 1],
                        backgroundColor: ['#FF1F66', '#ff8fab']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>