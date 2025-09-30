<?php
include('../db_conn.php');

// Prepare and execute the SQL query
$sql = "SELECT id, firstname, middlename, lastname, username FROM users"; // Added ID for possible deletion
$result = $conn->query($sql);

// Initialize an empty array to hold user data
$users = array();

if ($result->num_rows > 0) {
    // Fetch all user data
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

// Return the user data as JSON
echo json_encode($users);

// Close the connection
$conn->close();
?>
