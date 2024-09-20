<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "graduate_tracer";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

$sql = "SELECT id, batch_name, year_graduated FROM batches";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $batches = [];
    while ($row = $result->fetch_assoc()) {
        $batches[] = $row;
    }
    echo json_encode(['success' => true, 'data' => $batches]);
} else {
    echo json_encode(['success' => false, 'message' => 'No batches found']);
}

$conn->close();
?>
