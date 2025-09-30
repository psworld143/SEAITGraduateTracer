<?php
include("../db_conn.php");

$input = json_decode(file_get_contents("php://input"), true);
$jobId = $input['id'];
$newStatus = $input['status'];

if ($jobId && $newStatus) {
    // Update the job status in the database
    $query = "UPDATE job_postings SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $newStatus, $jobId);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Job status updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update job status']);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}

$conn->close();
?>
