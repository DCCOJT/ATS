<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Splace BPO | Application Tracker</title>
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
        *{
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
                            <a class="btn-applicantregister" href="applicantregistration.php">Applicant Registration</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="login-container" style="max-width: 510px; margin: 100px auto; padding: 40px 70px 70px 70px; background: white; border-radius: 20px; box-shadow: 0 0 20px rgba(0,0,0,0.1);">
            <img src="Group-65.png" alt="Splace Logo" style="width: 150px; display: block; margin: -10px auto 30px;">
            
            <h1 style="color: #333; font-size: 40px; font-weight: 500; margin-bottom: 60px; text-align: center; font-family: 'Lexend', sans-serif;">Recruitment Login</h1>
            
            <form action="register-backend.php" method="POST">
                <div class="mb-4">
                    <label style="color: #999; font-size: 16px; font-weight: bold; margin-bottom: 8px; display: block; font-family: 'Lexend', sans-serif;">Email</label>
                    <input type="email" name="email" class="form-control" style="padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px; width: 100%;" required>
                </div>
                
                <div class="mb-4">
                    <label style="color: #999; font-size: 16px; font-weight: bold; margin-bottom: 8px; display: block; font-family: 'Lexend', sans-serif;">Password</label>
                    <div style="position: relative;">
                        <input type="password" name="password" id="password" class="form-control" style="padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px; width: 100%;" required>
                        <i class="toggle-password" onclick="togglePassword()" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #999;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                            </svg>
                        </i>
                    </div>
                </div>
                
                
                <button type="submit" name="login" style="background-color: #ED025A; color: white; width: 100%; padding: 12px; border: none; border-radius: 30px; font-size: 18px; font-weight: 500; margin-bottom: 20px; cursor: pointer; font-family: 'Lexend', sans-serif;">Create my Account</button>
                
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <a href="index.php" style="color: #ED025A; text-decoration: none; font-size: 16px; font-family: 'Lexend', sans-serif; transition: color 0.3s ease;" onmouseover="this.style.color='#000000'" onmouseout="this.style.color='#ED025A'">Log In</a>
                </div>
            </form>

            <!-- Add this before the closing </body> tag -->
            <script>
            function forgotPassword(e) {
                e.preventDefault();
                const email = prompt("Please enter your email address:");
                if (email) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.innerHTML = `
                        <input type="hidden" name="email" value="${email}">
                        <input type="hidden" name="forgot_password" value="1">
                    `;
                    document.body.appendChild(form);
                    form.submit();
                }
            }
            </script>
            <script>
                function togglePassword() {
                    const passwordInput = document.getElementById('password');
                    const icon = document.querySelector('.toggle-password');
                    
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        icon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                            <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486z"/>
                            <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                            <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708"/>
                        </svg>`;
                    } else {
                        passwordInput.type = 'password';
                        icon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                        </svg>`;
                    }
                }
            </script>
        </div>
    </main>
        
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>