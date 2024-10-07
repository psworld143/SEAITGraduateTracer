<?php
include("db_conn.php");

// Function to fetch news from the database
function fetchNews($conn) {
    $sql = "SELECT id, title AS news_title, description AS news_description, image AS news_image, created_at FROM news";
    $result = $conn->query($sql);

    if (!$result) {
        die("Query failed: " . $conn->error); // Error handling
    }
    return $result;
}

$result = fetchNews($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>News Dashboard - Admin</title>
    <meta content="Manage and view school news and updates" name="description">
    <meta content="news, dashboard, updates, management" name="keywords">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/static.css" rel="stylesheet">
</head>

<body>
    <?php include('inc/header.php'); ?>

    <main>
    <div class="container-sm"></div>

    <div class="container">
        <section class="section">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <!-- Header -->
                    <div class="d-flex justify-content-center py-4">
                        <h1 class="d-none d-lg-block">News Dashboard</h1>
                    </div>

                    <!-- Loop through each news item and display -->
                    <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="card mb-4 shadow-sm border-light" style="border-radius: 15px;">
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold; font-size: 1.2rem;">
                                <?php echo htmlspecialchars($row['news_title']); ?></h5>

                            <div class="card-text" style="font-size: 0.95rem; color: #555;">
                                <?php
                                // Strip HTML tags and convert new lines to <br>
                                $description = strip_tags($row['news_description']); // Remove HTML tags
                                echo nl2br(htmlspecialchars($description)); // Convert new lines and escape special characters
                                ?>
                            </div>
                            
                            <?php if (!empty($row['news_image'])): ?>
                            <img src="<?php echo htmlspecialchars($row['news_image']); ?>" class="img-fluid rounded"
                                alt="News Image" style="margin-top: 10px; border-radius: 15px;">
                            <?php else: ?>
                            <img src="path/to/default/image.jpg" class="img-fluid rounded"
                                alt="Default News Image" style="margin-top: 10px; border-radius: 15px;">
                            <?php endif; ?>
                            
                            <p class="card-text">
                                <small class="text-muted">Posted on 
                                    <?php echo date("F j, Y", strtotime($row['created_at'])); ?></small>
                            </p>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php else: ?>
                    <p>No news available at the moment.</p>
                    <?php endif; ?>

                </div>
            </div>
        </section>
    </div>
</main>


    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>

<?php
$conn->close();
?>
