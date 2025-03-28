<?php
include 'config.php';

// Remember Me functionality
function setRememberMeCookie($username)
{
    $token = bin2hex(random_bytes(32)); // Generate secure token
    $expiry = time() + (30 * 24 * 60 * 60); // 30 days

    // Store token in database
    global $conn;
    $stmt = $conn->prepare("UPDATE users SET remember_token = ? WHERE email = ?");
    $stmt->bind_param("ss", $token, $username);
    $stmt->execute();

    // Set cookie
    setcookie("remember_me", $token, $expiry, "/");
}

// Lost Password functionality
function sendPasswordResetLink()
{
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        global $conn;

        // Check if email exists
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $token = bin2hex(random_bytes(32));
            $expiry = date('Y-m-d H:i:s', time() + 3600); // 1 hour validity

            // Store reset token
            $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expiry = ? WHERE email = ?");
            $stmt->bind_param("sss", $token, $expiry, $email);
            $stmt->execute();

            // Send email with reset link
            $resetLink = "http://localhost/ATS/reset-password.php?token=" . $token;
            $to = $email;
            $subject = "Password Reset Request";
            $message = "Click the following link to reset your password: " . $resetLink;
            $headers = "From: noreply@splaceBPO.com";

            mail($to, $subject, $message, $headers);
            return "Password reset link has been sent to your email.";
        }
        return "Email not found.";
    }
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        // Handle login
        if (isset($_POST['remember_me'])) {
            setRememberMeCookie($_POST['username']);
        }
    }

    if (isset($_POST['forgot_password'])) {
        $resetMessage = sendPasswordResetLink();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Registration - Splace BPO</title>
    <!-- Bootstrap 5 CSS -->
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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Lexend', sans-serif;
            background-image: url('background.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        header {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 1.2rem 0;
            /* Increased padding */
            height: 100px;
            /* Set fixed height */
        }

        .container {
            padding: 0 2rem;
        }

        .navbar {
            padding: 0;
        }

        .logo img,
        .navbar-brand img {
            width: 200px;
            height: auto;
            object-fit: contain;
            margin-left: -129px;
            /* Adjust logo more to the left */
        }

        .navbar-nav {
            margin-right: -139px;
            /* Adjust nav items more to the right */
        }

        .navbar-nav .nav-link {
            color: #333;
            margin: 0 0.8rem;
            font-size: 22px;
            font-weight: 500;
            font-family: "Lexend", Sans-serif;
        }

        .btn-applicantregister {
            background-color: #C10149;
            /* Updated pink color */
            color: white !important;
            padding: 12px 70px;
            /* Adjusted padding */
            border-radius: 30px;
            /* Increased border radius */
            text-decoration: none;
            margin-right: 0.10rem;
            font-size: 22px;
            /* Adjusted font size */
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-applicantregister:hover {
            background-color: #000000;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="splacelogo.png" alt="Splace Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="blog.php">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="join-us.php">Join Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn-applicantregister" href="index.php">Log In</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="login-container" style="max-width: 800px; margin: 100px auto; padding: 40px 70px 70px 70px; background: white; border-radius: 20px; box-shadow: 0 0 20px rgba(0,0,0,0.1);">
            <img src="Group-65.png" alt="Splace Logo" style="width: 150px; display: block; margin: -10px auto 30px;">

            <h1 style="color: #333; font-size: 40px; font-weight: 500; margin-bottom: 40px; text-align: center; font-family: 'Lexend', sans-serif;">Applicant Registration</h1>

            <form action="applicantregistration-backend.php" method="POST">
                <div class="mb-4">
                    <label style="color: #666; font-size: 16px; font-weight: 500; margin-bottom: 8px; display: block;">First Name</label>
                    <input type="text" name="firstname" class="form-control" style="padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px;" required>
                </div>

                <div class="mb-4">
                    <label style="color: #666; font-size: 16px; font-weight: 500; margin-bottom: 8px; display: block;">Last Name</label>
                    <input type="text" name="lastname" class="form-control" style="padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px;" required>
                </div>

                <div class="mb-4">
                    <label style="color: #666; font-size: 16px; font-weight: 500; margin-bottom: 8px; display: block;">Contact Number</label>
                    <input type="tel" name="contact_number" class="form-control" style="padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px;" pattern="[0-9]{11}" required>
                </div>

                <div class="mb-4">
                    <label style="color: #666; font-size: 16px; font-weight: 500; margin-bottom: 8px; display: block;">Email Address</label>
                    <input type="email" name="email" class="form-control" style="padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px;" required>
                </div>

                <div class="mb-4">
                    <label style="color: #666; font-size: 16px; font-weight: 500; margin-bottom: 8px; display: block;">Home Address</label>
                    <input type="text" name="home" class="form-control" style="padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px;" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label style="color: #666; font-size: 16px; font-weight: 500; margin-bottom: 8px; display: block;">Desired Position</label>
                        <select name="position" class="form-select" style="padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px;" required>
                            <option value="">Choose</option>
                            <option value="Customer Service Representative">Customer Service Representative</option>
                            <option value="Technical Support Representative">Technical Support Representative</option>
                            <option value="Sales Representative">Sales Representative</option>
                            <option value="Customer Service Representative">Customer Service Representative</option>
                            <option value="Appointment Setter">Appointment Setter</option>
                            <option value="Lead Miner">Lead Miner</option>
                            <option value="Sales Representative">Sales Representative</option>
                            <option value="Virtual Assistant">Virtual Assistant</option>
                            <option value="Team Leader">Team Leader</option>
                            <option value="Social Media/ Content Creator">Social Media/ Content Creator</option>
                            <option value="Manager">Manager</option>
                            <option value="HR/Recruitment/Accounting">HR/Recruitment/Accounting</option>
                            <option value="IT/WebDev/Safety/Security">IT/WebDev/Safety/Security</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label style="color: #666; font-size: 16px; font-weight: 500; margin-bottom: 8px; display: block;">Years of BPO Experience</label>
                        <select name="experience" class="form-select" style="padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px;" required>
                            <option value="">Choose</option>
                            <option value="No Experience">No Experience</option>
                            <option value="6 Months and Below">6 Months and Below</option>
                            <option value="1 Year">1 Year</option>
                            <option value="2 Years or more">2 Years or more</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label style="color: #666; font-size: 16px; font-weight: 500; margin-bottom: 8px; display: block;">Interview Type</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="interview_type" value="Walk In" id="walk_in" required>
                        <label class="form-check-label" for="walk_in" style="color: #666; font-size: 16px;">Walk-In</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="interview_type" value="Virtual" id="virtual">
                        <label class="form-check-label" for="virtual" style="color: #666; font-size: 16px;">Virtual</label>
                    </div>
                </div>

                <div class="mb-4">
                    <label style="color: #666; font-size: 16px; font-weight: 500; margin-bottom: 8px; display: block;">Are you currently employed?</label>
                    <select name="employment_status" class="form-select" style="padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px;" required>
                        <option value="">Choose</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label style="color: #666; font-size: 16px; font-weight: 500; margin-bottom: 8px; display: block;">Are you currently STUDYING? (Enrolled or has a plan back to school)</label>
                    <select name="studying_status" class="form-select" style="padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px;" required>
                        <option value="">Choose</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>

                <button type="submit" name="submit" class="btn-applicantregister" style="width: 100%; margin-top: 20px;">Submit My Application</button>
            </form>
        </div>
    </main>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>