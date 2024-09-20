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
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add New Batch</h5>
                            <form id="addBatchForm" class="row g-3">
                                <div class="col-12">
                                    <label for="batchName" class="form-label">Batch Name:</label>
                                    <input type="text" class="form-control" name="batchName" id="batchName" required>
                                </div>
                                <div class="col-12">
                                    <label for="yearGraduated" class="form-label">Year Graduated:</label>
                                    <select id="yearGraduated" class="form-select" name="yearGraduated" required>
                                        <option value="" selected>Select Year Graduated</option>
                                        <option value="2024-2025">2024-2025</option>
                                        <option value="2023-2024">2023-2024</option>
                                        <option value="2022-2023">2022-2023</option>
                                        <option value="2021-2022">2021-2022</option>
                                        <option value="2020-2021">2020-2021</option>
                                    </select>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                            <div id="responseMessage"></div>
                        </div>
                    </div><!-- End Add New Batch -->

                </div>
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
    <script>
    $(document).ready(function() {
        // Function to load batch list via AJAX
        function loadBatchList() {
            $.ajax({
                url: 'backend/get_batches.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var batchListHtml = '';
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
                                    <button class="btn btn-warning archive-btn" data-id="${batch.id}"><i class="bi bi-archive"></i>Archive</button>
                                    <button class="btn btn-danger delete-btn" data-id="${batch.id}"><i class="bi bi-trash"></i>Delete</button>
                                </div>
                            </div>`;
                    });
                    $('#batchList').html(batchListHtml);
                },

                error: function() {
                    $('#batchList').html('<p>Error loading batch list.</p>');
                }
            });
        }

        // Call loadBatchList on page load
        loadBatchList();

        // Handle archive button click
        $(document).on('click', '.archive-btn', function() {
            var batchId = $(this).data('id');
            $.ajax({
                url: 'backend/archive_batch.php', // Your server-side script for archiving
                type: 'POST',
                data: {
                    id: batchId
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    var messageType = data.success ? 'success' : 'danger';
                    displayMessage(data.message, messageType);
                    if (data.success) {
                        loadBatchList(); // Refresh the batch list
                    }
                },
                error: function() {
                    displayMessage('An error occurred while archiving. Please try again.',
                        'danger');
                }
            });
        });

        // Handle delete button click
        $(document).on('click', '.delete-btn', function() {
            var batchId = $(this).data('id');
            if (confirm('Are you sure you want to delete this batch?')) {
                $.ajax({
                    url: 'backend/delete_batch.php', // Your server-side script for deleting
                    type: 'POST',
                    data: {
                        id: batchId
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        var messageType = data.success ? 'success' : 'danger';
                        displayMessage(data.message, messageType);
                        if (data.success) {
                            loadBatchList(); // Refresh the batch list
                        }
                    },
                    error: function() {
                        displayMessage(
                            'An error occurred while deleting. Please try again.',
                            'danger');
                    }
                });
            }
        });

        // Function to handle form submission
        $('#addBatchForm').submit(function(event) {
            event.preventDefault();

            // Get form data
            var batchName = $('#batchName').val();
            var yearGraduated = $('#yearGraduated').val();

            // Validate form data
            if (batchName === '' || yearGraduated === '') {
                $('#responseMessage').text('Please fill in all fields.').css('color', 'red');
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
                    displayMessage('Processing...', 'info');
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    var messageType = data.success ? 'success' : 'danger';
                    displayMessage(data.message, messageType);

                    if (data.success) {
                        $('#addBatchForm')[0].reset(); // Clear form if successful
                        loadBatchList(); // Refresh the batch list
                    }
                },
                error: function() {
                    displayMessage('An error occurred. Please try again.', 'danger');
                }
            });
        });

        function displayMessage(message, type) {
            $('#responseMessage').remove();
            var messageHtml = `
        <div id="responseMessage" class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
            $('#addBatchForm').before(messageHtml);
            setTimeout(function() {
                $('#responseMessage').alert('close');
            }, 5000);
        }

    });
    </script>




</body>

</html>