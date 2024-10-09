<?php
include("../db_conn.php");
// Fetch users from the database
$query = "SELECT * FROM user";
$result = $conn->query($query);

// Prepare an array to hold user data
$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

// Return the users as JSON
header('Content-Type: application/json');
echo json_encode($users);

// Close the database connection
$conn->close();
?>