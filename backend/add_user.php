<?php
include('../db_conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the data from the POST request
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $account_type = $_POST['account_type'];
    $email = $_POST['email'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO user (firstname, middlename, lastname, username, account_type, email) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $firstname, $middlename, $lastname, $username, $account_type, $email);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'User added successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add user.']);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
