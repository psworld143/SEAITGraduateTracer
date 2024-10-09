<?php
// Include database connection
include('../db_conn.php');

// Function to sanitize and validate inputs
function sanitizeInput($conn, $data) {
    return mysqli_real_escape_string($conn, strip_tags($data));
}

// Function to log errors
function logError($message) {
    error_log($message . "\n", 3, "errors.log");
}

// Get and sanitize inputs
$newsTitle = sanitizeInput($conn, $_POST['newsTitle']);
$newsDescription = sanitizeInput($conn, $_POST['newsDescription']);

// Initialize image path
$imagePath = '';

// Handle file upload
$companyLogo = null; // Default value
if (isset($_FILES['newsImage']) && $_FILES['newsImage']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['newsImage']['tmp_name'];
    $fileName = $_FILES['newsImage']['name'];
    $fileSize = $_FILES['newsImage']['size'];
    $fileType = $_FILES['newsImage']['type'];
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

    // Validate file type and size
    if (in_array($fileType, $allowedTypes) && $fileSize <= 2 * 1024 * 1024) { // Limit size to 2MB
        $uploadDir = '../uploads/';
        $filePath = $uploadDir . uniqid() . '-' . basename($fileName); // Unique filename to prevent overwriting

        // Ensure the uploads directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true); // Create directory with appropriate permissions
        }

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($fileTmpPath, $filePath)) {
            $companyLogo = $filePath;
        } else {
            throw new Exception('File upload failed.');
        }
    } else {
        throw new Exception('Invalid file type or size exceeds 2MB. Only JPG, PNG, and GIF files are allowed.');
    }
}

// Prepare the SQL statement to prevent SQL injection
$sql = "INSERT INTO news (title, description, image) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sss", $newsTitle, $newsDescription, $companyLogo);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'message' => 'News posted successfully!']);
    } else {
        logError("Error posting news: " . mysqli_stmt_error($stmt));
        echo json_encode(['success' => false, 'message' => 'Error posting news.']);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    logError("Error preparing statement: " . mysqli_error($conn));
    echo json_encode(['success' => false, 'message' => 'Error preparing statement.']);
}

// Close the database connection
mysqli_close($conn);
?>
