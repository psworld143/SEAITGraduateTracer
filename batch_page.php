    <?php
    // Include the database connection file
    include('db.php');

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Survey Result / Data - SEAITGraduateTracer</title>
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

        <?php include('inc/graduate_header.php'); ?>
        <?php include('inc/graduate_sidebar.php'); ?>

        <main id="main" class="main">
            <div class="pagetitle">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item">Manage Survey</li>
                        <li class="breadcrumb-item active">Batch 2024-2025</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title mb-0">Batch 2024-2025</h5>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addStudentModal">
                                        <i class="bi bi-plus"></i>Add Student
                                    </button>
                                </div>

                                <div class="modal fade" id="addStudentModal" tabindex="-1"
                                    aria-labelledby="addStudentModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="addStudentForm">
                                                    <div class="mb-3">
                                                        <label for="inputFirstName" class="form-label">First
                                                            Name:</label>
                                                        <input type="text" class="form-control" id="inputFirstName"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="inputLastName" class="form-label">Last Name:</label>
                                                        <input type="text" class="form-control" id="inputLastName"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="inputCourse" class="form-label">Course:</label>
                                                        <input type="text" class="form-control" id="inputCourse"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="inputEmail" class="form-label">Email:</label>
                                                        <input type="email" class="form-control" id="inputEmail"
                                                            required>
                                                    </div>
                                                    <div id="formFeedback" class="text-danger"></div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="saveStudentBtn">Save
                                                    changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Year Graduated</th>
                                            <th>Course</th>
                                            <th>Email Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="studentTableBody">
                                        <!-- Table rows will go here -->
                                    </tbody>
                                </table>

                                <!-- Pagination controls -->
                                <nav aria-label="Page navigation">
                                    <ul class="pagination" id="paginationControls">
                                        <!-- Pagination buttons will go here -->
                                    </ul>
                                </nav>
                            </div>
                        </div>
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

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
        $(document).ready(function() {
            // Fetch existing students and populate the table
            fetchStudents();

            $('#saveStudentBtn').click(function() {
                // Get form data
                const firstName = $('#inputFirstName').val().trim();
                const lastName = $('#inputLastName').val().trim();
                const course = $('#inputCourse').val().trim();
                const email = $('#inputEmail').val().trim();

                // Validate form inputs
                if (!firstName || !lastName || !course || !email) {
                    $('#formFeedback').text('Please fill all fields.');
                    return;
                }

                // AJAX request to add a new student
                $.ajax({
                    url: 'add_student.php',
                    type: 'POST',
                    data: {
                        first_name: firstName,
                        last_name: lastName,
                        course: course,
                        email: email
                    },
                    success: function(response) {
                        const result = JSON.parse(response);
                        handleResponse(result, firstName, lastName, course, email);
                    },
                    error: function() {
                        $('#formFeedback').text('Error connecting to the server.');
                    }
                });
            });

            // Function to handle response from adding a new student
            function handleResponse(result, firstName, lastName, course, email) {
                if (result.status === 'success') {
                    $('#formFeedback')
                        .removeClass('text-danger')
                        .addClass('text-success')
                        .text(result.message);
                    $('#addStudentForm')[0].reset(); // Clear form
                    $('#addStudentModal').modal('hide'); // Hide modal

                    // Add new student row to the table
                    const newRow = `
                <tr>
                    <td>${firstName} ${lastName}</td>
                    <td><!-- Year Graduated Here --></td>
                    <td>${course}</td>
                    <td>${email}</td>
                    <td><!-- Action Buttons Here --></td>
                </tr>
            `;
                    $('#studentTableBody').append(newRow);
                } else {
                    $('#formFeedback').text(result.message);
                }
            }

            // Function to fetch and display students
            function fetchStudents() {
                $.ajax({
                    url: 'fetch_student.php',
                    type: 'GET',
                    success: function(response) {
                        const result = JSON.parse(response);
                        if (result.status === 'success') {
                            result.data.forEach(function(student) {
                                const newRow = `
                            <tr>
                                <td>${student.first_name} ${student.last_name}</td>
                                <td><!-- Year Graduated Here --></td>
                                <td>${student.course}</td>
                                <td>${student.email}</td>
                                <td><!-- Action Buttons Here --></td>
                            </tr>
                        `;
                                $('#studentTableBody').append(newRow);
                            });
                        } else {
                            console.error(result.message);
                        }
                    },
                    error: function() {
                        console.error('Error fetching student data.');
                    }
                });
            }
        });
        </script>




    </body>

    </html>