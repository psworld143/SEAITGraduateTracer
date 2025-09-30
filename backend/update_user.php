<?php
include('../db_conn.php');

// Update User Endpoint (update_user.php)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
    $firstname = trim($_POST['firstname']);
    $middlename = trim($_POST['middlename']);
    $lastname = trim($_POST['lastname']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Start building the query
    if (!empty($password)) {
        // Update including password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE users SET firstname=?, middlename=?, lastname=?, username=?, password=? WHERE id=?");
        $stmt->bind_param("sssssi", $firstname, $middlename, $lastname, $username, $hashed_password, $user_id);
    } else {
        // Update without password
        $stmt = $conn->prepare("UPDATE users SET firstname=?, middlename=?, lastname=?, username=? WHERE id=?");
        $stmt->bind_param("ssssi", $firstname, $middlename, $lastname, $username, $user_id);
    }

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update user: ' . $stmt->error]);
    }

    $stmt->close();
}

$conn->close();
?>