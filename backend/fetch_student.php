<?php
// Database connection
$servername = "localhost"; // Update your DB server
$username = "root"; // Update your DB username
$password = ""; // Update your DB password
$dbname = "graduate_tracer"; // Update your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get and sanitize batch ID
$batch_id = isset($_GET['batch_id']) ? intval($_GET['batch_id']) : 0;

if ($batch_id > 0) {
    // SQL query to fetch students
    $sql = "SELECT id, first_name, last_name, course, email FROM students WHERE batch_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $batch_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $students = array();
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }

        $stmt->close();
    } else {
        echo json_encode(array("error" => "Failed to prepare statement."));
        exit();
    }
} else {
    echo json_encode(array("error" => "Invalid batch ID."));
    exit();
}

$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($students);
?>
