<?php
include('../db_conn.php');

// Get User Details Endpoint (get_user.php)
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    
    $stmt = $conn->prepare("SELECT id, firstname, middlename, lastname, username FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            echo json_encode(['success' => true, 'data' => $row]);
        } else {
            echo json_encode(['success' => false, 'message' => 'User not found']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to fetch user data']);
    }
    
    $stmt->close();
}
?>