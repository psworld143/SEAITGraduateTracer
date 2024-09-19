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
                                                    <label for="inputFirstName" class="form-label">First Name:</label>
                                                    <input type="text" class="form-control" id="inputFirstName"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="inputLastName" class="form-label">Last Name:</label>
                                                    <input type="text" class="form-control" id="inputLastName" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="inputYearGraduated" class="form-label">Year
                                                        Graduated:</label>
                                                    <input type="text" class="form-control" id="inputYearGraduated"
                                                        required>
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
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="saveStudentBtn">Save
                                                changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search...">

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

    <!-- AJAX for Managing Students -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchStudents();
        document.getElementById('searchInput').addEventListener('input', searchStudents);
    });

    document.getElementById('saveStudentBtn').addEventListener('click', function() {
        var firstName = document.getElementById('inputFirstName').value;
        var lastName = document.getElementById('inputLastName').value;
        var yearGraduated = document.getElementById('inputYearGraduated').value;
        var course = document.getElementById('inputCourse').value;
        var email = document.getElementById('inputEmail').value;

        if (firstName && lastName && yearGraduated && course && email) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'add_student.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        addStudentToTable(firstName, lastName, yearGraduated, course, email);
                        document.getElementById('addStudentModal').querySelector('.btn-close').click();
                    } else {
                        document.getElementById('formFeedback').textContent = response.message;
                    }
                }
            };
            xhr.send('first_name=' + encodeURIComponent(firstName) +
                '&last_name=' + encodeURIComponent(lastName) +
                '&year_graduated=' + encodeURIComponent(yearGraduated) +
                '&course=' + encodeURIComponent(course) +
                '&email=' + encodeURIComponent(email));
        } else {
            document.getElementById('formFeedback').textContent = 'Please fill all fields.';
        }
    });

    function fetchStudents(page = 1) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'fetch_students.php?page=' + page, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    var data = JSON.parse(xhr.responseText);
                    if (data && Array.isArray(data.students)) {
                        var students = data.students;
                        var pagination = data.pagination;
                        var tableBody = document.getElementById('studentTableBody');
                        tableBody.innerHTML = '';
                        students.forEach(function(student) {
                            addStudentToTable(student.first_name, student.last_name, student.year_graduated,
                                student.course, student.email);
                        });
                        updatePagination(pagination);
                    } else {
                        console.error('Unexpected data format:', data);
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                }
            } else {
                console.error('Error fetching students:', xhr.status, xhr.statusText);
            }
        };
        xhr.onerror = function() {
            console.error('Request failed');
        };
        xhr.send();
    }


    function addStudentToTable(firstName, lastName, yearGraduated, course, email) {
        var tableBody = document.getElementById('studentTableBody');
        var row = document.createElement('tr');

        row.innerHTML = `
        <td>${firstName} ${lastName}</td>
        <td>${yearGraduated}</td>
        <td>${course}</td>
        <td>${email}</td>
        <td><button class="btn btn-danger btn-sm delete-btn">Delete</button></td>
    `;

        tableBody.appendChild(row);

        // Add event listener for delete buttons
        row.querySelector('.delete-btn').addEventListener('click', function() {
            if (confirm('Are you sure you want to delete this student?')) {
                deleteStudent(email);
            }
        });
    }


    function updatePagination(pagination) {
        var paginationControls = document.getElementById('paginationControls');
        paginationControls.innerHTML = '';
        for (var i = 1; i <= pagination.totalPages; i++) {
            var pageItem = document.createElement('li');
            pageItem.className = 'page-item' + (i === pagination.currentPage ? ' active' : '');
            pageItem.innerHTML = '<a class="page-link" href="#">' + i + '</a>';
            pageItem.addEventListener('click', function(event) {
                event.preventDefault();
                var page = parseInt(this.textContent);
                fetchStudents(page);
            });
            paginationControls.appendChild(pageItem);
        }
    }

    function deleteStudent(email) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'delete_student.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    fetchStudents(); // Refresh the student list
                } else {
                    alert(response.message);
                }
            }
        };
        xhr.send('email=' + encodeURIComponent(email));
    }
    </script>

</body>

</html>