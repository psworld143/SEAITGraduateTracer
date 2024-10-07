<?php
// backend/get_job_posting.php
include('../db_connection.php'); // Include your DB connection file

$id = $_GET['id'];
$response = [];

// Fetch job posting from the database
$query = "SELECT * FROM job_postings WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $job = $result->fetch_assoc();
    $response['success'] = true;
    $response['job'] = $job;
} else {
    $response['success'] = false;
    $response['message'] = "Job posting not found.";
}

echo json_encode($response);
?>
