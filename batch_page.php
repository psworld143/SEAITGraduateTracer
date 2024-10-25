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
                                                <option
                                                    value="Bachelor in Secondary Education Major in Math (BSEd - Math)">
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
                                        <input type="text" class="form-control" name="departmentCode"
                                            id="departmentCode" placeholder="Enter Department Code" required readonly>
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
                                        <input type="hidden" name="batch_id" id="batch_id"
                                            value="<?php echo $batch_id; ?>">
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
                            perPageSelect: responseData.data.length > 0 ? [5, 10, 15, 20, 25] :
                                false,
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
                            responseMessage.innerHTML = '<div class="alert alert-success">' +
                                responseData.message + '</div>';

                            window.location.reload();
                        } else {
                            throw new Error(responseData.message || 'Unknown error occurred.');
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