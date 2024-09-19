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

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $batchName = $_POST['batchName'];
    $yearGraduated = $_POST['yearGraduated'];

    // Validate inputs
    if (empty($batchName) || empty($yearGraduated)) {
        echo json_encode(['success' => false, 'message' => 'Please fill out all fields.']);
        exit;
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO batches (batch_name, year_graduated) VALUES (?, ?)");
    $stmt->bind_param("ss", $batchName, $yearGraduated);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Batch added successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add batch.']);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
