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
</head>

<body>
    <?php include('inc/header.php'); ?>

    <main>
        <div class="container-sm"></div>

        <div class="container">
            <section class="section min-vh-100 d-flex flex-column align-items-center justify-content-center">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 d-flex flex-column align-items-center justify-content-center">
                        <!-- Header -->
                        <div class="d-flex justify-content-center py-4">
                            <span class="d-none d-lg-block h1">Document Inquiry</span>
                        </div>

                        <!-- Loop through each document and display -->
                        <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="card mb-3 shadow-sm border-light">
                            <div class="card-body">
                                <h5 class="card-title"><strong>Document Type:
                                        <?php echo htmlspecialchars($row['document_type']); ?></strong></h5>
                                <p class="card-text"><strong>Availability Status:</strong>
                                    <?php echo htmlspecialchars($row['availability_status']); ?></p>
                                <p class="card-text"><strong>Release Date:</strong>
                                    <?php echo htmlspecialchars($row['release_date']); ?></p>
                                <p class="card-text"><strong>Additional Instructions:</strong></p>
                                <p class="card-text"><?php echo htmlspecialchars($row['additional_instructions']); ?>
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