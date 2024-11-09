<?php
include("../db_conn.php");

$data = json_decode(file_get_contents("php://input"));
$id = $data->id;

if ($id) {
    $sql = "DELETE FROM job_postings WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Job posting deleted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid job ID.']);
}

$conn->close();
?>
