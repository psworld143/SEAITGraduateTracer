<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "graduate_tracer";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $batchId = $_POST['id'];

    // Example: Update the batch status to 'archived'
    $stmt = $conn->prepare("UPDATE batches SET status = 'archived' WHERE id = ?");
    $stmt->bind_param("i", $batchId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Batch archived successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to archive batch.']);
    }

    $stmt->close();
    $conn->close();
}
?>