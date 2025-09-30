<?php
header('Content-Type: application/json');

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Include your database connection code here
    include('../db_conn.php');

    if (!isset($conn) || $conn->connect_error) {
        throw new Exception("Database connection failed");
    }

    $batch_id = isset($_GET['batch_id']) ? intval($_GET['batch_id']) : 0;

    if ($batch_id <= 0) {
        throw new Exception("Invalid batch ID");
    }

    // Adjusted query to fetch additional fields
    $query = "SELECT id, school_id, full_name, course, department_code, control_code, email FROM students WHERE batch_id = ?";
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        throw new Exception("Query preparation failed: " . $conn->error);
    }

    $stmt->bind_param('i', $batch_id);
    
    if (!$stmt->execute()) {
        throw new Exception("Query execution failed: " . $stmt->error);
    }

    $result = $stmt->get_result();

    $students = [];
    while ($row = $result->fetch_assoc()) {
        $students[] = [
            'id' => $row['id'],
            'school_id' => $row['school_id'], // Added school_id
            'full_name' => $row['full_name'],
            'course' => $row['course'],
            'department_code' => $row['department_code'], // Added department_code
            'control_code' => $row['control_code'], // Added control_code
            'email' => $row['email']
        ];
    }

    echo json_encode(['success' => true, 'data' => $students]);

} catch (Exception $e) {
    error_log("Error in load_students.php: " . $e->getMessage());
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
} finally {
    if (isset($stmt)) {
        $stmt->close();
    }
    if (isset($conn)) {
        $conn->close();
    }
}
?>