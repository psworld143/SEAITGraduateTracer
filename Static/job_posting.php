<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Job Postings</title>
    <meta content="Job listings and opportunities" name="description">
    <meta content="jobs, career, SEAIT" name="keywords">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600|Poppins:300,400,500,600" rel="stylesheet">
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
                            <span class="d-none d-lg-block h1">Job Postings</span>
                        </div>
                        <?php
                        include('db_conn.php');

                        // Fetch job postings where status is active
                        $sql = "SELECT company_name, company_logo, job_location, job_title, job_description, qualifications, application_deadline, contact_info, status FROM job_postings WHERE status = 'active' ORDER BY id DESC";
                        $result = $conn->query($sql);

                        if ($result) {
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '
                                    <div class="card mb-4 shadow-sm border-light">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-4">
                                                ';

                                    // Display company logo beside the company name
                                    if (!empty($row["company_logo"])) {
                                        echo '<img src="' . htmlspecialchars($row["company_logo"]) . '" alt="Company Logo" class="img-fluid" style="height: 60px; margin-right: 20px; margin-top:20px;">';
                                    }

                                    echo '<div>
                                                <h4 class="card-title mb-1">' . htmlspecialchars($row["company_name"]) . '</h4>
                                                <h6 class="text-muted mb-0">' . htmlspecialchars($row["job_location"]) . '</h6>
                                            </div>
                                            </div>
                                            <hr class="my-3">
                                            <div class="mt-3">
                                                <h5 class="card-title"><strong>HIRING: ' . htmlspecialchars($row["job_title"]) . '</strong></h5>
                                                <p class="card-text mb-4"><strong>Description:</strong> ' . nl2br(strip_tags($row["job_description"], '<br><p><strong>')) . '</p>
                                                <p class="card-text"><strong>Qualifications:</strong></p>
                                                <ul class="list-unstyled mb-4">';

                                    // Display qualifications in a clean list format
                                    $qualificationsList = array_filter(array_map('trim', explode("\n", $row["qualifications"])));
                                    if (!empty($qualificationsList)) {
                                        foreach ($qualificationsList as $qualification) {
                                            echo '<li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>' . htmlspecialchars(trim($qualification)) . '</li>';
                                        }
                                    } else {
                                        echo '<li>No qualifications listed.</li>';
                                    }

                                    echo '
                                                </ul>
                                                <p class="card-text"><strong>Application Deadline:</strong> ' . htmlspecialchars($row["application_deadline"]) . '</p>
                                                <p class="card-text mb-4"><strong>Contact Information:</strong> ' . htmlspecialchars($row["contact_info"]) . '</p>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            } else {
                                echo '<p class="text-center text-muted">No job postings available at the moment.</p>';
                            }
                        } else {
                            echo 'Error fetching job postings: ' . $conn->error;
                        }

                        $conn->close();
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>