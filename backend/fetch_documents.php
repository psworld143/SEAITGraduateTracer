<?php
// Set the content type to JSON
header('Content-Type: application/json');

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "graduate_tracer";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Query to select all documents without filtering availability_status
    $sql = "SELECT id, document_type, availability_status, release_date FROM documents ORDER BY release_date DESC";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        throw new Exception("Error preparing statement: " . $conn->error);
    }

    if (!$stmt->execute()) {
        throw new Exception("Error executing statement: " . $stmt->error);
    }

    $result = $stmt->get_result();
    $documents = [];

    while ($row = $result->fetch_assoc()) {
        $row['release_date'] = date('Y-m-d', strtotime($row['release_date']));
        $documents[] = $row;
    }

    echo json_encode($documents);

} catch (Exception $e) {
    error_log('Error in fetch_documents.php: ' . $e->getMessage());
    echo json_encode(['error' => 'An error occurred while fetching documents: ' . $e->getMessage()]);
} finally {
    if (isset($stmt)) {
        $stmt->close();
    }
    if (isset($conn)) {
        $conn->close();
    }
}
?>
