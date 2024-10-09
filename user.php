<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Dashboard - SEAIT Graduate Tracer</title>
    <meta content="User management dashboard for SEAIT Graduate Tracer." name="description">
    <meta content="SEAIT, Graduate Tracer, User Management" name="keywords">

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
            <h1>User Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php"><i class="bi bi-house-door"></i></a></li>
                    <li class="breadcrumb-item active">User Management</li>
                </ol>
            </nav>
        </div>

        <section class="section">
                <div class="col-lg-20">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">List of Users</h5>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#adduser">
                                    <i class="bx bx-plus"></i>Add User
                                </button>
                            </div>
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- User data will be populated here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </section>

        <!-- Add User Modal -->
        <form id="addUserForm">
            <div class="modal fade" id="adduser" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">User Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="firstname" class="form-label">First Name</label>
                                        <input type="text" name="firstname" class="form-control" id="firstname"
                                            required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="middlename" class="form-label">Middle Name</label>
                                        <input type="text" name="middlename" class="form-control" id="middlename">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="lastname" class="form-label">Last Name</label>
                                        <input type="text" name="lastname" class="form-control" id="lastname" required>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <div class="col-md-8">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" id="username" required>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <div class="col-md-8">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </main>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>