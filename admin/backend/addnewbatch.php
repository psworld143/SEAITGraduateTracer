<?php
session_start();
include('../db_conn.php'); // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

// Get the batch name and year graduated from the POST request
$batchName = isset($_POST['batchName']) ? trim($_POST['batchName']) : '';
$yearGraduated = isset($_POST['yearGraduated']) ? trim($_POST['yearGraduated']) : '';

// Validate the input
if (empty($batchName) || empty($yearGraduated)) {
    echo json_encode(['success' => false, 'message' => 'Batch name and year graduated are required.']);
    exit;
}

// Prepare the SQL statement to insert the new batch
$stmt = $conn->prepare("INSERT INTO batches (batch_name, year_graduated) VALUES (?, ?)");
$stmt->bind_param("ss", $batchName, $yearGraduated);

// Execute the statement and check for success
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Batch added successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error adding batch: ' . $stmt->error]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>