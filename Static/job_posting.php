<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Job Postings - SEAIT</title>
    <meta content="Job listings and opportunities" name="description">
    <meta content="jobs, career, SEAIT" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600|Poppins:300,400,500,600" rel="stylesheet">

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
                            <span class="d-none d-lg-block h1">Job Postings</span>
                        </div>

                        <?php
                    // Database connection
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "graduate_tracer";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch job postings
                    $sql = "SELECT jobTitle, jobDescription, qualifications, applicationDeadline, contactInfo, filePath FROM job_postings ORDER BY id DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '
                            <div class="card mb-3 shadow-sm border-light">
                                <div class="card-body">
                                    <h3 class="card-title"><strong>' . htmlspecialchars($row["jobTitle"]) . '</strong></h3>
                                    <p class="card-text"><strong>Description:</strong> ' . htmlspecialchars($row["jobDescription"]) . '</p>
                                    <p class="card-text"><strong>Qualifications:</strong></p>
                                    <ul class="list-unstyled">';
                                    // Display qualifications as list items
                                    $qualificationsList = explode("\n", $row["qualifications"]);
                                    foreach ($qualificationsList as $qualification) {
                                        echo '<li>- ' . htmlspecialchars($qualification) . '</li>';
                                    }
                                    echo '
                                    </ul>
                                    <p class="card-text"><strong>Deadline:</strong> ' . htmlspecialchars($row["applicationDeadline"]) . '</p>
                                    <p class="card-text"><strong>Contact:</strong> ' . htmlspecialchars($row["contactInfo"]) . '</p>';

                                    // If file is uploaded, provide download link
                                    if ($row['filePath']) {
                                        echo '<a href="' . htmlspecialchars($row["filePath"]) . '" target="_blank" class="btn btn-outline-primary btn-sm">Download Attachment</a>';
                                    }

                                    echo '
                                </div>
                            </div>';
                        }
                    } else {
                        echo '<p>No job postings available at the moment.</p>';
                    }

                    $conn->close();
                    ?>
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