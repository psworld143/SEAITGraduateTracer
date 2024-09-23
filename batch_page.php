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
                                    data-bs-target="#addStudentModal" aria-label="Add Student">
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
                                                    <label for="inputFirstName" class="form-label">First Name:</label>
                                                    <input type="text" class="form-control" id="inputFirstName" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="inputLastName" class="form-label">Last Name:</label>
                                                    <input type="text" class="form-control" id="inputLastName" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="inputCourse" class="form-label">Course:</label>
                                                    <input type="text" class="form-control" id="inputCourse" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="inputEmail" class="form-label">Email:</label>
                                                    <input type="email" class="form-control" id="inputEmail" required>
                                                </div>
                                                <div id="formFeedback" class="text-danger"></div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="saveStudentBtn">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Course</th>
                                        <th>Email Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="studentTableBody">
                                    <!-- Student data will be dynamically added here -->
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
        // Load students on page load
        loadStudents();

        // Function to load students
        function loadStudents() {
            $.ajax({
                url: 'backend/fetch_students.php',
                type: 'GET',
                data: {
                    batch_id: getQueryParam('id') // Pass the batch ID
                },
                success: function(data) {
                    var studentTableBody = $('#studentTableBody');
                    studentTableBody.empty(); // Clear previous data

                    if (data.length > 0) {
                        data.forEach(function(student) {
                            var row = `<tr>
                                <td>${student.first_name} ${student.last_name}</td>
                                <td>${student.course}</td>
                                <td>${student.email}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="editStudent(${student.id})" aria-label="Edit Student">Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteStudent(${student.id})" aria-label="Delete Student">Delete</button>
                                </td>
                            </tr>`;
                            studentTableBody.append(row);
                        });
                    } else {
                        studentTableBody.append('<tr><td colspan="4" class="text-center">No students found.</td></tr>');
                    }
                },
                error: function() {
                    $('#studentTableBody').append('<tr><td colspan="4" class="text-center text-danger">An error occurred while fetching students.</td></tr>');
                }
            });
        }

        $('#saveStudentBtn').on('click', function() {
            // Get form data
            var firstName = $('#inputFirstName').val();
            var lastName = $('#inputLastName').val();
            var course = $('#inputCourse').val();
            var email = $('#inputEmail').val();

            // Validate inputs
            if (firstName === '' || lastName === '' || course === '' || email === '') {
                $('#formFeedback').text('All fields are required.');
                return;
            }

            // AJAX request to save the student
            $.ajax({
                url: 'backend/save_student.php',
                type: 'POST',
                data: {
                    first_name: firstName,
                    last_name: lastName,
                    course: course,
                    email: email,
                    batch_id: getQueryParam('id') // Pass the batch ID as well
                },
                success: function(response) {
                    if (response === 'success') {
                        $('#formFeedback').removeClass('text-danger').addClass('text-success').text('Student saved successfully!');
                        $('#addStudentModal').modal('hide');
                        $('#addStudentForm')[0].reset(); // Reset form fields
                        loadStudents(); // Reload students
                    } else {
                        $('#formFeedback').text(response); // Display any error message from PHP
                    }
                },
                error: function() {
                    $('#formFeedback').text('An error occurred while saving the student.');
                }
            });
        });
    });

    // Function to get query parameters
    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    // Function to edit a student (placeholder function)
    function editStudent(studentId) {
        // Implement the edit logic here
        alert('Edit student with ID: ' + studentId);
    }

    // Function to delete a student (placeholder function)
    function deleteStudent(studentId) {
        // Implement the delete logic here
        alert('Delete student with ID: ' + studentId);
    }
    </script>

</body>

</html>
 