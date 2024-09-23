<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "graduate_tracer";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if `id` is passed and is a valid number
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $student_id = intval($_POST['id']);

    // Prepare the SQL query to delete the student by `id`
    $deleteQuery = "DELETE FROM students WHERE id = ?";
    if ($stmt = $conn->prepare($deleteQuery)) {
        $stmt->bind_param('i', $student_id);
        
        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'error: Could not execute query.';
        }

        $stmt->close();
    } else {
        echo 'error: Could not prepare statement.';
    }
} else {
    echo 'error: Invalid or missing student ID.';
}

$conn->close();
?>
