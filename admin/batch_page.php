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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
    .section {
        background-color: #fff;
        border-radius: 0.25rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }

    @media print {
        .section {
            page-break-inside: avoid;
        }
    }
    </style>
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
                                <div class="card shadow-sm border-light mb-4">
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered" id="studentsTable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>School ID</th>
                                                        <th>Student Name</th>
                                                        <th>Course</th>
                                                        <th>Department Code</th>
                                                        <th>Control Code</th>
                                                        <th>Email</th>
                                                        <th class="text-center">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="studentsList">
                                                    <!-- Student data will be loaded here via JS -->
                                                    <tr>
                                                        <td colspan="7" class="text-center">No students available.
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
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
                                    <label for="schoolID" class="form-label">School ID:</label>
                                    <input type="text" class="form-control" name="schoolID" id="schoolID"
                                        placeholder="Enter School ID" required>
                                </div>
                                <div class="col-12">
                                    <label for="fullName" class="form-label">Full Name:</label>
                                    <input type="text" class="form-control" name="fullName" id="fullName"
                                        placeholder="Enter Full Name" required>
                                </div>
                                <div class="col-12">
                                    <label for="course" class="form-label">Course:</label>
                                    <select class="form-select" name="course" id="course" required
                                        onchange="generateCodes()">
                                        <option value="" disabled selected>Select Course</option>

                                        <!-- COLLEGE OF BUSINESS AND MANAGEMENT -->
                                        <optgroup label="COLLEGE OF BUSINESS AND MANAGEMENT">
                                            <option
                                                value="BS Business Administration Major in Marketing Management (BSBA)">
                                                BS Business Administration Major in Marketing Management (BSBA)
                                            </option>
                                            <option value="BS Accounting Information System (BSAIS)">
                                                BS Accounting Information System (BSAIS)
                                            </option>
                                            <option value="BS Hospitality Management (BSHM)">
                                                BS Hospitality Management (BSHM)
                                            </option>
                                            <option value="BS Tourism Management (BSTM)">
                                                BS Tourism Management (BSTM)
                                            </option>
                                            <option value="Associate in Hospitality Management (AHM)">
                                                Associate in Hospitality Management (AHM)
                                            </option>
                                        </optgroup>

                                        <!-- COLLEGE OF EDUCATION -->
                                        <optgroup label="COLLEGE OF EDUCATION">
                                            <option
                                                value="Bachelor in Secondary Education Major in English (BSEd - English)">
                                                Bachelor in Secondary Education Major in English (BSEd - English)
                                            </option>
                                            <option value="Bachelor in Secondary Education Major in Math (BSEd - Math)">
                                                Bachelor in Secondary Education Major in Math (BSEd - Math)
                                            </option>
                                            <option value="Bachelor in Elementary Education (BEEd)">
                                                Bachelor in Elementary Education (BEEd)
                                            </option>
                                            <option value="Bachelor in Early Childhood Education (BECEd)">
                                                Bachelor in Early Childhood Education (BECEd)
                                            </option>
                                            <option
                                                value="Bachelor in Secondary Education Major in Social Studies (BSEd - Social Studies)">
                                                Bachelor in Secondary Education Major in Social Studies (BSEd -
                                                Social
                                                Studies)
                                            </option>
                                        </optgroup>

                                        <!-- COLLEGE OF AGRICULTURE -->
                                        <optgroup label="COLLEGE OF AGRICULTURE">
                                            <option value="BS Agriculture (BSAgri)">
                                                BS Agriculture (BSAgri)
                                            </option>
                                            <option value="Major in Plant Breeding and Genetics (PBG)">
                                                Major in Plant Breeding and Genetics (PBG)
                                            </option>
                                            <option value="Major in Horticulture (Horti)">
                                                Major in Horticulture (Horti)
                                            </option>
                                            <option value="BS Fisheries (BSF)">
                                                BS Fisheries (BSF)
                                            </option>
                                            <option value="BS Agricultural Technology">
                                                BS Agricultural Technology
                                            </option>
                                        </optgroup>

                                        <!-- COLLEGE OF ENGINEERING AND TECHNOLOGY -->
                                        <optgroup label="COLLEGE OF ENGINEERING AND TECHNOLOGY">
                                            <option value="BS Information Technology (BSIT)">
                                                BS Information Technology (BSIT)
                                            </option>
                                            <option value="BS Civil Engineering (BSCE)">
                                                BS Civil Engineering (BSCE)
                                            </option>
                                            <option
                                                value="BS Information Technology specialized in Business Analytics (BSIT-BAST)">
                                                BS Information Technology specialized in Business Analytics
                                                (BSIT-BAST)
                                            </option>
                                            <option value="Associate in Computer Technology (ACT)">
                                                Associate in Computer Technology (ACT)
                                            </option>
                                        </optgroup>

                                        <!-- COLLEGE OF PUBLIC RELATIONS -->
                                        <optgroup label="COLLEGE OF PUBLIC RELATIONS">
                                            <option value="BS Criminology (BSCrim)">
                                                BS Criminology (BSCrim)
                                            </option>
                                            <option value="BS Public Administration (BPA)">
                                                BS Public Administration (BPA)
                                            </option>
                                            <option value="BS Social Work (BSSW)">
                                                BS Social Work (BSSW)
                                            </option>
                                        </optgroup>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label for="departmentCode" class="form-label">Department Code:</label>
                                    <input type="text" class="form-control" name="departmentCode" id="departmentCode"
                                        placeholder="Enter Department Code" required readonly>
                                </div>
                                <div class="col-12">
                                    <label for="controlCode" class="form-label">Control Code:</label>
                                    <input type="text" class="form-control" name="controlCode" id="controlCode"
                                        placeholder="Enter Control Code" required readonly>
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
                            <div id="responseMessage" class="mt-3"></div>
                        </div>
                    </div><!-- End Right side columns -->
                </div>
        </section>

    </main><!-- End #main -->

    <!-- Graduate Information Modal -->
    <div class="modal fade" id="graduateModal" tabindex="-1" aria-labelledby="graduateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="graduateModalLabel">Graduate Tracer Information</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Content will be loaded dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="printGraduateInfo()">Print</button>
                </div>
            </div>
        </div>
    </div>

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
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="path/to/your/graduate-tracer.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM fully loaded');
        let dataTable;

        // Function to show success message
        function showSuccessMessage(message) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: message,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        }

        // Function to show error message
        function showErrorMessage(message) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: message,
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        }

        // Function to show confirmation dialog
        function showConfirmationDialog(message) {
            return Swal.fire({
                title: 'Are you sure?',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            });
        }

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
                        ['School ID', 'Name', 'Course', 'Department Code', 'Control Code', 'Email',
                            'Actions'
                        ].forEach(text => {
                            const th = document.createElement('th');
                            th.textContent = text;
                            headerRow.appendChild(th);
                        });
                    }

                    const tbody = table.tBodies[0] || table.createTBody();

                    if (responseData.data.length) {
                        tbody.innerHTML = responseData.data.map(student => `
                    <tr>
                        <td>${student.school_id}</td>
                        <td>${student.full_name}</td>
                        <td>${student.course}</td>
                        <td>${student.department_code}</td>
                        <td>${student.control_code}</td>
                        <td>${student.email}</td>
                        <td>
                            <button class="btn btn-success btn-sm" onclick="fetchGraduateAnswers(${student.id})">
                                <i class="bi bi-eye"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="deleteStudent(${student.id})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                `).join('');
                    } else {
                        tbody.innerHTML =
                            '<tr><td colspan="7" class="text-center">No students found for this batch.</td></tr>'; // Adjusted colspan to 7
                    }

                    // DataTable initialization
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
                .catch(error => {
                    console.error('Error loading students:', error);
                });
        }

        // Load students when the page is loaded
        loadStudents();


        // Department code mappings
        const departmentMappings = {
            // COLLEGE OF BUSINESS AND MANAGEMENT
            'BS Business Administration Major in Marketing Management (BSBA)': 'CBM',
            'BS Accounting Information System (BSAIS)': 'CBM',
            'BS Hospitality Management (BSHM)': 'CBM',
            'BS Tourism Management (BSTM)': 'CBM',
            'Associate in Hospitality Management (AHM)': 'CBM',

            // COLLEGE OF EDUCATION
            'Bachelor in Secondary Education Major in English (BSEd - English)': 'CED',
            'Bachelor in Secondary Education Major in Math (BSEd - Math)': 'CED',
            'Bachelor in Elementary Education (BEEd)': 'CED',
            'Bachelor in Early Childhood Education (BECEd)': 'CED',
            'Bachelor in Secondary Education Major in Social Studies (BSEd - Social Studies)': 'CED',

            // COLLEGE OF AGRICULTURE
            'BS Agriculture (BSAgri)': 'COA',
            'Major in Plant Breeding and Genetics (PBG)': 'COA',
            'Major in Horticulture (Horti)': 'COA',
            'BS Fisheries (BSF)': 'COA',
            'BS Agricultural Technology': 'COA',

            // COLLEGE OF ENGINEERING AND TECHNOLOGY
            'BS Information Technology (BSIT)': 'CET',
            'BS Civil Engineering (BSCE)': 'CET',
            'BS Information Technology specialized in Business Analytics (BSIT-BAST)': 'CET',
            'Associate in Computer Technology (ACT)': 'CET',

            // COLLEGE OF PUBLIC RELATIONS
            'BS Criminology (BSCrim)': 'CPR',
            'BS Public Administration (BPA)': 'CPR',
            'BS Social Work (BSSW)': 'CPR'
        };

        // Course code mappings
        const courseMappings = {
            'BS Business Administration Major in Marketing Management (BSBA)': 'BSBA',
            'BS Accounting Information System (BSAIS)': 'BSAIS',
            'BS Hospitality Management (BSHM)': 'BSHM',
            'BS Tourism Management (BSTM)': 'BSTM',
            'Associate in Hospitality Management (AHM)': 'AHM',
            'Bachelor in Secondary Education Major in English (BSEd - English)': 'BSEDE',
            'Bachelor in Secondary Education Major in Math (BSEd - Math)': 'BSEDM',
            'Bachelor in Elementary Education (BEEd)': 'BEED',
            'Bachelor in Early Childhood Education (BECEd)': 'BECED',
            'Bachelor in Secondary Education Major in Social Studies (BSEd - Social Studies)': 'BSEDS',
            'BS Agriculture (BSAgri)': 'BSAGRI',
            'Major in Plant Breeding and Genetics (PBG)': 'PBG',
            'Major in Horticulture (Horti)': 'HORTI',
            'BS Fisheries (BSF)': 'BSF',
            'BS Agricultural Technology': 'BSAT',
            'BS Information Technology (BSIT)': 'BSIT',
            'BS Civil Engineering (BSCE)': 'BSCE',
            'BS Information Technology specialized in Business Analytics (BSIT-BAST)': 'BSITBA',
            'Associate in Computer Technology (ACT)': 'ACT',
            'BS Criminology (BSCrim)': 'BSCRIM',
            'BS Public Administration (BPA)': 'BPA',
            'BS Social Work (BSSW)': 'BSSW'
        };

        function generateCodes() {
            const courseSelect = document.getElementById('course');
            const selectedCourse = courseSelect.value;

            if (!selectedCourse) {
                clearCodes();
                return;
            }

            // Get department code
            const deptPrefix = departmentMappings[selectedCourse] || 'DEPT';
            const randomDeptNum = String(Math.floor(Math.random() * 1000)).padStart(3, '0');
            const departmentCode = `${deptPrefix}-${randomDeptNum}`;

            // Get course code
            const courseCode = courseMappings[selectedCourse] || 'GRAD';
            const randomControlNum = Math.floor(100000 + Math.random() * 900000).toString();
            const controlCode = `${courseCode}-${randomControlNum}`;

            // Set the values
            document.getElementById('departmentCode').value = departmentCode;
            document.getElementById('controlCode').value = controlCode;
        }

        function clearCodes() {
            document.getElementById('departmentCode').value = '';
            document.getElementById('controlCode').value = '';
        }

        // Add event listener for course selection
        const courseSelect = document.getElementById('course');
        if (courseSelect) {
            courseSelect.addEventListener('change', generateCodes);
        }

        function fetchGraduateAnswers(studentId) {
            console.log('Fetching graduate answers for student ID:', studentId);
            
            $.ajax({
                url: 'backend/fetch_survey.php',
                type: 'POST',
                data: {
                    student_id: studentId
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#graduateModal .modal-body').html(
                        '<div class="text-center p-4">' +
                        '<div class="spinner-border text-primary" role="status">' +
                        '<span class="visually-hidden">Loading...</span>' +
                        '</div>' +
                        '</div>'
                    );
                    $('#graduateModal').modal('show');
                },
                success: function(response) {
                    console.log('Response received:', response);
                    
                    if (response.success) {
                        // Helper function to format enum values and handle multiple selections
                        const formatEnumValue = (value) => {
                            if (!value) return '';
                            // Handle comma-separated values
                            return value.split(',').map(item => 
                                item.trim().split('_')
                                    .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                                    .join(' ')
                            );
                        };

                        // Helper function to display multiple values
                        const displayMultipleValues = (values, otherValue = null) => {
                            if (!values) return '';
                            
                            let html = '<ul class="list-group list-group-flush">';
                            
                            // If values is an array (from formatEnumValue), process each value
                            if (Array.isArray(values)) {
                                values.forEach(value => {
                                    if (value) {
                                        html += `
                                            <li class="list-group-item">
                                                <i class="bi bi-dot me-2"></i>${value}
                                            </li>
                                        `;
                                    }
                                });
                            }

                            if (otherValue) {
                                html += `
                                    <li class="list-group-item">
                                        <i class="bi bi-dot me-2"></i>Other: ${otherValue}
                                    </li>
                                `;
                            }

                            html += '</ul>';
                            return html;
                        };

                        let modalContent = `
<!-- Header Card -->
<div class="container-fluid">
    <!-- Personal Information Section -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Personal Information</h5>
        </div>
        <div class="card-body">
            ${response.data.general_info ? `
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Name:</label>
                        <p class="ms-3">${response.data.general_info.name || 'N/A'}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Civil Status:</label>
                        <p class="ms-3">${formatEnumValue(response.data.general_info.civil_status) || 'N/A'}</p>
                    </div>
                    ${response.data.general_info.email_address || response.data.general_info.mobile_phone_number || response.data.general_info.telephone_contact ? `
                    <div class="col-md-6">
                        <label class="fw-bold">Contact Information:</label>
                        <p class="ms-3">${response.data.general_info.email_address ? `Email: ${response.data.general_info.email_address}` : ''}
                           ${response.data.general_info.mobile_phone_number ? `Mobile: ${response.data.general_info.mobile_phone_number}` : ''}
                           ${response.data.general_info.telephone_contact ? `Tel: ${response.data.general_info.telephone_contact}` : ''}</p>
                    </div>
                    ` : ''}
                    ${response.data.general_info.region_of_origin || response.data.general_info.province_of_origin || response.data.general_info.municipalities ? `
                    <div class="col-md-6">
                        <label class="fw-bold">Location:</label>
                        <p class="ms-3">${response.data.general_info.region_of_origin ? `Region: ${response.data.general_info.region_of_origin}` : ''}
                           ${response.data.general_info.province_of_origin ? `Province: ${response.data.general_info.province_of_origin}` : ''}
                           ${response.data.general_info.municipalities ? `Municipality: ${response.data.general_info.municipalities}` : ''}</p>
                    </div>
                    ` : ''}
                </div>
            ` : '<p>No personal information available</p>'}
        </div>
    </div>

    <!-- Educational Background -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Educational Background</h5>
        </div>
        <div class="card-body">
            <!-- Degrees and Education -->
            <h6 class="fw-bold mb-3">Degrees and Education</h6>
            ${response.data.educational_info && response.data.educational_info.length > 0 ? `
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Degree</th>
                                <th>Institution</th>
                                <th>Year Graduated</th>
                                <th>Honors/Awards</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${response.data.educational_info.map(edu => {
                                // Only show row if all required fields have proper values
                                if (edu.degree && edu.college_university && edu.year_graduated) {
                                    return `
                                        <tr>
                                            <td>${edu.degree}</td>
                                            <td>${edu.college_university}</td>
                                            <td>${new Date(edu.year_graduated).toLocaleDateString()}</td>
                                            <td>${edu.honors_awards || ''}</td>
                                        </tr>
                                    `;
                                }
                                return '';
                            }).join('')}
                        </tbody>
                    </table>
                </div>
            ` : '<p>No educational information available</p>'}

            <!-- Professional Skills -->
            <h6 class="fw-bold mb-3 mt-4">Professional Skills</h6>
            ${response.data.skills && response.data.skills.length > 0 ? `
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <ul class="list-group list-group-flush">
                            ${response.data.skills.map(skill => skill.skill ? `
                                <li class="list-group-item">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    ${skill.skill}
                                </li>
                            ` : '').join('')}
                        </ul>
                    </div>
                </div>
            ` : '<p>No professional skills listed</p>'}

            <!-- Professional Examinations -->
            <h6 class="fw-bold mb-3 mt-4">Professional Examinations</h6>
            ${response.data.examinations && response.data.examinations.length > 0 ? `
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Examination Name</th>
                                <th>Date Taken</th>
                                <th>Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${response.data.examinations.map(exam => {
                                // Only show row if all required fields have proper values
                                if (exam.exam_name && exam.date_taken && exam.rating) {
                                    return `
                                <tr>
                                    <td>${exam.exam_name}</td>
                                            <td>${new Date(exam.date_taken).toLocaleDateString()}</td>
                                            <td>${exam.rating}</td>
                                </tr>
                                    `;
                                }
                                return '';
                            }).join('')}
                        </tbody>
                    </table>
                </div>
            ` : '<p>No professional examinations listed</p>'}
        </div>
    </div>

    <!-- Training and Advanced Studies Section -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Training(s) and Advanced Studies Attended for College</h5>
        </div>
        <div class="card-body">
            ${response.data.training && response.data.training.length > 0 ? `
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Training Title</th>
                                <th>Duration and Credits</th>
                                <th>Institution</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${response.data.training.map(train => {
                                if (train.training_title || train.duration_and_credits || train.institution) {
                                    return `
                                <tr>
                                            <td>${train.training_title || ''}</td>
                                            <td>${train.duration_and_credits || ''}</td>
                                            <td>${train.institution || ''}</td>
                                </tr>
                                    `;
                                }
                                return '';
                            }).join('')}
                        </tbody>
                    </table>
                </div>
            ` : '<p>No training or advanced studies recorded</p>'}

            <!-- Motivation for Studies -->
            ${response.data.motivation && response.data.motivation.length > 0 ? `
                <div class="mt-3">
                    <label class="fw-bold">Motivation for Studies:</label>
                    <ul class="list-group list-group-flush">
                        ${response.data.motivation.map(motivation => `
                            <li class="list-group-item">
                                <i class="bi bi-dot me-2"></i>${formatEnumValue(motivation.motivation)}
                                ${motivation.other_motivation ? `<br><small class="text-muted">Other: ${motivation.other_motivation}</small>` : ''}
                            </li>
                        `).join('')}
                    </ul>
                </div>
            ` : ''}
        </div>
    </div>

    <!-- Employment Status Section -->
    ${response.data.employment_status && response.data.employment_status.length > 0 ? `
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Employment Information</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="fw-bold">Employment Status:</label>
                        <p class="ms-3">${
                            response.data.employment_status[0].status === 'yes'
                                ? 'Employed'
                                : ['no', 'never'].includes(response.data.employment_status[0].status)
                                    ? 'Not Employed'
                                    : 'N/A'
                        }</p>
                    </div>

                    ${response.data.employment_status[0].status === 'no' || response.data.employment_status[0].status === 'never' ? `
                        <!-- Show reasons if not employed -->
                        ${response.data.reasons_not_employed && response.data.reasons_not_employed.length > 0 ? `
                            <div class="col-12">
                                <label class="fw-bold">Reason(s) for Being Not Employed:</label>
                                <ul class="list-group list-group-flush">
                                    ${response.data.reasons_not_employed.map(reason => `
                                        <li class="list-group-item">
                                            <i class="bi bi-dot me-2"></i>${formatEnumValue(reason.reason_not_employed)}
                                            ${reason.other_reason ? `<span class="text-muted ms-2">(Other: ${reason.other_reason})</span>` : ''}
                                        </li>
                                    `).join('')}
                                </ul>
                            </div>
                        ` : ''}
                    ` : `
                        <!-- Show employment details if employed -->
                        ${response.data.present_employment && response.data.present_employment.length > 0 ? `
                            <div class="col-md-6">
                                <label class="fw-bold">Current Employment Status:</label>
                                <p class="ms-3">${formatEnumValue(response.data.present_employment[0].employment_status_current) || 'N/A'}</p>
                            </div>
                        ` : ''}
                        
                        ${response.data.current_occupation && response.data.current_occupation.length > 0 ? `
                            <div class="col-md-6">
                                <label class="fw-bold">Current Occupation:</label>
                                <p class="ms-3">${response.data.current_occupation[0].current_occupation || 'N/A'}</p>
                            </div>
                        ` : ''}

                        ${response.data.company_info && response.data.company_info.length > 0 ? `
                            <div class="col-md-6">
                                <label class="fw-bold">Company:</label>
                                <p class="ms-3">${response.data.company_info[0].company_name || 'N/A'}</p>
                            </div>
                        ` : ''}

                        ${response.data.employment_sector && response.data.employment_sector.length > 0 ? `
                            <div class="col-md-6">
                                <label class="fw-bold">Employment Sector:</label>
                                <p class="ms-3">${response.data.employment_sector[0].sector ? 
                                    response.data.employment_sector[0].sector.charAt(0).toUpperCase() + 
                                    response.data.employment_sector[0].sector.slice(1).toLowerCase() : 'N/A'}</p>
                            </div>
                        ` : ''}

                        ${response.data.place_of_work && response.data.place_of_work.length > 0 ? `
                            <div class="col-md-6">
                                <label class="fw-bold">Place of Work:</label>
                                <p class="ms-3">${response.data.place_of_work[0].local_place || response.data.place_of_work[0].abroad_place || 'N/A'}</p>
                            </div>
                        ` : ''}

                        <!-- First Job Information -->
                        ${response.data.first_job && response.data.first_job.length > 0 ? `
                            <div class="col-12 mt-4">
                                <h6 class="fw-bold">First Job Information</h6>
                                <div class="row g-3 mt-2">
                                    <!-- Job Finding Information -->
                                    ${response.data.job_finding && response.data.job_finding.length > 0 ? `
                                        <div class="col-md-6">
                                            <label class="fw-bold">Method of Finding First Job:</label>
                                            <ul class="list-group list-group-flush">
                                                ${response.data.job_finding.map(method => `
                                                    <li class="list-group-item">
                                                        <i class="bi bi-dot me-2"></i>${formatEnumValue(method.job_finding_method)}
                                                        ${method.other_method ? `<span class="text-muted ms-2">(Other: ${method.other_method})</span>` : ''}
                                                    </li>
                                                `).join('')}
                                            </ul>
                                        </div>
                                        ${response.data.initial_earning && response.data.initial_earning.length > 0 ? `
                                            <div class="col-md-6">
                                                <label class="fw-bold">Initial Monthly Earning:</label>
                                                <p class="ms-3">₱${response.data.initial_earning[0].initial_earning.toLocaleString()}</p>
                                            </div>
                                        ` : ''}
                                    ` : ''}

                                    <!-- Job Change Information -->
                                    ${response.data.reasons_changing && response.data.reasons_changing.length > 0 ? `
                                        <div class="col-md-6">
                                            <label class="fw-bold">Reason(s) for Changing Jobs:</label>
                                            <ul class="list-group list-group-flush">
                                                ${response.data.reasons_changing.map(reason => `
                                                    <li class="list-group-item">
                                                        <i class="bi bi-dot me-2"></i>${formatEnumValue(reason.reason_changing)}
                                                        ${reason.other_reason ? `<span class="text-muted ms-2">(Other: ${reason.other_reason})</span>` : ''}
                                                    </li>
                                                `).join('')}
                                            </ul>
                                        </div>
                                        ${response.data.time_to_land && response.data.time_to_land.length > 0 ? `
                                            <div class="col-md-6">
                                                <label class="fw-bold">Time to Land First Job:</label>
                                                <ul class="list-group list-group-flush">
                                                    ${response.data.time_to_land.map(time => `
                                                        <li class="list-group-item">
                                                            <i class="bi bi-dot me-2"></i>${formatEnumValue(time.time_to_first_job)}
                                                            ${time.other_time ? `<span class="text-muted ms-2">(Other: ${time.other_time})</span>` : ''}
                                                        </li>
                                                    `).join('')}
                                                </ul>
                                            </div>
                                        ` : ''}
                                    ` : ''}

                                    <!-- Job Duration Information -->
                                    ${response.data.first_job_duration && response.data.first_job_duration.length > 0 ? `
                                        <div class="col-md-6">
                                            <label class="fw-bold">Duration in First Job:</label>
                                            <ul class="list-group list-group-flush">
                                                ${response.data.first_job_duration.map(duration => `
                                                    <li class="list-group-item">
                                                        <i class="bi bi-dot me-2"></i>${formatEnumValue(duration.first_job_duration)}
                                                        ${duration.other_duration ? `<span class="text-muted ms-2">(Other: ${duration.other_duration})</span>` : ''}
                                                    </li>
                                                `).join('')}
                                            </ul>
                                        </div>
                                        ${response.data.job_positions && response.data.job_positions.length > 0 ? `
                                            <div class="col-md-6">
                                                <label class="fw-bold">Job Positions:</label>
                                                <ul class="list-group list-group-flush">
                                                    ${response.data.job_positions
                                                        .sort((a, b) => new Date(a.start_date) - new Date(b.start_date))
                                                        .map(position => `
                                                            <li class="list-group-item">
                                                                <div class="d-flex justify-content-between align-items-start">
                                                                    <div>
                                                                        <i class="bi bi-dot me-2"></i>
                                                                        <strong>${position.position_title || 'N/A'}</strong>
                                                                        ${position.first_job === 'yes' ? 
                                                                            '<span class="badge bg-primary ms-2">First Job</span>' : 
                                                                            '<span class="badge bg-secondary ms-2">Subsequent Job</span>'}
                                                                    </div>
                                                                </div>
                                                                ${position.company_name ? 
                                                                    `<div class="ms-4 mt-1"><small class="text-muted">Company: ${position.company_name}</small></div>` : ''}
                                                                ${position.start_date ? 
                                                                    `<div class="ms-4"><small class="text-muted">Start Date: ${new Date(position.start_date).toLocaleDateString()}</small></div>` : ''}
                                                                ${position.end_date ? 
                                                                    `<div class="ms-4"><small class="text-muted">End Date: ${new Date(position.end_date).toLocaleDateString()}</small></div>` : ''}
                                                                ${position.job_location ? 
                                                                    `<div class="ms-4"><small class="text-muted">Location: ${position.job_location}</small></div>` : ''}
                                                            </li>
                                                        `).join('')}
                                                </ul>
                                            </div>
                                        ` : ''}
                                    ` : ''}

                                    <!-- First Job Related Information -->
                                    ${response.data.first_job_related && response.data.first_job_related.length > 0 ? `
                                        <div class="col-12">
                                            <label class="fw-bold">Was First Job Related to Course?</label>
                                            <p class="ms-3">${response.data.first_job_related[0].is_related === 'yes' ? 'Yes' : 'No'}</p>
                                        </div>
                                    ` : ''}
                                </div>
                            </div>
                        ` : ''}
                    `}
                </div>
            </div>
        </div>
    ` : ''}

    <!-- Curriculum Relevance Section -->
    ${response.data.curriculum_relevance && response.data.curriculum_relevance.length > 0 ? `
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Curriculum Evaluation</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="fw-bold">Is the curriculum relevant to your job?</label>
                        <p class="ms-3">${response.data.curriculum_relevance[0].is_relevant === 'yes' ? 'Yes' : 'No'}</p>
                    </div>

                    ${response.data.curriculum_relevance[0].is_relevant === 'yes' && response.data.useful_competencies && response.data.useful_competencies.length > 0 ? `
                        <div class="col-12">
                            <label class="fw-bold">Competencies Learned in College:</label>
                            <ul class="list-group list-group-flush">
                                ${response.data.useful_competencies.map(competency => `
                                    <li class="list-group-item">
                                        <i class="bi bi-dot me-2"></i>${formatEnumValue(competency.useful_competencies)}
                                        ${competency.other_competency ? `<br><small class="text-muted">Other: ${competency.other_competency}</small>` : ''}
                                    </li>
                                `).join('')}
                            </ul>
                        </div>
                    ` : ''}

                    ${response.data.curriculum_improvement && response.data.curriculum_improvement.length > 0 ? `
                        <div class="col-12">
                            <label class="fw-bold">Suggestions for Improvement:</label>
                            <p class="ms-3">${response.data.curriculum_improvement[0].suggestions || 'N/A'}</p>
                        </div>
                    ` : ''}
                </div>
            </div>
        </div>
    ` : ''}

    <!-- Values and Features Section -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Values and Institution Features</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                ${response.data.community_services && response.data.community_services.length > 0 ? `
                    <div class="col-12">
                        <label class="fw-bold">Community Services:</label>
                        <p class="ms-3">${response.data.community_services[0].services || 'N/A'}</p>
                    </div>
                ` : ''}

                ${response.data.values_learned && response.data.values_learned.length > 0 ? `
                    <div class="col-md-6">
                        <label class="fw-bold">Values Learned from Alma Mater:</label>
                        <ul class="list-group list-group-flush">
                            ${response.data.values_learned.map(value => `
                                <li class="list-group-item">
                                    <i class="bi bi-dot me-2"></i>${formatEnumValue(value.values_learned)}
                                    ${value.other_value ? `<br><small class="text-muted">Other: ${value.other_value}</small>` : ''}
                                </li>
                            `).join('')}
                        </ul>
                    </div>
                ` : ''}

                ${response.data.best_features && response.data.best_features.length > 0 ? `
                    <div class="col-md-6">
                        <label class="fw-bold">Best Feature(s) of the Institution:</label>
                        <ul class="list-group list-group-flush">
                            ${response.data.best_features.map(feature => `
                                <li class="list-group-item">
                                    <i class="bi bi-dot me-2"></i>${formatEnumValue(feature.best_features)}
                                    ${feature.other_feature ? `<br><small class="text-muted">Other: ${feature.other_feature}</small>` : ''}
                                </li>
                            `).join('')}
                        </ul>
                    </div>
                ` : ''}
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-12 text-center">
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-2"></i>
                        This information was collected as part of the graduate tracer study.
                        Last updated: ${response.data.general_info?.date ? 
                            new Date(response.data.general_info.date).toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            }) : 'Date not available'}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>`;
                        $('#graduateModal .modal-body').html(modalContent);
                    } else {
                        console.error('Error in response:', response);
                        $('#graduateModal .modal-body').html(
                            '<div class="alert alert-danger">' +
                            'Failed to load graduate information: ' + (response.message || 'Unknown error') +
                            '</div>'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching graduate information:", error);
                    console.error("Status:", status);
                    console.error("Response:", xhr.responseText);
                    $('#graduateModal .modal-body').html(
                        '<div class="alert alert-danger">' +
                        'An error occurred while fetching graduate information. Please try again.' +
                        '</div>'
                    );
                }
            });
        }

        // Print function
        function printGraduateInfo() {
            const printContent = document.getElementById('graduateModal').querySelector('.modal-body')
                .innerHTML;
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Graduate Information</title>
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
                        <style>
                            @media print {
                                .section { page-break-inside: avoid; }
                                .modal-body { padding: 20px; }
                            }
                        </style>
                    </head>
                    <body>
                        <div class="container mt-4">
                            ${printContent}
                        </div>
                    </body>
                </html>
            `);
            printWindow.document.close();
            setTimeout(() => {
                printWindow.print();
                printWindow.close();
            }, 250);
        }

        // Make functions available globally
        window.fetchGraduateAnswers = fetchGraduateAnswers;
        window.printGraduateInfo = printGraduateInfo;


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
                        showSuccessMessage(responseData.message);
                        window.location.reload();
                    } else {
                        throw new Error(responseData.message || 'Unknown error occurred.');
                    }
                })
                .catch(error => {
                    console.error('Error submitting the form:', error);
                    showErrorMessage('Failed to add the student. Please try again.');
                })
                .finally(() => {
                    submitButton.disabled = false;
                });
        });

        // Function to delete a student
        function deleteStudent(studentId) {
            showConfirmationDialog('Are you sure you want to delete this student?')
                .then((result) => {
                    if (result.isConfirmed) {
                fetch(`backend/delete_student.php?id=${studentId}`, {
                        method: 'GET'
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Failed to delete student.');
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                                    showSuccessMessage(data.message);
                            window.location.reload();
                        } else {
                                    showErrorMessage(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error deleting student:', error);
                                showErrorMessage('Failed to delete student. Please try again.');
                    });
            }
                });
        }

        // Expose functions globally to allow inline use in HTML
        window.deleteStudent = deleteStudent;
        window.viewStudent = viewStudent;


    });
    </script>
</body>

</html>