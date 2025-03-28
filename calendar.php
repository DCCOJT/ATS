<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Fetch applicants from database
$applicants_query = "SELECT * FROM applicants ORDER BY application_date DESC";
$applicants_result = $conn->query($applicants_query);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Splace BPO | Applicants List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="splacelogobpo.png" type="image/x-icon">
    <style>
        /* Add these sidebar styles */
        :root {
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --primary-color: #FF1F66;
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
    <!-- Add sidebar -->
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
            <h2 class="page-title"><i class="fas fa-users me-2"></i>Applicant List for Interview</h2>
            <div class="applicants-table">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><i class="fas fa-user me-2"></i>Name</th>
                            <th><i class="fas fa-phone me-2"></i>Contact</th>
                            <th><i class="fas fa-envelope me-2"></i>Email</th>
                            <th><i class="fas fa-map-marker-alt me-2"></i>Address</th>
                            <th><i class="fas fa-calendar me-2"></i>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($applicant = $applicants_result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#scheduleModal" 
                                       data-name="<?php echo htmlspecialchars($applicant['firstname'] . ' ' . $applicant['lastname']); ?>"
                                       data-contact="<?php echo htmlspecialchars($applicant['contact_number']); ?>"
                                       data-email="<?php echo htmlspecialchars($applicant['email']); ?>"
                                       data-address="<?php echo htmlspecialchars($applicant['home_address']); ?>">
                                        <?php echo htmlspecialchars($applicant['firstname'] . ' ' . $applicant['lastname']); ?>
                                    </a>
                                </td>
                                <td><?php echo htmlspecialchars($applicant['contact_number']); ?></td>
                                <td><?php echo htmlspecialchars($applicant['email']); ?></td>
                                <td><?php echo htmlspecialchars($applicant['home_address']); ?></td>
                                <td>
                                    <button class="btn btn-approve btn-sm" onclick="scheduleInterview(this)" 
                                            data-applicant="<?php echo htmlspecialchars($applicant['firstname'] . ' ' . $applicant['lastname']); ?>">
                                        Schedule Interview
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Schedule Modal -->
    <div class="modal fade" id="scheduleModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Schedule Interview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p><strong>Complete Name: </strong><span id="modalName"></span></p>
                        <p><strong>Mobile Number: </strong><span id="modalContact"></span></p>
                        <p><strong>Email: </strong><span id="modalEmail"></span></p>
                        <p><strong>Current Address: </strong><span id="modalAddress"></span></p>
                    </div>
                    <div class="mb-3">
                        <label for="scheduleDate" class="form-label">Date:</label>
                        <input type="date" class="form-control" id="scheduleDate">
                    </div>
                    <div class="mb-3">
                        <label for="scheduleTime" class="form-label">Time:</label>
                        <input type="time" class="form-control" id="scheduleTime">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-approve" onclick="saveSchedule()">Schedule</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add this before closing body tag -->
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
        
        setInterval(updateClock, 1000);

        // Update the click handler for the Schedule Interview button
        function scheduleInterview(button) {
            const name = button.getAttribute('data-applicant');
            const row = button.closest('tr');
            const contact = row.cells[1].textContent;
            const email = row.cells[2].textContent;
            const address = row.cells[3].textContent;
            
            document.getElementById('modalName').textContent = name;
            document.getElementById('modalContact').textContent = contact;
            document.getElementById('modalEmail').textContent = email;
            document.getElementById('modalAddress').textContent = address;
            
            const modal = new bootstrap.Modal(document.getElementById('scheduleModal'));
            modal.show();
        }

        function saveSchedule() {
            const name = document.getElementById('modalName').textContent;
            const date = document.getElementById('scheduleDate').value;
            const time = document.getElementById('scheduleTime').value;
            
            if (!date || !time) {
                alert('Please select both date and time');
                return;
            }

            // Here you can add AJAX call to save the schedule to database
            alert(`Interview scheduled for ${name} on ${date} at ${time}`);
            bootstrap.Modal.getInstance(document.getElementById('scheduleModal')).hide();
        }
    </script>
</body>
</html>