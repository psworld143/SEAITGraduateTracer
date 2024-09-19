<?php
// fetch_students.php

header('Content-Type: application/json');
require 'db_connection.php'; // Ensure this file connects to your database

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10; // Number of records per page
$offset = ($page - 1) * $limit;

// Fetch students from the database
$sql = "SELECT * FROM students LIMIT ? OFFSET ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$limit, $offset]);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of students
$sql = "SELECT COUNT(*) FROM students";
$stmt = $pdo->query($sql);
$total = $stmt->fetchColumn();
$totalPages = ceil($total / $limit);

$response = [
    'students' => $students,
    'pagination' => [
        'currentPage' => $page,
        'totalPages' => $totalPages
    ]
];

echo json_encode($response);
?>
