<?php
include("../db_conn.php");

if (isset($_GET['id'])) {
    $jobId = intval($_GET['id']);
    
    // Query to fetch job details
    $query = "SELECT * FROM job_postings WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $jobId);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $response['data'] = $result->fetch_assoc();
            $response['success'] = true;
        } else {
            $response['message'] = "Job not found.";
        }
    } else {
        $response['message'] = "Error executing query.";
    }
    $stmt->close();
}

header('Content-Type: application/json');
echo json_encode($response);
?>