<?php
// Include database connection
include('../db_conn.php');

// Function to sanitize and validate inputs
function sanitizeInput($conn, $data) {
    return mysqli_real_escape_string($conn, strip_tags($data));
}

// Get and sanitize inputs
$newsTitle = sanitizeInput($conn, $_POST['newsTitle']);
$newsDescription = sanitizeInput($conn, $_POST['newsDescription']);

// Initialize image path
$imagePath = '';

// Handle image upload securely
if (isset($_FILES['newsImage']) && $_FILES['newsImage']['error'] === 0) {
    $image = $_FILES['newsImage'];

    // Ensure the uploads directory exists
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); // Create directory with appropriate permissions
    }

    // Generate a unique filename
    $imageFileName = uniqid() . '-' . basename($image['name']);
    $imagePath = $uploadDir . $imageFileName;

    // Validate the file type
    $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (in_array($image['type'], $allowedFileTypes)) {
        // Move the uploaded file to the correct directory
        if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
            echo json_encode(['success' => false, 'message' => 'Error uploading image.']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid image type.']);
        exit;
    }
}

// Prepare the SQL statement to prevent SQL injection
$sql = "INSERT INTO news (title, description, image) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sss", $newsTitle, $newsDescription, $imagePath);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'message' => 'News posted successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error posting news.']);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['success' => false, 'message' => 'Error preparing statement.']);
}

// Close the database connection
mysqli_close($conn);
?>
