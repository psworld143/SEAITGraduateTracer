<?php
// Database connection
$servername = "localhost"; // Change to your DB server
$username = "root"; // Change to your DB username
$password = ""; // Change to your DB password
$dbname = "graduate_tracer"; // Change to your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO students (first_name, last_name, course, email, batch_id) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $first_name, $last_name, $course, $email, $batch_id);

// Set parameters and execute
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$course = $_POST['course'];
$email = $_POST['email'];
$batch_id = $_POST['batch_id'];

if ($stmt->execute()) {
    echo 'success';
} else {
    echo 'Error: ' . $stmt->error;
}

$stmt->close();
$conn->close();
?>