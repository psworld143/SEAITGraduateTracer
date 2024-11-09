<?php
include('../db_conn.php');

// Handle POST request to add a new user
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize inputs
    $firstname = trim($_POST['firstname']);
    $middlename = trim($_POST['middlename']);
    $lastname = trim($_POST['lastname']);
    $username = trim($_POST['username']);
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT); // Hash the password
    $user_type = trim($_POST['user_type']); // Get the user type (admin or student)

    // Validate user_type (ensure it is either 'admin' or 'student')
    if (!in_array($user_type, ['admin', 'student'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid user type']);
        exit;
    }

    // Prepare and bind the statement
    $stmt = $conn->prepare("INSERT INTO users (firstname, middlename, lastname, username, password, user_type) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $firstname, $middlename, $lastname, $username, $password, $user_type);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database insertion failed: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

$conn->close();
?>
