<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "graduate_tracer";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$yearGraduated = $_POST['year_graduated'];
$course = $_POST['course'];
$email = $_POST['email'];

$sql = "INSERT INTO students (first_name, last_name, year_graduated, course, email) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $firstName, $lastName, $yearGraduated, $course, $email);

if ($stmt->execute()) {
    echo "Student added successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
