<?php
header('Content-Type: application/json');
include("../db_conn.php");

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]));
}

// Fetch job postings
$sql = "SELECT id, company_name, job_title, job_description, status FROM job_postings WHERE status = 'active'";
$result = $conn->query($sql);

$jobPostings = [];
if ($result) {
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $jobPostings[] = $row;
        }
    }
} else {
    // Handle SQL error
    die(json_encode(['success' => false, 'message' => 'Error fetching job postings: ' . $conn->error]));
}

$conn->close();

// Return data in JSON format
echo json_encode(['success' => true, 'data' => $jobPostings]);
?>
