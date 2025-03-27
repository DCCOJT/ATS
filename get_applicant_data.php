<?php
include 'config.php';

$monthly_applicants_query = "SELECT 
    MONTH(application_date) as month, 
    COUNT(*) as count 
    FROM applicants 
    WHERE YEAR(application_date) = YEAR(CURRENT_DATE())
    GROUP BY MONTH(application_date)
    ORDER BY month";
$monthly_result = $conn->query($monthly_applicants_query);

// Initialize array with zeros for all months
$monthly_data = array_fill(1, 12, 0);

// Fill in actual data
while ($row = $monthly_result->fetch_assoc()) {
    $monthly_data[$row['month']] = $row['count'];
}

// Return JSON data
header('Content-Type: application/json');
echo json_encode(array_values($monthly_data));

$conn->close();
?>