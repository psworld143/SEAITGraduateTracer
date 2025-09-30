<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header('Location: index2.php');
    exit;
}

require_once 'db_conn.php';

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Determine whether the user is a student or a regular user
// Check the 'students' table first
$stmt = $conn->prepare("SELECT full_name, email FROM students WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // The user is a student
    $user = $result->fetch_assoc();
    $_SESSION['user_type'] = 'student';
    $_SESSION['user_name'] = $user['full_name'];
    $_SESSION['user_email'] = $user['email'];
} else {
    // If not found in 'students', check the 'users' table
    $stmt = $conn->prepare("SELECT firstname, lastname FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // The user is a regular user
        $user = $result->fetch_assoc();
        $_SESSION['user_type'] = 'regular_user';
        $_SESSION['user_name'] = $user['firstname'] . ' ' . $user['lastname'];
    } else {
        // If user is not found in either table, log them out
        session_destroy();
        header('Location: index2.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Manage Survey - SEAITGraduateTracer</title>

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        .swal2-popup {
            font-family: 'Arial', sans-serif;
            font-size: 16px;
        }
        .swal2-confirm {
            background-color: #007bff !important;
            border: none !important;
            color: white !important;
            padding: 10px 20px !important;
            border-radius: 5px !important;
            transition: background-color 0.3s !important;
        }
        .swal2-confirm:hover {
            background-color: #0056b3 !important;
        }
        .swal2-title {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <?php include('inc/header.php'); ?>
    <?php include('inc/sidebar.php'); ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Manage Alumni</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Manage Alumni</li>
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
                                    <h5 class="card-title">List of Alumni</h5>
                                    <div class="row" id="batchList">
                                        <!-- Batch Card Template will be loaded via JS -->

                                    </div>

                                </div>
                            </div>
                        </div><!-- End Batch Graduated -->

                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">
                    <!-- Add New Batch -->
                    <div class="card mb-4">
                        <!-- Added margin-bottom for spacing -->
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-plus-circle-fill"></i> Add New Batch</h5>
                            <form id="addBatchForm" class="row g-3">
                                <div class="col-12">
                                    <label for="batchName" class="form-label">Batch Name:</label>
                                    <input type="text" class="form-control" name="batchName" id="batchName"
                                        placeholder="Enter Batch Name" required>
                                </div>
                                <div class="col-12">
                                    <label for="yearGraduated" class="form-label">Year Graduated:</label>
                                    <select id="yearGraduated" class="form-select" name="yearGraduated" required>
                                        <option value="" selected>Select Year Graduated</option>
                                        <!-- Options dynamically loaded maybe via JS -->
                                    </select>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100">Add</button>
                                </div>
                            </form>
                            <div id="responseMessage"></div>
                        </div>
                    </div><!-- End Add New Batch -->

                    <!-- Add New School Year -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-plus-circle-fill"></i>Add New School Year</h5>
                            <form id="addSchoolYearForm" class="row g-3">
                                <div class="col-12">
                                    <label for="schoolYear" class="form-label">School Year:</label>
                                    <input type="text" class="form-control" name="schoolYear" id="schoolYear"
                                        placeholder="e.g., 2024-2025" required>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100">Add</button>
                                </div>
                            </form>
                            <div id="schoolYearResponseMessage"></div>
                        </div>
                    </div><!-- End Add New School Year -->

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

    <!-- Custom JS File -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    $(document).ready(function() {
        // Function to load school years into the dropdown
        function loadSchoolYears() {
            $.ajax({
                url: 'backend/get_school_years.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response); // Log the response to check its structure
                    if (response.success) {
                        const yearSelect = $('#yearGraduated');
                        yearSelect.find('option:not(:first)').remove(); // Clear existing options

                        // Populate the dropdown with school years
                        $.each(response.data, function(index, schoolYear) {
                            yearSelect.append(new Option(schoolYear, schoolYear)); // Use schoolYear as both value and text
                        });
                    } else {
                        console.error(response.message);
                    }
                },
                error: function() {
                    console.error('Error loading school years.');
                }
            });
        }

        // Call the function to load school years when the page loads
        loadSchoolYears();

        // Function to load batch list via AJAX
        function loadBatchList() {
            $.ajax({
                url: 'backend/get_batches.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var batchListHtml = '';
                    if (response.data.length === 0) {
                        batchListHtml = `
                            <div class="col-12 text-center">
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle-fill me-2"></i>
                                    No batches found. Click "Add New Batch" to create one.
                                </div>
                            </div>`;
                    } else {
                        $.each(response.data, function(index, batch) {
                            batchListHtml += `
                                <div class="col-xxl-4 col-md-6 mb-4">
                                    <a href="batch_page.php?id=${batch.id}" class="card batch-card-link">
                                        <div class="batch-card-body p-3">
                                            <h5 class="batch-card-title mb-1">
                                                <strong>${batch.batch_name}</strong>
                                            </h5>
                                        </div>
                                        <div>
                                            <p class="text-center">
                                                <strong>Year Graduated:</strong> ${batch.year_graduated}
                                            </p>
                                        </div>
                                    </a>
                                    <div class="card-footer text-end">
                                        <button class="btn btn-danger delete-btn w-100" data-id="${batch.id}">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </div>
                                </div>`;
                        });
                    }
                    $('#batchList').html(batchListHtml);
                },
                error: function() {
                    $('#batchList').html(`
                        <div class="col-12 text-center">
                            <div class="alert alert-danger">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                Error loading batch list. Please try again.
                            </div>
                        </div>`);
                }
            });
        }

        // Call loadBatchList on page load
        loadBatchList();

        // Handle delete button click
        $(document).on('click', '.delete-btn', function() {
            var batchId = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'backend/delete_batch.php',
                        type: 'POST',
                        data: {
                            id: batchId
                        },
                        success: function(response) {
                            var data = JSON.parse(response);
                            Swal.fire({
                                title: data.success ? 'Success!' : 'Error!',
                                text: data.message,
                                icon: data.success ? 'success' : 'error',
                                confirmButtonColor: '#3085d6'
                            });
                            if (data.success) {
                                loadBatchList();
                            }
                        },
                        error: function() {
                            Swal.fire({
                                title: 'Error!',
                                text: 'An error occurred while deleting. Please try again.',
                                icon: 'error',
                                confirmButtonColor: '#3085d6'
                            });
                        }
                    });
                }
            });
        });

        // Function to handle form submission
        $('#addBatchForm').submit(function(event) {
            event.preventDefault();

            // Get form data
            var batchName = $('#batchName').val();
            var yearGraduated = $('#yearGraduated').val();

            // Validate form data
            if (batchName === '' || yearGraduated === '') {
                Swal.fire({
                    title: 'Error!',
                    text: 'Please fill in all fields.',
                    icon: 'error',
                    confirmButtonColor: '#3085d6'
                });
                return;
            }

            // Send data to PHP script via AJAX
            $.ajax({
                url: 'backend/addnewbatch.php',
                type: 'POST',
                data: {
                    batchName: batchName,
                    yearGraduated: yearGraduated
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Please wait while we add the batch.',
                        icon: 'info',
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    Swal.fire({
                        title: data.success ? 'Success!' : 'Error!',
                        text: data.message,
                        icon: data.success ? 'success' : 'error',
                        confirmButtonColor: '#3085d6'
                    });

                    if (data.success) {
                        $('#addBatchForm')[0].reset();
                        loadBatchList();
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred. Please try again.',
                        icon: 'error',
                        confirmButtonColor: '#3085d6'
                    });
                }
            });
        });

        // Function to handle form submission for adding a new school year
        $('#addSchoolYearForm').submit(function(event) {
            event.preventDefault();

            // Get form data
            var schoolYear = $('#schoolYear').val();

            // Validate form data
            if (schoolYear === '') {
                Swal.fire({
                    title: 'Error!',
                    text: 'Please enter a school year.',
                    icon: 'error',
                    confirmButtonColor: '#3085d6'
                });
                return;
            }

            // Send data to PHP script via AJAX
            $.ajax({
                url: 'backend/addnewschoolyear.php',
                type: 'POST',
                data: {
                    schoolYear: schoolYear
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Please wait while we add the school year.',
                        icon: 'info',
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    Swal.fire({
                        title: data.success ? 'Success!' : 'Error!',
                        text: data.message,
                        icon: data.success ? 'success' : 'error',
                        confirmButtonColor: '#3085d6'
                    });

                    if (data.success) {
                        $('#addSchoolYearForm')[0].reset();
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred. Please try again.',
                        icon: 'error',
                        confirmButtonColor: '#3085d6'
                    });
                }
            });
        });

    });
    </script>

</body>

</html>