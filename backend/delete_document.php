<?php
$servername = "localhost"; // Change to your DB server
$username = "root"; // Change to your DB username
$password = ""; // Change to your DB password
$dbname = "graduate_tracer"; // Change to your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed.']));
}

$input = json_decode(file_get_contents('php://input'), true);
$documentId = $input['id'] ?? null;

if ($documentId) {
    // Check if the document exists
    $checkStmt = $conn->prepare("SELECT id FROM documents WHERE id = ?");
    $checkStmt->bind_param('i', $documentId);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        // Prepare the delete statement using MySQLi
        $stmt = $conn->prepare("DELETE FROM documents WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param('i', $documentId);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Document deleted successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Could not delete the document.']);
            }

            $stmt->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the SQL statement.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No document found with that ID.']);
    }

    $checkStmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}

$conn->close();
?>
