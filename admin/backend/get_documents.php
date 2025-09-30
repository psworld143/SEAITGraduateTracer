<?php
include("../db_conn.php");

// Get the document ID from the request
$documentId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Check if the document ID is valid
if ($documentId <= 0) {
    echo json_encode(['error' => 'Invalid document ID.']);
    exit; // Exit the script if the ID is invalid
}

// Prepare the SQL statement to fetch document details
$sql = "SELECT * FROM documents WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    // Error preparing the statement
    echo json_encode(['error' => 'Database error: ' . $conn->error]);
    exit; // Exit if there was a preparation error
}

$stmt->bind_param("i", $documentId);
$stmt->execute();

// Get the result
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the document details as an associative array
    $document = $result->fetch_assoc();
    
    // Return the document details as a JSON response
    echo json_encode($document);
} else {
    // Document not found
    echo json_encode(['error' => 'Document not found.']);
}

// Close connections
$stmt->close();
$conn->close();
?>
