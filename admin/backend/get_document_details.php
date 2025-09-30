<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../db_conn.php');

// Check if the 'id' parameter is set
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure to validate the input
    $query = "SELECT * FROM documents WHERE id = $id";
    $result = $conn->query($query);

    // Check if the query was successful
    if ($result) {
        // Fetch the document details
        $document = $result->fetch_assoc();
        
        // Check if the document exists
        if ($document) {
            echo json_encode($document);
        } else {
            echo json_encode(['error' => 'Document not found']);
        }
    } else {
        // Return an error if the query fails
        echo json_encode(['error' => 'Query failed: ' . $conn->error]);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

// Close the database connection
$conn->close();
?>
