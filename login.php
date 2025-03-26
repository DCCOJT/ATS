<?php 
include 'config.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Let's first check if the email exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($row = $result->fetch_assoc()) {
        // Email exists, now check password
        if($row['password'] === $password) {
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['email'] = $row['email'];
            // Login successful
            echo "<script>
                    alert('Login successful!');
                    window.location.href = 'dashboard.php';
                  </script>";
        } else {
            // Password incorrect
            echo "<script>
                    alert('Password is incorrect');
                    window.location.href = 'index.php';
                  </script>";
        }
    } else {
        // Email not found
        echo "<script>
                alert('Email not found');
                window.location.href = 'index.php';
              </script>";
    }
    $stmt->close();
}

$conn->close();
?>