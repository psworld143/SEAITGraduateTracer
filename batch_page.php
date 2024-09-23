<?php
// db_connection.php - Replace with your actual database connection file
include('db_conn.php');

// Get batch_id from URL (with validation)
$batch_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query to fetch students based on batch_id
$query = "SELECT id, first_name, last_name, course, email FROM students WHERE batch_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $batch_id);
$stmt->execute();
$result = $stmt->get_result();
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
                                            <form id="addStudentForm" method="POST" action="backend/save_student.php">
                                                <div class="mb-3">
                                                    <label for="inputFirstName" class="form-label">First Name:</label>
                                                    <input type="text" class="form-control" id="inputFirstName"
                                                        name="first_name" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="inputLastName" class="form-label">Last Name:</label>
                                                    <input type="text" class="form-control" id="inputLastName"
                                                        name="last_name" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="inputCourse" class="form-label">Course:</label>
                                                    <input type="text" class="form-control" id="inputCourse"
                                                        name="course" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="inputEmail" class="form-label">Email:</label>
                                                    <input type="email" class="form-control" id="inputEmail"
                                                        name="email" required>
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

                            <!-- Edit Student Modal -->
                            <div class="modal fade" id="editStudentModal" tabindex="-1"
                                aria-labelledby="editStudentModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editStudentForm" method="POST">
                                                <input type="hidden" id="editStudentId" name="id">
                                                <div class="mb-3">
                                                    <label for="editFirstName" class="form-label">First Name:</label>
                                                    <input type="text" class="form-control" id="editFirstName"
                                                        name="first_name" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editLastName" class="form-label">Last Name:</label>
                                                    <input type="text" class="form-control" id="editLastName"
                                                        name="last_name" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editCourse" class="form-label">Course:</label>
                                                    <input type="text" class="form-control" id="editCourse"
                                                        name="course" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editEmail" class="form-label">Email:</label>
                                                    <input type="email" class="form-control" id="editEmail" name="email"
                                                        required>
                                                </div>
                                                <div id="editFormFeedback" class="text-danger"></div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" form="editStudentForm">Save
                                                changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Student Table -->
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
                                    <?php
                                    // Check if there are any students in the batch
                                    if ($result->num_rows > 0) {
                                        // Fetch and display students
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr id='studentRow-{$row['id']}'>";
                                            echo "<td>{$row['first_name']} {$row['last_name']}</td>";
                                            echo "<td>{$row['course']}</td>";
                                            echo "<td>{$row['email']}</td>";
                                            echo "<td>
                                                <button class='btn btn-warning btn-sm' onclick='editStudent({$row['id']})'>Edit</button>
                                                <button class='btn btn-danger btn-sm' onclick='deleteStudent({$row['id']})'>Delete</button>
                                                </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        // If no students found, display a message
                                        echo "<tr><td colspan='4' class='text-center'>No students found.</td></tr>";
                                    }
                                    ?>
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

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fetching student data to fill in the edit modal
        function editStudent(id) {
            document.getElementById('editFormFeedback').innerHTML = '';

            // AJAX request to get student details
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'backend/get_student.php?id=' + id, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var student = JSON.parse(xhr.responseText);
                    if (student) {
                        document.getElementById('editStudentId').value = student.id;
                        document.getElementById('editFirstName').value = student.first_name;
                        document.getElementById('editLastName').value = student.last_name;
                        document.getElementById('editCourse').value = student.course;
                        document.getElementById('editEmail').value = student.email;
                        $('#editStudentModal').modal('show');
                    } else {
                        document.getElementById('editFormFeedback').innerHTML = 'Student not found.';
                    }
                } else {
                    document.getElementById('editFormFeedback').innerHTML = 'Error fetching student data.';
                }
            };
            xhr.send();
        }

        // Function to delete a student (implement this based on your requirements)
        function deleteStudent(id) {
            if (confirm('Are you sure you want to delete this student?')) {
                // AJAX request to delete the student
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'backend/delete_student.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        // Reload the page or update the table
                        location.reload();
                    } else {
                        alert('Error deleting student.');
                    }
                };
                xhr.send('id=' + id);
            }
        }
    </script>
</body>

</html>
