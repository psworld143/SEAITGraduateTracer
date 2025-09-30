<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Start output buffering
ob_start();

include('../db_conn.php');  // Your database connection file

// Check if the database connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the ID parameter is set
if (!isset($_GET['id'])) {
    die("Error: No ID provided");
}

$id = $_GET['id'];

// Validate the ID
if (!is_numeric($id)) {
    die("Error: Invalid ID format");
}

$sql = "SELECT * FROM news WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("i", $id);

if (!$stmt->execute()) {
    die("Error executing statement: " . $stmt->error);
}

$result = $stmt->get_result();

if (!$result) {
    die("Error getting result: " . $stmt->error);
}

$news = $result->fetch_assoc();

if (!$news) {
    die("No news found with ID: " . $id);
}

// Rename the keys to match what the JavaScript expects
$news['newsTitle'] = $news['title'];
$news['newsDescription'] = $news['description'];
$news['newsImage'] = $news['image'];

// Remove the original keys
unset($news['title'], $news['description'], $news['image']);

// Capture any output
$output = ob_get_clean();

// If there was any output, include it in the response
if (!empty($output)) {
    $response = [
        'success' => false,
        'message' => 'Error occurred',
        'debug' => $output,
        'data' => null
    ];
} else {
    $response = [
        'success' => true,
        'message' => 'News fetched successfully',
        'debug' => null,
        'data' => $news
    ];
}

echo json_encode($response);
?>