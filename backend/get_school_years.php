<?php
session_start();
include('../db_conn.php'); // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

// Prepare the SQL statement to fetch school years
$stmt = $conn->prepare("SELECT school_year FROM school_years");
$stmt->execute();
$result = $stmt->get_result();

$schoolYears = [];
while ($row = $result->fetch_assoc()) {
    $schoolYears[] = $row['school_year']; // Only fetch the school_year column
}

// Return the data as JSON
echo json_encode(['success' => true, 'data' => $schoolYears]);

// Close the statement and connection
$stmt->close();
$conn->close();
?>