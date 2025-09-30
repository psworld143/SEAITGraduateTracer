<?php
// Include database connection
include('../db_conn.php');

// Get job ID from the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $jobId = $_GET['id'];

    // Prepare the SQL query to delete the job
    $query = "DELETE FROM job_postings WHERE id = ?";
    
    if ($stmt = $conn->prepare($query)) {
        // Bind the job ID to the SQL statement
        $stmt->bind_param("i", $jobId);

        // Execute the query
        if ($stmt->execute()) {
            // Return success response
            echo json_encode(['success' => true, 'message' => 'Job deleted successfully.']);
        } else {
            // Return error if the deletion fails
            echo json_encode(['success' => false, 'message' => 'Failed to delete the job. Please try again later.']);
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // Return error if the query fails to prepare
        echo json_encode(['success' => false, 'message' => 'Failed to prepare the delete query.']);
    }

} else {
    // Return error if job ID is not provided or invalid
    echo json_encode(['success' => false, 'message' => 'Invalid job ID.']);
}

// Close the database connection
$conn->close();
?>
