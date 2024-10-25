<?php
include('../db_conn.php');

// Check if the required fields are present
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input data
    $schoolID = $_POST['schoolID'] ?? ''; // School ID
    $fullName = $_POST['fullName'] ?? ''; // Full Name
    $course = $_POST['course'] ?? ''; // Course
    $email = $_POST['email'] ?? ''; // Email
    $departmentCode = $_POST['departmentCode'] ?? ''; // Department Code
    $controlCode = $_POST['controlCode'] ?? ''; // Control Code
    $batch_id = $_POST['batch_id'] ?? 0; // Get batch_id from the form

    // Prepare an insert statement
    $insert_query = "INSERT INTO students (school_id, full_name, course, department_code, control_code, email, batch_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);

    // Bind parameters to the statement
    $stmt->bind_param('ssssssi', $schoolID, $fullName, $course, $departmentCode, $controlCode, $email, $batch_id);

    // Execute the statement and return a response
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Student added successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add student.']);
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
