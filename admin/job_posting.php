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
    <title>Manage Job Postings - Admin</title>

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>

    <?php include('inc/header.php'); ?>
    <?php include('inc/sidebar.php'); ?>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Manage Job Postings</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Manage Job Postings</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow-sm border-light mb-4">
                                <div class="card-header text-dark">
                                    <h5 class="card-title">List of Current Job Postings</h5>
                                </div>
                                <div class="card-body pb-0">
                                    <div id="responseMessage"></div>
                                    <div class="table-responsive">
                                        <table id="jobPostingsTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Company Name</th>
                                                    <th>Job Title</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="jobPostingsList"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card shadow-sm border-light mb-4">
                        <div class="card-header text-dark">
                            <h5 class="card-title mb-0"><i class="bi bi-plus-circle-fill"></i> Add New Job Posting</h5>
                        </div>
                        <div class="card-body">
                            <form id="addJobForm" class="row g-3" enctype="multipart/form-data">
                                <div class="col-12">
                                    <label for="companyName" class="form-label">Company Name:</label>
                                    <input type="text" class="form-control" name="companyName" id="companyName"
                                        placeholder="Enter Company Name" required>
                                </div>
                                <div class="col-12">
                                    <label for="companyLogo" class="form-label">Upload Company Logo:</label>
                                    <input type="file" class="form-control" name="companyLogo" id="companyLogo"
                                        accept="image/*">
                                </div>
                                <div class="col-12">
                                    <label for="jobLocation" class="form-label">Job Location:</label>
                                    <input type="text" class="form-control" name="jobLocation" id="jobLocation"
                                        placeholder="Enter Job Location" required>
                                </div>
                                <div class="col-12">
                                    <label for="jobTitle" class="form-label">Job Title:</label>
                                    <input type="text" class="form-control" name="jobTitle" id="jobTitle"
                                        placeholder="Enter Job Title" required>
                                </div>
                                <div class="col-12">
                                    <label for="jobDescription" class="form-label">Job Description:</label>
                                    <textarea class="form-control" name="jobDescription" id="jobDescription"
                                        placeholder="Enter Job Description" rows="4" required></textarea>
                                </div>
                                <div class="col-12">
                                    <label for="qualifications" class="form-label">Qualifications/Requirements:</label>
                                    <textarea class="form-control" name="qualifications" id="qualifications"
                                        placeholder="Enter Qualifications/Requirements" rows="3" required></textarea>
                                </div>
                                <div class="col-12">
                                    <label for="applicationDeadline" class="form-label">Application Deadline:</label>
                                    <input type="date" class="form-control" name="applicationDeadline"
                                        id="applicationDeadline" required>
                                </div>
                                <div class="col-12">
                                    <label for="contactInfo" class="form-label">Contact Information:</label>
                                    <input type="text" class="form-control" name="contactInfo" id="contactInfo"
                                        placeholder="Enter Contact Information" required>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                                </div>
                            </form>
                            <div id="addResponseMessage" class="mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- View Job Modal -->
    <div class="modal fade" id="viewJobModal" tabindex="-1" aria-labelledby="viewJobModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewJobModalLabel">Job Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <h5 id="viewCompanyName" class="text-muted mb-0 font-weight-bold"></h5>
                        <h6 id="viewJobLocation" class="mb-2 font-weight-bold"></h6>
                    </div>

                    <div class="mb-3">
                        <p><strong>Job Title:</strong></p>
                        <p id="viewJobTitle" class="text-muted"></p>
                    </div>
                    <div class="mb-3">
                        <p><strong>Description:</strong></p>
                        <p id="viewJobDescription" class="text-muted"></p>
                    </div>
                    <div class="mb-3">
                        <p><strong>Qualifications:</strong></p>
                        <p id="viewQualifications" class="text-muted"></p>
                    </div>
                    <div class="mb-3">
                        <p><strong>Application Deadline:</strong></p>
                        <p id="viewApplicationDeadline" class="text-muted"></p>
                    </div>
                    <div class="mb-3">
                        <p><strong>Contact Information:</strong></p>
                        <p id="viewContactInfo" class="text-muted"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Job Modal -->
    <div class="modal fade" id="editJobModal" tabindex="-1" aria-labelledby="editJobModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editJobModalLabel">Edit Job Posting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editJobForm">
                        <input type="hidden" id="editJobId">

                        <!-- Row 1: Company Name and Company Logo -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="editCompanyName" class="form-label">Company Name:</label>
                                <input type="text" class="form-control" id="editCompanyName" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editCompanyLogo" class="form-label">Company Logo:</label>
                                <input type="file" class="form-control" id="editCompanyLogo">
                            </div>
                        </div>

                        <!-- Row 2: Job Location and Job Title -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="editJobLocation" class="form-label">Job Location:</label>
                                <input type="text" class="form-control" id="editJobLocation" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editJobTitle" class="form-label">Job Title:</label>
                                <input type="text" class="form-control" id="editJobTitle" required>
                            </div>
                        </div>

                        <!-- Row 3: Job Description (Full width) -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="editJobDescription" class="form-label">Job Description:</label>
                                <textarea class="form-control" id="editJobDescription" rows="4" required></textarea>
                            </div>
                        </div>

                        <!-- Row 4: Qualifications (Full width) -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="editQualifications" class="form-label">Qualifications/Requirements:</label>
                                <textarea class="form-control" id="editQualifications" rows="3" required></textarea>
                            </div>
                        </div>

                        <!-- Row 5: Application Deadline and Contact Information -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="editApplicationDeadline" class="form-label">Application Deadline:</label>
                                <input type="date" class="form-control" id="editApplicationDeadline" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editContactInfo" class="form-label">Contact Information:</label>
                                <input type="text" class="form-control" id="editContactInfo" required>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include('inc/footer.php'); ?>

    <!-- Include modal codes here -->

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
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener("DOMContentLoaded", async function() {
        // Initialize the DataTable
        let dataTable;

        // Function to fetch job postings and display them in the table
        async function fetchJobPostings() {
            try {
                const response = await fetch('backend/fetch_job_postings.php');
                const result = await response.json();

                if (result.success) {
                    const jobPostingsData = result.data.map(job => [
                        job.company_name,
                        job.job_title,
                        job.job_description,
                        `<button class="status-toggle btn ${job.status === 'active' ? 'btn-success' : 'btn-secondary'} btn-sm" data-id="${job.id}" data-status="${job.status}">
                    ${job.status === 'active' ? 'Active' : 'Inactive'}
                </button>`,
                        `<div class="btn-group" role="group">
                    <button class="btn btn-success btn-sm view-btn" data-id="${job.id}" title="View Job">View</button>
                    <button class="btn btn-primary btn-sm edit-btn" data-id="${job.id}" title="Edit Job">Edit</button>
                    <button class="btn btn-danger btn-sm delete-btn" data-id="${job.id}" title="Delete Job">Delete</button>
                </div>`
                    ]);

                    if (dataTable) {
                        dataTable.destroy();
                    }

                    dataTable = new simpleDatatables.DataTable("#jobPostingsTable", {
                        data: {
                            headings: ["Company Name", "Job Title", "Description", "Status", "Actions"],
                            data: jobPostingsData
                        }
                    });

                    setupStatusToggleListeners();
                    setupEditDeleteListeners();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: result.message
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error fetching job postings'
                });
            }
        }

        // Function to handle status toggle button clicks
        function setupStatusToggleListeners() {
            const statusButtons = document.querySelectorAll('.status-toggle');

            statusButtons.forEach(button => {
                button.addEventListener('click', async function() {
                    const jobId = this.getAttribute('data-id');
                    const currentStatus = this.getAttribute('data-status');
                    const newStatus = currentStatus === 'active' ? 'inactive' : 'active';

                    try {
                        const response = await fetch('backend/update_job_status.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                id: jobId,
                                status: newStatus
                            })
                        });

                        const result = await response.json();

                        if (result.success) {
                            this.classList.toggle('btn-success', newStatus === 'active');
                            this.classList.toggle('btn-secondary', newStatus === 'inactive');
                            this.textContent = newStatus === 'active' ? 'Active' : 'Inactive';
                            this.setAttribute('data-status', newStatus);
                            
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Status updated successfully'
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: result.message
                            });
                        }
                    } catch (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error updating job status'
                        });
                    }
                });
            });
        }

        // Function to delete a job
        async function deleteJob(jobId) {
            const result = await Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            });

            if (result.isConfirmed) {
                try {
                    const response = await fetch(`backend/delete_job_posting.php?id=${jobId}`, {
                        method: 'DELETE'
                    });
                    const result = await response.json();

                    if (result.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: result.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: result.message
                        });
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error deleting job'
                    });
                }
            }
        }

        // Function to view job details
        async function viewJob(jobId) {
            try {
                const response = await fetch(`backend/fetch_job_details.php?id=${jobId}`);
                const jobDetails = await response.json();

                if (jobDetails.success) {
                    // Removed company logo as requested
                    document.getElementById('viewCompanyName').innerText = jobDetails.data.company_name;
                    document.getElementById('viewJobLocation').innerText = jobDetails.data
                        .job_location; // Added job location
                    document.getElementById('viewJobTitle').innerText = jobDetails.data.job_title;
                    document.getElementById('viewJobDescription').innerText = jobDetails.data
                        .job_description;
                    document.getElementById('viewQualifications').innerText = jobDetails.data
                        .qualifications;
                    document.getElementById('viewApplicationDeadline').innerText = jobDetails.data
                        .application_deadline;
                    document.getElementById('viewContactInfo').innerText = jobDetails.data.contact_info;

                    // Show the modal
                    const viewJobModal = new bootstrap.Modal(document.getElementById('viewJobModal'));
                    viewJobModal.show();
                } else {
                    console.error(jobDetails.message);
                }
            } catch (error) {
                console.error('Error fetching job details:', error);
            }
        }

        // Function to edit job details
        async function editJob(jobId) {
            try {
                const response = await fetch(`backend/fetch_job_details.php?id=${jobId}`);
                const jobDetails = await response.json();

                if (jobDetails.success) {
                    document.getElementById('editJobId').value = jobDetails.data.id;
                    document.getElementById('editCompanyName').value = jobDetails.data.company_name;
                    document.getElementById('editJobLocation').value = jobDetails.data.job_location;
                    document.getElementById('editJobTitle').value = jobDetails.data.job_title;
                    document.getElementById('editJobDescription').value = jobDetails.data
                        .job_description;
                    document.getElementById('editQualifications').value = jobDetails.data
                        .qualifications;
                    document.getElementById('editApplicationDeadline').value = jobDetails.data
                        .application_deadline;
                    document.getElementById('editContactInfo').value = jobDetails.data.contact_info;

                    // Show the modal
                    const editJobModal = new bootstrap.Modal(document.getElementById('editJobModal'));
                    editJobModal.show();
                } else {
                    console.error(jobDetails.message);
                }
            } catch (error) {
                console.error('Error fetching job details for editing:', error);
            }
        }

        // Function to set up listeners for edit and delete buttons
        function setupEditDeleteListeners() {
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const jobId = this.getAttribute('data-id');
                    editJob(jobId); // Call editJob function
                });
            });

            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const jobId = this.getAttribute('data-id');
                    deleteJob(jobId); // Call deleteJob function
                });
            });

            document.querySelectorAll('.view-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const jobId = this.getAttribute('data-id');
                    viewJob(jobId); // Call viewJob function
                });
            });
        }

        // Handle job posting form submission
        const addJobForm = document.getElementById('addJobForm');

        addJobForm.addEventListener('submit', async function(event) {
            event.preventDefault();

            try {
                Swal.fire({
                    title: 'Saving job posting...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                const formData = new FormData(addJobForm);
                const response = await fetch('backend/save_job_posting.php', {
                    method: 'POST',
                    body: formData
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message
                    }).then(() => {
                        addJobForm.reset();
                        fetchJobPostings();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while saving the job posting. Please try again.'
                });
            }
        });

        // Initial fetch of job postings
        await fetchJobPostings();
    });
    </script>
</body>

</html>