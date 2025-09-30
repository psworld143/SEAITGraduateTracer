<?php
include('../db_conn.php');
header('Content-Type: application/json');

// Check if required data is provided
if (!isset($_POST['inquiry_id']) || !isset($_POST['status'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Inquiry ID and status are required']);
    exit;
}

$inquiry_id = mysqli_real_escape_string($conn, $_POST['inquiry_id']);
$status = mysqli_real_escape_string($conn, $_POST['status']);
$remarks = isset($_POST['remarks']) ? mysqli_real_escape_string($conn, $_POST['remarks']) : '';
$current_time = date('Y-m-d H:i:s');

try {
    // Start transaction
    mysqli_begin_transaction($conn);
    
    // Update the inquiry status
    $update_query = "UPDATE document_inquiries SET 
                        status = '$status',
                        remarks = '$remarks',
                        updated_at = '$current_time'";
    
    // If status is 'completed', set completion date
    if ($status === 'completed') {
        $update_query .= ", completion_date = '$current_time'";
    }
    
    $update_query .= " WHERE id = '$inquiry_id'";
    
    $result = mysqli_query($conn, $update_query);
    
    if (!$result) {
        throw new Exception(mysqli_error($conn));
    }
    
    // Commit transaction
    mysqli_commit($conn);
    
    echo json_encode([
        'success' => true,
        'message' => 'Inquiry status updated successfully'
    ]);
    
} catch (Exception $e) {
    // Rollback transaction on error
    mysqli_rollback($conn);
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error updating inquiry status: ' . $e->getMessage()
    ]);
}

mysqli_close($conn);
?>