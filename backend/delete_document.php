<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "graduate_tracer";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Check if the document ID is set and is numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize the ID input

    // Prepare the delete statement
    $stmt = $conn->prepare("DELETE FROM documents WHERE id = ?");
    
    if ($stmt === false) {
        die(json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]));
    }

    $stmt->bind_param("i", $id); // Bind the ID parameter

    // Execute the statement
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Document deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No document found with the given ID.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete document.']);
    }

    $stmt->close(); // Close the prepared statement
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid or missing document ID.']);
}

// Close the database connection
$conn->close();
?>
