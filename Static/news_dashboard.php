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
    <title>News Dashboard</title>
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
                        <div class="d-flex justify-content-center py-4">
                            <span class="d-none d-lg-block h1">News Dashboard</span>
                        </div>

                        <!-- News Items -->
                        <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="card mb-4 shadow-sm border-light" style="border-radius: 15px;">
                            <div class="card-body">
                                <h5 class="card-title fw-bold fs-5">
                                    <?php echo htmlspecialchars($row['news_title']); ?>
                                </h5>

                                <div class="card-text text-muted" style="font-size: 0.95rem;">
                                    <?php
                                    $description = strip_tags($row['news_description']);
                                    $formattedDescription = nl2br(htmlspecialchars($description));
                                    $paragraphs = explode("\n", $formattedDescription);
                                    
                                    foreach ($paragraphs as $paragraph) {
                                        if (trim($paragraph) !== '') {
                                            echo "<p>" . $paragraph . "</p>";
                                        }
                                    }
                                    ?>
                                </div>

                                <?php if (!empty($row['news_image'])): ?>
                                <img src="<?php echo htmlspecialchars($row['news_image']); ?>" alt="News Image"
                                    class="img-fluid mt-2" style="border-radius: 15px;" data-bs-toggle="modal"
                                    data-bs-target="#imageModal-<?php echo $row['id']; ?>">
                                <?php endif; ?>

                                <!-- Modal Structure -->
                                <div class="modal fade" id="imageModal-<?php echo $row['id']; ?>" tabindex="-1"
                                    aria-labelledby="imageModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <!-- Use modal-xl for extra-large size -->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="imageModalLabel">News Image</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <!-- Center the image in the modal -->
                                                <img src="<?php echo htmlspecialchars($row['news_image']); ?>"
                                                    alt="News Image" class="img-fluid"
                                                    style="border-radius: 15px; max-height: 90vh; width: 100%;">
                                                <!-- Make the image fill the modal -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <p class="card-text">
                                    <small class="text-muted">Posted on
                                        <?php echo date("F j, Y", strtotime($row['created_at'])); ?></small>
                                </p>

                                <!-- Like and Comment Section -->
                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col text-center">
                                            <button class="btn btn-outline-primary w-100 border-0">
                                                <i class="bi bi-hand-thumbs-up"></i> Like
                                            </button>
                                        </div>
                                        <div class="col text-center">
                                            <button class="btn btn-outline-secondary w-100 border-0"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#commentSection-<?php echo $row['id']; ?>"
                                                aria-expanded="false">
                                                <i class="bi bi-chat-dots"></i> Comment
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Comment Section -->
                                <div class="collapse mt-3" id="commentSection-<?php echo $row['id']; ?>">
                                    <textarea class="form-control" rows="3" placeholder="Write a comment..."></textarea>
                                    <button class="btn btn-primary mt-2">Submit</button>
                                </div>

                            </div>

                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php else: ?>
                    <p class="text-center">No news available at the moment.</p>
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