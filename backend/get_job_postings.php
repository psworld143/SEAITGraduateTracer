<?php
$servername = "localhost"; // Change to your DB server
$username = "root"; // Change to your DB username
$password = ""; // Change to your DB password
$dbname = "graduate_tracer"; // Change to your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode([]));
}

$sql = "SELECT * FROM job_postings WHERE status='active' ORDER BY datePosted DESC";
$result = $conn->query($sql);

$jobPostings = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $jobPostings[] = $row;
    }
}

echo json_encode($jobPostings);
$conn->close();
?>
