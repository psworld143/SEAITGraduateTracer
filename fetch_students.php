<?php
include('db.php');

// Set content type to application/json
header('Content-Type: application/json');

// Fetch students from the database
$query = "SELECT * FROM students";
$result = $conn->query($query);

if (!$result) {
    // Return an error if the query fails
    echo json_encode(['status' => 'error', 'message' => 'Database query failed: ' . $conn->error]);
    $conn->close();
    exit();
}

$students = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

// Return data as JSON
echo json_encode(['status' => 'success', 'data' => $students]);

$conn->close();
?>
