<?php
// backend/update_job_posting.php

include('../db_conn.php'); // Include your database connection file

// Get the JSON data from the request
$data = json_decode(file_get_contents('php://input'), true);

// Check if the necessary fields are set in the input data
if (isset($data['id']) && !empty($data['id'])) {
    $id = intval($data['id']); // Ensure ID is an integer
    $jobTitle = $conn->real_escape_string($data['jobTitle']);
    $jobDescription = $conn->real_escape_string($data['jobDescription']);
    $qualifications = $conn->real_escape_string($data['qualifications']);
    $applicationDeadline = $conn->real_escape_string($data['applicationDeadline']);
    $contactInfo = $conn->real_escape_string($data['contactInfo']);

    // Prepare the SQL statement for updating the job posting
    $stmt = $conn->prepare("UPDATE job_postings SET jobTitle=?, jobDescription=?, qualifications=?, applicationDeadline=?, contactInfo=? WHERE id=?");
    $stmt->bind_param("sssssi", $jobTitle, $jobDescription, $qualifications, $applicationDeadline, $contactInfo, $id);

    // Execute the statement and handle the response
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Job posting updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating job posting: ' . $stmt->error]);
    }
    
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid data.']);
}

// Close the database connection
$conn->close();
?>
