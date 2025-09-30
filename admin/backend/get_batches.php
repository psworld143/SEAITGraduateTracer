<?php
include('../db_conn.php');
header('Content-Type: application/json');

try {
    // Query to get all active batches
    $sql = "SELECT id, batch_name, year_graduated FROM batches WHERE is_archived = 0 ORDER BY year_graduated DESC";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $batches = [];
    while ($row = $result->fetch_assoc()) {
        $batches[] = [
            'id' => $row['id'],
            'batch_name' => $row['batch_name'],
            'year_graduated' => $row['year_graduated']
        ];
    }
    
    echo json_encode([
        'success' => true,
        'data' => $batches
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
} finally {
    if (isset($stmt)) {
        $stmt->close();
    }
    $conn->close();
}
?>
