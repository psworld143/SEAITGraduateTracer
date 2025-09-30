<?php
include('../db_conn.php');
header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Inquiry ID is required']);
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

try {
    $query = "SELECT 
                *,
                DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') as date_requested,
                DATE_FORMAT(completion_date, '%Y-%m-%d %H:%i:%s') as completed_date
              FROM document_inquiries 
              WHERE id = '$id'";
              
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        throw new Exception(mysqli_error($conn));
    }
    
    $inquiry = mysqli_fetch_assoc($result);
    
    if (!$inquiry) {
        http_response_code(404);
        echo json_encode(['error' => 'Inquiry not found']);
        exit;
    }
    
    // Format the response
    $response = array(
        'id' => $inquiry['id'],
        'student_name' => $inquiry['requester_name'],
        'document_type' => $inquiry['document_type'],
        'date_requested' => $inquiry['date_requested'],
        'completion_date' => $inquiry['completed_date'],
        'status' => $inquiry['status'],
        'remarks' => $inquiry['remarks'],
        'email' => $inquiry['requester_email'],
        'user_type' => $inquiry['user_type']
    );
    
    echo json_encode($response);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

mysqli_close($conn);
?>