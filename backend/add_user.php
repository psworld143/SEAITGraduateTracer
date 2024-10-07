<?php
include('../db_conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $con->real_escape_string($_POST['firstname']);
    $middlename = $con->real_escape_string($_POST['middlename']);
    $lastname = $con->real_escape_string($_POST['lastname']);
    $username = $con->real_escape_string($_POST['username']);
    $account_type = $con->real_escape_string($_POST['account_type']);
    $email = $con->real_escape_string($_POST['email']);

    $query = "INSERT INTO user (firstname, middlename, lastname, username, account_type, email) VALUES ('$firstname', '$middlename', '$lastname', '$username', '$account_type', '$email')";

    if ($con->query($query) === TRUE) {
        echo "User added successfully";
    } else {
        echo "Error: " . $query . "<br>" . $con->error;
    }

    $con->close();
    header("Location: ../index.php"); // Redirect after adding
    exit();
}
?>
