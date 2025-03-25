<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

    // Check if email already exists
    $check_email = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $result = $check_email->get_result();

    if ($result->num_rows > 0) {
        echo "<script>
                alert('Email already exists. Please use a different email.');
                window.location.href = 'register.php';
              </script>";
    } else {
        // Hash password
        
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (email, password, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("ss", $email, $password);
        
        if ($stmt->execute()) {
            echo "<script>
                    alert('Account created successfully! Please log in.');
                    window.location.href = 'index.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error creating account. Please try again.');
                    window.location.href = 'register.php';
                  </script>";
        }
        $stmt->close();
    }
    $check_email->close();
}

// Rest of your HTML code...
?>