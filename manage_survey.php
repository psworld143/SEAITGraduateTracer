<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Manage Survey - SEAITGraduateTracer</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

    <?php include('inc/header.php'); ?>
    <?php include('inc/sidebar.php'); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Manage Survey</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Manage Survey</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                        <!-- Batch Graduated -->
                        <div class="col-12">
                            <div class="card top-selling overflow-auto">

                                <div class="card-body pb-0">
                                    <h5 class="card-title">Batch Graduated</h5>

                                    <div class="row">
                                        <!-- Batch Card 1 -->
                                        <div class="col-xxl-4 col-md-6 mb-4">
                                            <a href="student.php" class="card batch-card-link">
                                                <div class="batch-card-body">
                                                    <h5 class="batch-card-title">Batch 2024-2025</h5>
                                                </div>
                                            </a>
                                        </div>

                                        <!-- Batch Card 2 -->
                                        <div class="col-xxl-4 col-md-6 mb-4">
                                            <a href="batch-2023-2024.html" class="card batch-card-link">
                                                <div class="batch-card-body">
                                                    <h5 class="batch-card-title">Batch 2023-2024</h5>
                                                </div>
                                            </a>
                                        </div>

                                        <!-- Batch Card 3 -->
                                        <div class="col-xxl-4 col-md-6 mb-4">
                                            <a href="batch-2022-2023.html" class="card batch-card-link">
                                                <div class="batch-card-body">
                                                    <h5 class="batch-card-title">Batch 2022-2023</h5>
                                                </div>
                                            </a>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div><!-- End Batch Graduated -->

                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">

                    <!-- Recent Activity -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add New Batch</h5>
                            <form class="row g-3">
                                <div class="col-12">
                                    <label for="inputPassword4" class="form-label">Batch Name:</label>
                                    <input type="batchName" class="form-control" id="batchName">
                                </div>
                                <div class="col-12">
                                    <label for="inputState" class="form-label">Year Graduated:</label>
                                    <select id="inputState" class="form-select">
                                        <option selected>Select Year Graduated</option>
                                        <option>2024-2025</option>
                                        <option>2023-2024</option>
                                        <option>2022-2023</option>
                                        <option>2021-2022</option>
                                        <option>2020-2021</option>
                                    </select>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div><!-- End Recent Activity -->

                    </div><!-- End Right side columns -->

                </div>
        </section>

    </main><!-- End #main -->

    <?php include('inc/footer.php'); ?>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>