<?php
// Ensure no output before headers
ob_start();

header('Content-Type: application/json');
require_once '../db_conn.php';

try {
    $batchId = isset($_GET['batch_id']) ? $_GET['batch_id'] : 'all';
    
    // Base query conditions
    $whereClause = $batchId !== 'all' ? "AND s.batch_id = ?" : "";
    $params = $batchId !== 'all' ? [$batchId] : [];
    $paramTypes = $batchId !== 'all' ? "i" : "";

    // Get total students for the batch
    $totalStudentsQuery = "SELECT COUNT(*) as total FROM students s WHERE 1=1 $whereClause";
    $stmt = $conn->prepare($totalStudentsQuery);
    if ($batchId !== 'all') {
        $stmt->bind_param($paramTypes, ...$params);
    }
    if (!$stmt->execute()) {
        throw new Exception("Error executing total students query: " . $stmt->error);
    }
    $result = $stmt->get_result();
    if (!$result) {
        throw new Exception("Error getting total students result");
    }
    $totalStudents = $result->fetch_assoc()['total'];

    // If no students in the batch, return no data
    if ($totalStudents == 0) {
        echo json_encode([
            'success' => true,
            'noData' => true,
            'message' => 'No available data for this batch'
        ]);
        exit;
    }

    // Get survey submissions for the batch
    $submissionsQuery = "
        SELECT COUNT(DISTINCT s.id) as total 
        FROM students s
        WHERE EXISTS (
            SELECT 1 FROM first_job_related_to_course fj WHERE fj.student_id = s.id
            UNION
            SELECT 1 FROM present_employment_status pes WHERE pes.student_id = s.id
        )
        $whereClause";
    $stmt = $conn->prepare($submissionsQuery);
    if ($batchId !== 'all') {
        $stmt->bind_param($paramTypes, ...$params);
    }
    if (!$stmt->execute()) {
        throw new Exception("Error executing submissions query: " . $stmt->error);
    }
    $result = $stmt->get_result();
    if (!$result) {
        throw new Exception("Error getting submissions result");
    }
    $recentSubmissions = $result->fetch_assoc()['total'];

    // Get employment rate for the batch
    $employmentQuery = "
        SELECT COUNT(DISTINCT s.id) as employed 
        FROM students s
        INNER JOIN present_employment_status pes ON s.id = pes.student_id
        WHERE pes.employment_status_current != 'Unemployed'
        $whereClause";
    $stmt = $conn->prepare($employmentQuery);
    if ($batchId !== 'all') {
        $stmt->bind_param($paramTypes, ...$params);
    }
    if (!$stmt->execute()) {
        throw new Exception("Error executing employment query: " . $stmt->error);
    }
    $result = $stmt->get_result();
    if (!$result) {
        throw new Exception("Error getting employment result");
    }
    $employedCount = $result->fetch_assoc()['employed'];

    // Get employment sector data for the batch
    $sectorQuery = "
        SELECT 
            COUNT(CASE WHEN pow.local_place IS NOT NULL AND pow.local_place != '' THEN 1 END) as government,
            COUNT(CASE WHEN pow.abroad_place IS NOT NULL AND pow.abroad_place != '' THEN 1 END) as non_government,
            COUNT(*) as total
        FROM students s
        INNER JOIN present_employment_status pes ON s.id = pes.student_id
        LEFT JOIN place_of_work pow ON s.id = pow.student_id
        WHERE pes.employment_status_current != 'Unemployed'
        $whereClause";
    $stmt = $conn->prepare($sectorQuery);
    if ($batchId !== 'all') {
        $stmt->bind_param($paramTypes, ...$params);
    }
    if (!$stmt->execute()) {
        throw new Exception("Error executing sector query: " . $stmt->error);
    }
    $result = $stmt->get_result();
    if (!$result) {
        throw new Exception("Error getting sector result");
    }
    $sectorData = $result->fetch_assoc();
    $governmentPercentage = $sectorData['total'] > 0 ? round(($sectorData['government'] / $sectorData['total']) * 100) : 0;
    $nonGovernmentPercentage = $sectorData['total'] > 0 ? round(($sectorData['non_government'] / $sectorData['total']) * 100) : 0;

    // Calculate rates
    $responseRate = $totalStudents > 0 ? round(($recentSubmissions / $totalStudents) * 100) : 0;
    $employmentRate = $recentSubmissions > 0 ? round(($employedCount / $recentSubmissions) * 100) : 0;

    // Clear any output buffer
    ob_clean();
    
    echo json_encode([
        'success' => true,
        'noData' => false,
        'totalStudents' => $totalStudents,
        'responseRate' => $responseRate,
        'employmentRate' => $employmentRate,
        'governmentPercentage' => $governmentPercentage,
        'nonGovernmentPercentage' => $nonGovernmentPercentage
    ]);

} catch (Exception $e) {
    // Clear any output buffer
    ob_clean();
    
    error_log("Error in get_batch_statistics.php: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
} finally {
    if (isset($stmt)) {
        $stmt->close();
    }
    $conn->close();
    // End output buffering
    ob_end_flush();
}
?> 