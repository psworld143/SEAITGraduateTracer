<?php
// Include database connection
include('../db_conn.php');

// Set the content type to JSON
header('Content-Type: application/json');

// Initialize the response array
$response = ['success' => false];

// Get the JSON input from the request
$data = json_decode(file_get_contents("php://input"), true);

// Validate the ID from the input
if (isset($data['id']) && is_numeric($data['id'])) {
    $id = intval($data['id']); // Cast to integer

    // Prepare the delete statement
    $query = "DELETE FROM documents WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        // Bind the ID as an integer
        $stmt->bind_param('i', $id);

        // Execute the statement
        if ($stmt->execute()) {
            // Check affected rows to determine success
            if ($stmt->affected_rows > 0) {
                $response['success'] = true;
                $response['message'] = 'Document deleted successfully.';
            } else {
                $response['message'] = 'Document not found or already deleted.';
            }
        } else {
            // Execution failure
            $response['message'] = 'Failed to delete document: ' . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // Error preparing the SQL statement
        $response['message'] = 'Error preparing statement: ' . $conn->error;
    }
} else {
    // Handle case where ID is missing or invalid
    $response['message'] = 'Invalid or missing document ID.';
}

// Return the JSON response
echo json_encode($response);

// Close the database connection
$conn->close();
?>
