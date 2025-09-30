<?php
$servername = "localhost";
$username = "alum_graduate_tracer";
$password = "020894GraduateTracer";
$dbname = "alum_graduate_tracer";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
