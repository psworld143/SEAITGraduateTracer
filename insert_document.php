<?php
include('db.php'); // Ensure this includes the connection to your database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $documentType = $_POST['documentType'];
    $availabilityStatus = $_POST['availabilityStatus'];
    $releaseDate = $_POST['releaseDate'];
    $additionalInstructions = $_POST['additionalInstructions'];

    // Prepare an SQL statement to insert data into 'documents' table
    $stmt = $conn->prepare("INSERT INTO documents (document_type, availability_status, release_date, additional_instructions) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $documentType, $availabilityStatus, $releaseDate, $additionalInstructions);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Document inquiry posted successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error posting document inquiry."]);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
