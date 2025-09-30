<?php
include('../db_conn.php');
header('Content-Type: application/json');

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['id'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Inquiry ID is required']);
    exit;
}

$inquiry_id = mysqli_real_escape_string($conn, $data['id']);

try {
    // Start transaction
    mysqli_begin_transaction($conn);
    
    // Delete the inquiry
    $query = "DELETE FROM document_inquiries WHERE id = '$inquiry_id'";
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        throw new Exception(mysqli_error($conn));
    }
    
    if (mysqli_affected_rows($conn) === 0) {
        throw new Exception('Inquiry not found');
    }
    
    // Commit transaction
    mysqli_commit($conn);
    
    echo json_encode([
        'success' => true,
        'message' => 'Inquiry deleted successfully'
    ]);
    
} catch (Exception $e) {
    // Rollback transaction on error
    mysqli_rollback($conn);
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error deleting inquiry: ' . $e->getMessage()
    ]);
}

mysqli_close($conn);
?>