<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$applicants_list = $conn->query("
    SELECT 
        firstname,
        lastname,
        email,
        home_address,
        desired_position,
        bpo_experience,
        interview_type,
        employment_status,
        studying_status
    FROM applicants 
    ORDER BY created_at DESC
");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Splace BPO | Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="splacelogobpo.png" type="image/x-icon">
    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --primary-color: #FF1F66;
        }

        body {
            background-color: #f5f5f5;
            font-family: 'Lexend', sans-serif;
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

        .sidebar-header img {
            width: 150px;
            height: auto;
            transition: all 0.3s;
            filter: brightness(0) invert(1);
        }

        .welcome-text {
            margin-top: 20px;
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


                .table-container {
                    background: white;
                    border-radius: 10px;
                    padding: 20px;
                    margin-top: 20px;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                    width: 100%;
                    overflow-x: auto;
                }

                .table {
                    font-size: 14px;
                    width: 100%;
                    margin-bottom: 0;
                }

                .table th {
                    white-space: nowrap;
                    padding: 12px 15px;
                    background-color: #f8f9fa;
                    font-weight: 600;
                }

                .table td {
                    padding: 10px 15px;
                    vertical-align: middle;
                }

                .container {
                    max-width: 95%;
                    margin: 0 auto;
                    padding: 0 15px;
                }

                .table-responsive {
                    overflow-x: auto;
                    -webkit-overflow-scrolling: touch;
                }

        .page-title {
            color: var(--primary-color);
            margin-bottom: 20px;
        }

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

        <div class="nav-item" onclick="window.location.href='dashboard.php'"><i class="fas fa-home"></i> <span>Home</span></div>
        <div class="nav-item" onclick="window.location.href='inbox.php'"><i class="fas fa-inbox"></i> <span>Inbox</span></div>
        <div class="nav-item" onclick="window.location.href='applicants-list.php'"><i class="fas fa-users"></i> <span>Applicants</span></div>
        <div class="nav-item" onclick="window.location.href='calendar.php'"><i class="fas fa-calendar"></i> <span>Calendar</span></div>
        <div class="nav-item" onclick="window.location.href='reports.php'"><i class="fas fa-chart-bar"></i> <span>Reports</span></div>
        <div class="nav-item" onclick="window.location.href='logout.php'"><i class="fas fa-sign-out"></i> <span>Log Out</span></div>
    </div>

    <div class="main-content" id="mainContent">
        <div class="container">
            <h2 class="page-title"><i class="fas fa-chart-bar me-2"></i>List of Applicants</h2>
            
            <!-- Add search bar -->
            <div class="search-container mb-4" style="max-width: 300px; margin-left: auto;">
                <div class="input-group">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search..." style="border-radius: 30px 0 0 30px; padding: 10px 20px; border: 1px solid #ddd;">
                    <button class="btn" type="button" style="border-radius: 0 30px 30px 0; background-color: #FF1F66; border: none; padding: 0 20px;">
                        <i class="fas fa-search" style="color: white;"></i>
                    </button>
                </div>
            </div>

            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Home Address</th>
                                <th>Desired Position</th>
                                <th>BPO Experience</th>
                                <th>Interview Type</th>
                                <th>Employment Status</th>
                                <th>Studying Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($applicant = $applicants_list->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($applicant['firstname']); ?></td>
                                    <td><?php echo htmlspecialchars($applicant['lastname']); ?></td>
                                    <td><?php echo htmlspecialchars($applicant['email']); ?></td>
                                    <td><?php echo htmlspecialchars($applicant['home_address']); ?></td>
                                    <td><?php echo htmlspecialchars($applicant['desired_position']); ?></td>
                                    <td><?php echo htmlspecialchars($applicant['bpo_experience']); ?></td>
                                    <td><?php echo htmlspecialchars($applicant['interview_type']); ?></td>
                                    <td><?php echo htmlspecialchars($applicant['employment_status']); ?></td>
                                    <td><?php echo htmlspecialchars($applicant['studying_status']); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
        
        updateClock();
        setInterval(updateClock, 1000);

        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            sidebar.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            });
        });
        
        // Add search functionality
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let searchText = this.value.toLowerCase();
            let tableRows = document.querySelectorAll('.table tbody tr');
            
            tableRows.forEach(row => {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchText) ? '' : 'none';
            });
        });
    </script>
</body>
</html>