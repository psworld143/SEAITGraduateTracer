<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Job Postings - Your Application</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        .job-card {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            transition: box-shadow 0.3s;
        }
        .job-card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .job-title {
            font-size: 1.5em;
            font-weight: bold;
        }
        .job-details {
            margin-top: 10px;
        }
        .apply-button {
            margin-top: 10px;
        }
    </style>
</head>

<body>
<?php include('inc/header.php'); ?>
<main id="main" class="main">

    <section class="section">
        <div class="row">

            <div class="col-lg-12">
                <div class="row">

                    <!-- Job Posting Card Example -->
                    <div class="col-md-4">
                        <div class="job-card">
                            <div class="job-title">Software Engineer</div>
                            <div class="job-details">
                                <p><strong>Date Posted:</strong> 2024-09-20</p>
                                <p><strong>Status:</strong> Open</p>
                                <p><strong>Qualifications:</strong> Bachelor's in Computer Science or related field.</p>
                            </div>
                            <a href="#" class="btn btn-primary apply-button">Apply Now</a>
                        </div>
                    </div><!-- End Job Posting Card -->

                    <!-- Additional job postings can be added similarly -->
                    <div class="col-md-4">
                        <div class="job-card">
                            <div class="job-title">Marketing Specialist</div>
                            <div class="job-details">
                                <p><strong>Date Posted:</strong> 2024-09-18</p>
                                <p><strong>Status:</strong> Open</p>
                                <p><strong>Qualifications:</strong> Experience in digital marketing.</p>
                            </div>
                            <a href="#" class="btn btn-primary apply-button">Apply Now</a>
                        </div>
                    </div><!-- End Job Posting Card -->

                    <div class="col-md-4">
                        <div class="job-card">
                            <div class="job-title">Data Analyst</div>
                            <div class="job-details">
                                <p><strong>Date Posted:</strong> 2024-09-15</p>
                                <p><strong>Status:</strong> Closed</p>
                                <p><strong>Qualifications:</strong> Proficient in SQL and Excel.</p>
                            </div>
                            <a href="#" class="btn btn-secondary apply-button" disabled>Closed</a>
                        </div>
                    </div><!-- End Job Posting Card -->

                </div>
            </div>

        </div>
    </section>

</main><!-- End #main -->

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>
</html>
