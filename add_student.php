<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $course = $_POST['course'];
    $email = $_POST['email'];

    // Prepare an SQL statement
    $stmt = $conn->prepare("INSERT INTO students (first_name, last_name, course, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $firstName, $lastName, $course, $email);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Student added successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error adding student."]);
    }

    $stmt->close();
    $conn->close();
}
?>
