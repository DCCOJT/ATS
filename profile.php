<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$user_query = "SELECT * FROM users WHERE user_id = '$user_id'";
$user_result = $conn->query($user_query);
$userData = mysqli_fetch_assoc($user_result);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Splace BPO | Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
        <div class="nav-item" onclick="window.location.href='profile.php'"><i class="fas fa-user"></i> <span>Profile</span></div>
        <div class="nav-item" onclick="window.location.href='inbox.php'"><i class="fas fa-inbox"></i> <span>Inbox</span></div>
        <div class="nav-item" onclick="window.location.href='applicants-list.php'"><i class="fas fa-users"></i> <span>Applicants</span></div>
        <div class="nav-item" onclick="window.location.href='calendar.php'"><i class="fas fa-calendar"></i> <span>Calendar</span></div>
        <div class="nav-item" onclick="window.location.href='reports.php'"><i class="fas fa-chart-bar"></i> <span>Reports</span></div>
        <div class="nav-item" onclick="window.location.href='logout.php'"><i class="fas fa-sign-out"></i> <span>Log Out</span></div>
    </div>

    <div class="main-content" id="mainContent">
        <!-- Add your profile content here -->
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

        // Toggle Sidebar
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            sidebar.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            });
        });
    </script>
</body>
</html>
