<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "graduate_tracer";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error]));
}

// Set parameters from POST request
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$course = $_POST['course'];
$email = $_POST['email'];
$batch_id = $_POST['batch_id'];

// Check if the email already exists in the database
$checkStmt = $conn->prepare("SELECT id FROM students WHERE email = ?");
$checkStmt->bind_param("s", $email);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    // Email already exists, return an error response
    echo json_encode(['status' => 'error', 'message' => 'Email already exists.']);
} else {
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO students (first_name, last_name, course, email, batch_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $first_name, $last_name, $course, $email, $batch_id);

    // Execute query and check for errors
    if ($stmt->execute()) {
        // Return success response
        echo json_encode(['status' => 'success', 'message' => 'Student added successfully']);
    } else {
        // Return error response
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
