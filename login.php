<?php 
include 'config.php';

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Simple query to check credentials
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) > 0) {
        // Login successful
        echo "<script>
                alert('Login successful!');
                window.location.href = 'dashboard.php';
              </script>";
    } else {
        // Login failed
        echo "<script>
                alert('Invalid email or password!');
                window.location.href = 'index.php';
              </script>";
    }
}

$conn->close();
?>