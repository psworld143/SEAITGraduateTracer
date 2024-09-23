<?php
$servername = "localhost"; // Change to your DB server
$username = "root"; // Change to your DB username
$password = ""; // Change to your DB password
$dbname = "graduate_tracer"; // Change to your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from AJAX request
$documentType = $_POST['documentType'];
$availabilityStatus = $_POST['availabilityStatus'];
$releaseDate = $_POST['releaseDate'];
$additionalInstructions = $_POST['additionalInstructions'];

// Insert data into database
$sql = "INSERT INTO documents (document_type, availability_status, release_date, additional_instructions)
VALUES ('$documentType', '$availabilityStatus', '$releaseDate', '$additionalInstructions')";

if ($conn->query($sql) === TRUE) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Document posted successfully',
        'data' => [
            'documentType' => $documentType,
            'availabilityStatus' => $availabilityStatus,
            'releaseDate' => $releaseDate,
        ],
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => $conn->error]);
}

$conn->close();
?>
