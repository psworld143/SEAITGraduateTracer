<?php
include('../db_conn.php');

// Check if the required fields are present
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $course = $_POST['course'] ?? '';
    $email = $_POST['email'] ?? '';
    $batch_id = $_POST['batch_id'] ?? 0; // Get batch_id from the form

    // Prepare an insert statement
    $insert_query = "INSERT INTO students (first_name, last_name, course, email, batch_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param('ssssi', $firstName, $lastName, $course, $email, $batch_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Student added successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add student.']);
    }
    $stmt->close();
}

$conn->close();
?>
