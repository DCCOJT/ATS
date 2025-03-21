<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPLACE BPO</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        header {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 1.2rem 0;    /* Increased padding */
            height: 100px;        /* Set fixed height */
        }

        .container {
            padding: 0 2rem;
        }

        .navbar {
            padding: 0;
        }

        .logo img, .navbar-brand img {
            width: 200px;
            height: auto;
            object-fit: contain;
            margin-left: -10px;  /* Adjust logo more to the left */
        }

        .navbar-nav {
            margin-right: -10px;  /* Adjust nav items more to the right */
        }

        .navbar-nav .nav-link {
            color: #333;
            margin: 0 0.8rem;
            font-size: 22px;
            font-weight: 400;
            font-family: "Harabara Mais Demo", Sans-serif;
        }

        .btn-talk, .btn-register {
            background-color: #FF1F66;  /* Updated pink color */
            color: white !important;
            padding: 12px 30px;         /* Adjusted padding */
            border-radius: 30px;        /* Increased border radius */
            text-decoration: none;
            margin-left: 0.8rem;
            font-size: 22px;            /* Adjusted font size */
            font-weight: 400;
            font-family: "Harabara Mais Demo", Sans-serif;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-talk:hover, .btn-register:hover {
            background-color: #e61c5c;  /* Slightly darker shade for hover */
            transform: translateY(-1px); /* Subtle lift effect */
            font-size: 22px;
            font-weight: 400;
            font-family: "Harabara Mais Demo", Sans-serif;
            transition: background-color 0.3s ease;
        }

        .btn-talk:hover, .btn-register:hover {
            background-color: #d60251;
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
                            <a class="btn-talk" href="contact.php">Let's Talk</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn-register" href="register.php">Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>