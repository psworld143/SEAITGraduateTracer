<?php
// Include database connection
include('../db_conn.php');

// Set the content type to JSON
header('Content-Type: application/json');

// Get the JSON input from the request
$data = json_decode(file_get_contents("php://input"), true);

// Check if the ID is provided and is a valid number
if (isset($data['id']) && is_numeric($data['id'])) {
    $id = mysqli_real_escape_string($conn, $data['id']);

    // Prepare the SQL statement to delete the news entry
    $sql = "DELETE FROM news WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);

        // Execute the statement and check the result
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['success' => true, 'message' => 'News deleted successfully!']);
        } else {
            // Detailed error handling for execution failure
            echo json_encode(['success' => false, 'message' => 'Error deleting news: ' . mysqli_error($conn)]);
        }

        mysqli_stmt_close($stmt);
    } else {
        // Error preparing the SQL statement
        echo json_encode(['success' => false, 'message' => 'Error preparing statement: ' . mysqli_error($conn)]);
    }
} else {
    // Handle case where ID is missing or invalid
    echo json_encode(['success' => false, 'message' => 'Invalid ID provided.']);
}

// Close the database connection
mysqli_close($conn);
?>
