<?php
session_start();
include('../db_conn.php'); // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

// Get the school year from the POST request
$schoolYear = isset($_POST['schoolYear']) ? trim($_POST['schoolYear']) : '';

// Validate the input
if (empty($schoolYear)) {
    echo json_encode(['success' => false, 'message' => 'School year is required.']);
    exit;
}

// Prepare the SQL statement to insert the new school year
$stmt = $conn->prepare("INSERT INTO school_years (school_year) VALUES (?)");
$stmt->bind_param("s", $schoolYear);

// Execute the statement and check for success
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'School year added successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error adding school year: ' . $stmt->error]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>