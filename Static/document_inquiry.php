<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "graduate_tracer";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch documents from the database
$sql = "SELECT document_type, availability_status, release_date, additional_instructions FROM documents";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Document Inquiry - Admin</title>
    <meta content="Document Inquiry and Status" name="description">
    <meta content="document, availability, status, inquiry" name="keywords">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/static.css" rel="stylesheet">

    <style>
    /* Custom CSS to position the inquiry card */
    .inquiry-container {
        position: absolute;
        /* Use absolute positioning */
        right: 15px;
        /* Positioning from the right */
        top: 105px;
        /* Adjust this value as necessary */
        width: 420px;
        /* Fixed width for the inquiry card */
        padding-right: 10px;
    }
    </style>
</head>

<body>
    <?php include('inc/header.php'); ?>

    <main>
        <div class="container">
            <section class="section">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10">
                        <div class="d-flex justify-content-center py-4">
                            <span class="d-none d-lg-block h1">Document Listings</span>
                        </div>

                        <!-- Loop through each document and display -->
                        <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <strong>Document Type:</strong>
                                    <span
                                        class="text-muted"><?php echo htmlspecialchars($row['document_type']); ?></span>
                                </h5>
                                <div class="mb-3">
                                    <strong>Availability Status:</strong>
                                    <span
                                        class="badge bg-success"><?php echo htmlspecialchars($row['availability_status']); ?></span>
                                </div>
                                <div class="mb-3">
                                    <strong>Release Date:</strong>
                                    <span
                                        class="text-secondary"><?php echo htmlspecialchars($row['release_date']); ?></span>
                                </div>
                                <h6 class="mt-3"><strong>Additional Instructions:</strong></h6>
                                <p class="card-text">
                                    <?php echo nl2br(htmlspecialchars($row['additional_instructions'])); ?>
                                </p>
                            </div>
                        </div>

                        <?php endwhile; ?>
                        <?php else: ?>
                        <p>No documents available at the moment.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        </div>

        <!-- Inquiry Card Section -->
        <div class="inquiry-container">
            <section class="section mb-4">
                <div class="card mb-3 shadow-sm border-light">
                    <div class="card-body">
                        <h5 class="card-title">Document Inquiry</h5>
                        <form action="inquiry_process.php" method="post">
                            <div class="mb-3">
                                <label for="documentType" class="form-label">Document Type</label>
                                <input type="text" class="form-control" id="documentType" name="document_type" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Check Availability</button>
                        </form>
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