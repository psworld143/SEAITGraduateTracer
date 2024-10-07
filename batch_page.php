<?php
// db_connection.php - Replace with your actual database connection file
include('db_conn.php');

// Get batch_id from URL (with validation)
$batch_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the batch name based on batch_id
$batch_query = "SELECT batch_name FROM batches WHERE id = ?";
$batch_stmt = $conn->prepare($batch_query);
$batch_stmt->bind_param('i', $batch_id);
$batch_stmt->execute();
$batch_result = $batch_stmt->get_result();

// Fetch the batch name or set default if not found
$batch_name = $batch_result->num_rows > 0 ? $batch_result->fetch_assoc()['batch_name'] : "Unknown Batch";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Survey Result / Data - SEAITGraduateTracer</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/vendor/jgrowl/jquery.jgrowl.css" rel="stylesheet">
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
                    <li class="breadcrumb-item active"><?php echo htmlspecialchars($batch_name); ?></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns (Student List) -->
                <div class="col-lg-8">
                    <div class="row">
                        <!-- Student List -->
                        <div class="col-12">
                            <div class="card shadow-sm border-light mb-4">
                                <div class="card-header text-dark">
                                    <h5 class="card-title mb-0"><?php echo htmlspecialchars($batch_name); ?></h5>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered" id="studentsTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Student Name</th>
                                                    <th>Course</th>
                                                    <th>Email</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="studentsList">
                                                <!-- Student data will be loaded here via JS -->
                                            </tbody>
                                        </table>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0"><?php echo $batch_name; ?></h5>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addStudentModal">
                                    <i class="bi bi-plus"></i>Add Student
                                </button>
                            </div>

                            <!-- Add Student Modal -->
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
                                                    <input type="text" class="form-control" id="inputFirstName"
                                                        name="first_name" required>
                                                    <div class="invalid-feedback">
                                                        Please enter a first name.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="inputLastName" class="form-label">Last Name:</label>
                                                    <input type="text" class="form-control" id="inputLastName"
                                                        name="last_name" required>
                                                    <div class="invalid-feedback">
                                                        Please enter a last name.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="inputCourse" class="form-label">Course:</label>
                                                    <select class="form-select" id="inputCourse" name="course" required>
                                                        <option value="" disabled selected>Select a course</option>
                                                        <option value="BS Business Administration Major in Mktg Mgt.">BS
                                                            Business Administration Major in Mktg Mgt. (BSBA)</option>
                                                        <option value="BS Accounting Information System">BS Accounting
                                                            Information System (BSAIS)</option>
                                                        <option value="BS Hospitality Management">BS Hospitality
                                                            Management (BSHM)</option>
                                                        <option value="BS Tourism Management">BS Tourism Management
                                                            (BSTM)</option>
                                                        <option value="Associate in Hospitality Management">Associate in
                                                            Hospitality Management (AHM)</option>
                                                        <option
                                                            value="Bachelor in Secondary Education Major in English">
                                                            BSEd - English</option>
                                                        <option value="Bachelor in Secondary Education Major in Math">
                                                            BSEd - Math</option>
                                                        <option value="Bachelor in Elementary Education">Bachelor in
                                                            Elementary Education (BEEd)</option>
                                                        <option value="Bachelor in Early Childhood Education">Bachelor
                                                            in Early Childhood Education (BECEd)</option>
                                                        <option
                                                            value="Bachelor in Secondary Education Major in Social Studies">
                                                            BSEd - Social Studies</option>
                                                        <option value="BS Agriculture Major in PBG">BS Agriculture Major
                                                            in Plant Breeding and Genetics (PBG)</option>
                                                        <option value="BS Agriculture Major in Horticulture">BS
                                                            Agriculture Major in Horticulture (Horti)</option>
                                                        <option value="BS Fisheries">BS Fisheries (BSF)</option>
                                                        <option value="BS Agricultural Technology">BS Agricultural
                                                            Technology</option>
                                                        <option value="BS Information Technology">BS Information
                                                            Technology (BSIT)</option>
                                                        <option value="BS Civil Engineering">BS Civil Engineering (BSCE)
                                                        </option>
                                                        <option value="BS IT specialized in Business Analytics">BS
                                                            Information Technology specialized in Business Analytics
                                                            (BSIT-BAST)</option>
                                                        <option value="Associate in Computer Technology">Associate in
                                                            Computer Technology (ACT)</option>
                                                        <option value="BS Criminology">BS Criminology (BSCrim)</option>
                                                        <option value="BS Public Administration">BS Public
                                                            Administration (BPA)</option>
                                                        <option value="BS Social Works">BS Social Works (BSSW)</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select a course.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="inputEmail" class="form-label">Email:</label>
                                                    <input type="email" class="form-control" id="inputEmail"
                                                        name="email" required>
                                                    <div class="invalid-feedback">
                                                        Please enter a valid email address.
                                                    </div>
                                                </div>
                                                <input type="hidden" name="batch_id" value="<?php echo $batch_id; ?>" />
                                                <div id="formFeedback" class="text-danger"></div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" form="addStudentForm">Save
                                                changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End of Student List -->
                    </div>
                </div><!-- End Left side columns -->


                <!-- Right side columns (Add New Student Form) -->
                <div class="col-lg-4">
                    <div class="card shadow-sm border-light">
                        <div class="card-header text-dark">
                            <h5 class="card-title mb-0"><i class="bi bi-plus-circle-fill"></i> Add New Student</h5>
                        </div>
                        <div class="card-body">
                            <form id="addStudentForm" class="row g-3">
                                <div class="col-12">
                                    <label for="firstName" class="form-label">First Name:</label>
                                    <input type="text" class="form-control" name="firstName" id="firstName"
                                        placeholder="Enter First Name" required>
                                </div>
                                <div class="col-12">
                                    <label for="lastName" class="form-label">Last Name:</label>
                                    <input type="text" class="form-control" name="lastName" id="lastName"
                                        placeholder="Enter Last Name" required>
                                </div>
                                <div class="col-12">
                                    <label for="course" class="form-label">Course:</label>
                                    <input type="text" class="form-control" name="course" id="course" required>
                                </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Enter Email Address" required>
                                </div>
                                <div class="col-12">
                                    <input type="hidden" name="batch_id" id="batch_id" value="<?php echo $batch_id; ?>">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                                    </div>
                                </div>
                            </form>
                            <div id="responseMessage" class="mt-3" divdiv>
                            </div>
                        </div>
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
    <script src="assets/vendor/jgrowl/jquery.jgrowl.min.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM fully loaded');
        let dataTable;


        function loadStudents() {
            const batchId = document.getElementById('batch_id')?.value;
            if (!batchId) return console.error('Batch ID not found');

            fetch(`backend/load_students.php?batch_id=${batchId}`)
                .then(response => response.ok ? response.json() : Promise.reject('Failed to fetch'))
                .then(responseData => {
                    if (!responseData.success) throw new Error(responseData.error || 'Unknown error');

                    const table = document.getElementById('studentsTable');
                    if (!table) return console.error('Table not found');

                    // Ensure the table has a header
                    if (!table.tHead) {
                        const thead = table.createTHead();
                        const headerRow = thead.insertRow();
                        ['Name', 'Course', 'Email', 'Actions'].forEach(text => {
                            const th = document.createElement('th');
                            th.textContent = text;
                            headerRow.appendChild(th);
                        });
                    }

                    const tbody = table.tBodies[0] || table.createTBody();

                    if (responseData.data.length) {
                        tbody.innerHTML = responseData.data.map(student => `
                        <tr>
                            <td>${student.first_name} ${student.last_name}</td>
                            <td>${student.course}</td>
                            <td>${student.email}</td>
                            <td>
                                <button class="btn btn-danger btn-sm" onclick="deleteStudent(${student.id})">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <button class="btn btn-success btn-sm" onclick="viewStudent(${student.id})">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </td>
                        </tr>
                    `).join('');
                    } else {
                        tbody.innerHTML =
                            '<tr><td colspan="4" class="text-center">No students found for this batch.</td></tr>';
                    }

                    if (dataTable) {
                        dataTable.destroy();
                    }
                    dataTable = new simpleDatatables.DataTable(table, {
                        searchable: responseData.data.length > 0,
                        fixedHeight: true,
                        paging: responseData.data.length > 0,
                        perPageSelect: responseData.data.length > 0 ? [5, 10, 15, 20, 25] : false,
                        perPage: 10
                    });

                    // Adjust table layout for empty state
                    if (!responseData.data.length) {
                        const tableWrapper = table.closest('.datatable-wrapper');
                        if (tableWrapper) {
                            tableWrapper.querySelector('.datatable-top')?.classList.add('d-none');
                            tableWrapper.querySelector('.datatable-bottom')?.classList.add('d-none');
                        }
                    }
                })
                   .catch(error => console.error('Error loading students:', error));
        }


        // Load students when the page is loaded
        loadStudents();

        // Handle form submission
        const addStudentForm = document.getElementById('addStudentForm');
        addStudentForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(addStudentForm);
            const submitButton = addStudentForm.querySelector('button[type="submit"]');
            const responseMessage = document.getElementById('responseMessage');
            responseMessage.innerHTML = '';
            submitButton.disabled = true;

            fetch('backend/save_student.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to submit the form.');
                    }
                    return response.json();
                })
                .then(responseData => {
                    if (responseData.success) {
                        // Reload the students list and reset the form
                        loadStudents();
                        addStudentForm.reset();
                        responseMessage.innerHTML =
                            '<div class="alert alert-success">Student added successfully!</div>';
                    } else {
                        throw new Error(responseData.error || 'Unknown error occurred.');
                    }
                })
                .catch(error => {
                    console.error('Error submitting the form:', error);
                    responseMessage.innerHTML =
                        '<div class="alert alert-danger">Failed to add the student. Please try again.</div>';
                })
                .finally(() => {
                    submitButton.disabled = false;
                });

        });

        // Function to delete a student
        function deleteStudent(studentId) {
            if (confirm('Are you sure you want to delete this student?')) {
                fetch(`backend/delete_student.php?id=${studentId}`, {
                        method: 'GET'
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Failed to delete student.');
                        return response.json();
                    })
                    .then(data => {
                        alert(data.message);
                        if (data.success) {
                            // Reload the page after deletion
                            window.location.reload();
                        } else {
                            console.error('Error:', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error deleting student:', error);
                        alert('Failed to delete student. Please try again.');
                    });
            }
        }

        // Function to view a student's details
        function viewStudent(studentId) {
            window.location.href = `view_student.php?id=${studentId}`;
        }

        // Expose functions globally to allow inline use in HTML
        window.deleteStudent = deleteStudent;
        window.viewStudent = viewStudent;

    });
    </script>
</body>

</html>