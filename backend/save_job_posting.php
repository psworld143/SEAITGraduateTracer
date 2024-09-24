<?php
$servername = "localhost"; // Change to your DB server
$username = "root"; // Change to your DB username
$password = ""; // Change to your DB password
$dbname = "graduate_tracer"; // Change to your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO job_postings (jobTitle, jobDescription, qualifications, applicationDeadline, contactInfo, fileUpload) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $jobTitle, $jobDescription, $qualifications, $applicationDeadline, $contactInfo, $fileUpload);

// Set parameters from POST data
$jobTitle = $_POST['jobTitle'];
$jobDescription = $_POST['jobDescription'];
$qualifications = $_POST['qualifications'];
$applicationDeadline = $_POST['applicationDeadline'];
$contactInfo = $_POST['contactInfo'];

// Handle file upload
$fileUpload = null; // Initialize fileUpload variable
if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] == UPLOAD_ERR_OK) {
    $targetDir = "uploads/"; // Ensure this directory exists and is writable
    $fileName = basename($_FILES["fileUpload"]["name"]);
    $fileUpload = $targetDir . uniqid() . "_" . $fileName; // Unique file name to avoid collisions
    move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $fileUpload); // Move uploaded file
}

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Job posting added successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
