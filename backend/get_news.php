<?php
// Include database connection
include('../db_conn.php');

// Initialize an empty array for storing news
$news = [];

// Execute the query and check for errors
$result = mysqli_query($conn, "SELECT * FROM news");

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $news[] = [
            'id' => $row['id'],
            'newsTitle' => $row['title'],
            'newsDescription' => $row['description'],
            'newsImage' => $row['image']
        ];
    }

    // Return the result as JSON
    echo json_encode($news);
} else {
    // In case of a query error, return an error response
    echo json_encode([
        'success' => false,
        'message' => 'Error retrieving news: ' . mysqli_error($conn)
    ]);
}

// Close the database connection
mysqli_close($conn);
?>
