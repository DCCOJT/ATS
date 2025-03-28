<?php
include 'config.php';

// Function to send disqualification email
function sendDisqualificationEmail($email, $firstname) {
    $to = $email;
    $subject = "Splace BPO Application Status";
    
    $message = "Dear $firstname,\n\n";
    $message .= "Thank you for your interest in joining Splace BPO. We appreciate the time you took to submit your application.\n\n";
    $message .= "After careful review of your application, we regret to inform you that we are currently seeking candidates with more extensive BPO experience for this position.\n\n";
    $message .= "However, we encourage you to:\n";
    $message .= "- Apply again after gaining more industry experience\n";
    $message .= "We wish you the best in your career journey.\n\n";
    $message .= "Best regards,\nSplace BPO Recruitment Team";
    
    $headers = "From: recruitment@splaceBPO.com\r\n";
    $headers .= "Reply-To: recruitment@splaceBPO.com\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    return mail($to, $subject, $message, $headers);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Sanitize and get form data
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $home = mysqli_real_escape_string($conn, $_POST['home']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $experience = mysqli_real_escape_string($conn, $_POST['experience']);
    $interview_type = mysqli_real_escape_string($conn, $_POST['interview_type']);
    $employment_status = mysqli_real_escape_string($conn, $_POST['employment_status']);
    $studying_status = mysqli_real_escape_string($conn, $_POST['studying_status']);
    
    // Get current date and time
    $application_date = date('Y-m-d H:i:s');
    
    // Check if applicant is qualified based on experience
    if ($experience == '6 Months and Below') {
        // Insert into disqualified_applicants table
        $sql = "INSERT INTO disqualified_applicants (
            firstname,
            lastname,
            contact_number,
            email,
            home_address,
            desired_position,
            bpo_experience,
            interview_type,
            employment_status,
            studying_status,
            application_date,
            status
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Send disqualification email
        sendDisqualificationEmail($email, $firstname);
    } else {
        // Insert into regular applicants table
        
        $sql = "INSERT INTO applicants (
            firstname,
            lastname,
            contact_number,
            email,
            home_address,
            desired_position,
            bpo_experience,
            interview_type,
            employment_status,
            studying_status,
            application_date,
            status
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    }
    
    // Create prepared statement
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("ssssssssssss",
        $firstname,
        $lastname,
        $contact_number,
        $email,
        $home,
        $position,
        $experience,
        $interview_type,
        $employment_status,
        $studying_status,
        $application_date,
        $status
    );
    
    // Execute statement
    if ($stmt->execute()) {
        // Success message with qualification status
        $status = ($experience == '6 Months and Below') ? 'disqualified' : 'qualified';
        echo "<script>
                alert('Application submitted successfully!');
                window.location.href = 'index.php';
              </script>";
    } else {
        // Error message
        echo "<script>
                alert('Error submitting application. Please try again.');
                window.location.href = 'applicantregistration.php';
              </script>";
    }
    
    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>