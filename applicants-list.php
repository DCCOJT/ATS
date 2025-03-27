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
    <div class="container">
        <h2 class="page-title"><i class="fas fa-users me-2"></i>Applicants List</h2>
        
        <div class="applicants-table">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><i class="fas fa-user me-1"></i>Name</th>
                        <th><i class="fas fa-envelope me-1"></i>Email</th>
                        <th><i class="fas fa-phone me-1"></i>Home</th>
                        <th><i class="fas fa-calendar me-1"></i>Application Date</th>
                        <th><i class="fas fa-info-circle me-1"></i>Status</th>
                        <th><i class="fas fa-cogs me-1"></i>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $applicants_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['home_address']; ?></td>
                            <td><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                            <td>
                                <span class="status-badge <?php 
                                    echo $row['status'] == 'Pending' ? 'status-pending' : 
                                        ($row['status'] == 'Approved' ? 'status-approved' : 'status-disapproved'); 
                                ?>">
                                    <?php echo $row['status']; ?>
                                </span>
                            </td>
                            <td>
                                <?php if($row['status'] == 'Pending'): ?>
                                    <a href="update_status.php?id=<?php echo $row['applicant_id']; ?>&status=Approved" 
                                       class="btn btn-approve btn-sm">
                                        <i class="fas fa-check me-1"></i>Approve
                                    </a>
                                    <a href="update_status.php?id=<?php echo $row['applicant_id']; ?>&status=Disapproved" 
                                       class="btn btn-disapprove btn-sm">
                                        <i class="fas fa-times me-1"></i>Disapprove
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">Processed</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>