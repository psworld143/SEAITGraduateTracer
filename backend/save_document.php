<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "graduate_tracer";

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Prepare an SQL statement with 4 placeholders for the parameters
$stmt = $conn->prepare("INSERT INTO documents (document_type, availability_status, release_date, additional_instructions) VALUES (?, ?, ?, ?)");

// Bind the parameters to the SQL query
$stmt->bind_param("ssss", $documentType, $availabilityStatus, $releaseDate, $additionalInstructions);

// Assign values to the variables from the POST data
$documentType = $_POST['documentType'];
$availabilityStatus = $_POST['availabilityStatus'];
$releaseDate = $_POST['releaseDate'];
$additionalInstructions = $_POST['additionalInstructions'];

// Execute the prepared statement
if ($stmt->execute()) {
    // Return success response as JSON
    echo json_encode(['status' => 'success', 'message' => 'Document posted successfully']);
} else {
    // Return error response with the statement error
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
}

// Close the statement and the database connection
$stmt->close();
$conn->close();
?>
