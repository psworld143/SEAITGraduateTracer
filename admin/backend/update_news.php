<?php
include('../db_conn.php');  // Your database connection file

$response = ['success' => false, 'message' => ''];

try {
    $newsId = $_POST['newsId'];
    $title = $_POST['newsTitle'];
    $description = $_POST['newsDescription'];
    $imagePath = null;

    // Check if a new image is uploaded
    if (isset($_FILES['newsImage']) && $_FILES['newsImage']['error'] == 0) {
        $targetDir = "../uploads/";  // Make sure this directory exists and is writable
        $imagePath = $targetDir . basename($_FILES["newsImage"]["name"]);
        if (!move_uploaded_file($_FILES["newsImage"]["tmp_name"], $imagePath)) {
            throw new Exception("Failed to upload image.");
        }
        $imagePath = "uploads/" . basename($_FILES["newsImage"]["name"]); // Store relative path in DB
    }

    // Update query
    if ($imagePath) {
        $sql = "UPDATE news SET title = ?, description = ?, image = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $title, $description, $imagePath, $newsId);
    } else {
        $sql = "UPDATE news SET title = ?, description = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $title, $description, $newsId);
    }

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'News updated successfully';
    } else {
        throw new Exception("Failed to update news: " . $stmt->error);
    }
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>