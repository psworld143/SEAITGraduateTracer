<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "graduate_tracer";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Check if `id` is passed and is a valid number
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $student_id = intval($_GET['id']);

    // Prepare the SQL query to delete the student by `id`
    $deleteQuery = "DELETE FROM students WHERE id = ?";
    if ($stmt = $conn->prepare($deleteQuery)) {
        $stmt->bind_param('i', $student_id);

        if ($stmt->execute()) {
            // Return success response
            echo json_encode(['success' => true, 'message' => 'Student deleted successfully.']);
        } else {
            // Error in query execution
            echo json_encode(['success' => false, 'message' => 'Error: Could not execute query.']);
        }

        $stmt->close();
    } else {
        // Error preparing the statement
        echo json_encode(['success' => false, 'message' => 'Error: Could not prepare statement.']);
    }
} else {
    // Invalid or missing ID
    echo json_encode(['success' => false, 'message' => 'Error: Invalid or missing student ID.']);
}

$conn->close();
?>
