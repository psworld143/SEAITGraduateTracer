<?php
// Database connection
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "graduate_tracer";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST request
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$course = $_POST['course'];
$email = $_POST['email'];

// Insert into database
$sql = "INSERT INTO students (first_name, last_name, course, email) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $firstName, $lastName, $course, $email);

if ($stmt->execute()) {
    $lastId = $stmt->insert_id; // Get the last inserted ID
    echo json_encode([
        'success' => true,
        'student' => [
            'id' => $lastId,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'course' => $course,
            'email' => $email
        ]
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to add student.']);
}

$stmt->close();
$conn->close();
?>