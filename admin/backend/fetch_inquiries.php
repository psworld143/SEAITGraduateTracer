<?php
include('../db_conn.php');
header('Content-Type: application/json');

try {
    $query = "SELECT 
                di.*,
                DATE_FORMAT(di.created_at, '%Y-%m-%d %H:%i:%s') as date_requested,
                DATE_FORMAT(di.completion_date, '%Y-%m-%d %H:%i:%s') as completed_date
              FROM document_inquiries di
              ORDER BY di.created_at DESC";
              
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        throw new Exception(mysqli_error($conn));
    }
    
    $inquiries = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $inquiries[] = array(
            'id' => $row['id'],
            'student_name' => $row['requester_name'],
            'document_type' => $row['document_type'],
            'date_requested' => $row['date_requested'],
            'completion_date' => $row['completed_date'],
            'status' => $row['status'],
            'remarks' => $row['remarks'],
            'email' => $row['requester_email']
        );
    }
    
    echo json_encode($inquiries);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

mysqli_close($conn);
?>