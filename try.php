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
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">
                        <!-- Job Postings List -->
                        <div class="col-12">
                            <div class="card shadow-sm border-light mb-4">
                                <div class="card-header text-dark">
                                    <h5 class="card-title pb-0">List of Current Job Postings</h5>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered" id="jobPostingsTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Job Title</th>
                                                    <th>Date Posted</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="jobPostingsList">
                                                <!-- Job Posting Template will be loaded via JS -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Job Postings List -->

                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">
                    <!-- Add New Job Posting -->
                    <div class="card shadow-sm border-light mb-4">
                        <div class="card-header text-dark">
                            <h5 class="card-title mb-0"><i class="bi bi-plus-circle-fill"></i> Add New Job Posting</h5>
                        </div>
                        <div class="card-body">
                            <form id="addJobForm" class="row g-3">
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
                                <div class="col-12">
                                    <label for="fileUpload" class="form-label">Upload Additional Documents:</label>
                                    <input type="file" class="form-control" name="fileUpload" id="fileUpload">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                                </div>
                            </form>
                            <div id="responseMessage" class="mt-3"></div>
                        </div>
                    </div><!-- End Add New Job Posting -->
                </div><!-- End Right side columns -->

            </div>
        </section>
    </main><!-- End #main -->

    <?php include('inc/footer.php'); ?>

    <!-- View Job Modal -->
    <div class="modal fade" id="viewJobModal" tabindex="-1" aria-labelledby="viewJobModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewJobModalLabel">Job Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 id="viewJobTitle" class="mb-3"></h6>

                    <p><strong>Description:</strong></p>
                    <p id="viewJobDescription" class="text-muted"></p>

                    <p><strong>Qualifications:</strong></p>
                    <p id="viewQualifications" class="text-muted"></p>

                    <p><strong>Application Deadline:</strong></p>
                    <p id="viewApplicationDeadline" class="text-muted"></p>

                    <p><strong>Contact Information:</strong></p>
                    <p id="viewContactInfo" class="text-muted"></p>
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
                        <div class="mb-3">
                            <label for="editJobTitle" class="form-label">Job Title:</label>
                            <input type="text" class="form-control" id="editJobTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="editJobDescription" class="form-label">Job Description:</label>
                            <textarea class="form-control" id="editJobDescription" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editQualifications" class="form-label">Qualifications/Requirements:</label>
                            <textarea class="form-control" id="editQualifications" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editApplicationDeadline" class="form-label">Application Deadline:</label>
                            <input type="date" class="form-control" id="editApplicationDeadline" required>
                        </div>
                        <div class="mb-3">
                            <label for="editContactInfo" class="form-label">Contact Information:</label>
                            <input type="text" class="form-control" id="editContactInfo" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


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
    <script>
    // Declare the DataTable variable
    let dataTable;

    // Function to load job postings
    function loadJobPostings() {
        console.log('loadJobPostings function called');
        fetch('backend/get_job_postings.php')
            .then(response => {
                console.log('Response received:', response);
                return response.json();
            })
            .then(response => {
                console.log('Data received:', response);
                if (!response.success) {
                    throw new Error(response.message || 'Failed to load job postings');
                }
                updateJobPostingsTable(response.data);
            })
            .catch(error => {
                console.error('Error loading job postings:', error);
                alert('Failed to load job postings: ' + error.message);
            });
    }

    // Function to update job postings table
    function updateJobPostingsTable(data) {
        const jobPostingsList = document.getElementById('jobPostingsList');
        if (!jobPostingsList) {
            console.error('jobPostingsList element not found');
            return;
        }
        jobPostingsList.innerHTML = ''; // Clear the list

        if (data.length === 0) {
            console.log('No job postings data received');
            jobPostingsList.innerHTML = '<tr><td colspan="4">No job postings available</td></tr>';
        } else {
            data.forEach(job => {
                console.log('Processing job:', job);
                const row = document.createElement('tr');
                row.innerHTML = `
            <td>${job.jobTitle || 'N/A'}</td>
            <td>${job.datePosted ? new Date(job.datePosted).toLocaleDateString() : 'N/A'}</td>
            <td>${job.status || 'N/A'}</td>
            <td>
                <button class="btn btn-danger btn-sm" onclick="deleteJob(${job.id})">Delete</button>
                <button class="btn btn-success btn-sm" onclick="viewJob(${job.id})">View</button>
                <button class="btn btn-primary btn-sm" onclick="editJob(${job.id})">Edit</button>
            </td>
        `;
                jobPostingsList.appendChild(row);
            });
        }

        console.log('Initializing DataTable');
        if (dataTable) {
            dataTable.destroy(); // Destroy the previous instance of the DataTable if it exists
        }
        dataTable = new simpleDatatables.DataTable("#jobPostingsTable");
        console.log('DataTable initialized');
    }

    // Function to edit a job
    function editJob(jobId) {
        console.log('editJob called with jobId:', jobId);
        fetch(`backend/get_job_details.php?id=${jobId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(job => {
                console.log('Job data received:', job);
                if (!job || typeof job !== 'object') {
                    throw new Error('Invalid job data received');
                }
                if (job.error) {
                    throw new Error(job.error);
                }
                document.getElementById('editJobId').value = jobId;
                document.getElementById('editJobTitle').value = job.jobTitle || '';
                document.getElementById('editJobDescription').value = job.jobDescription || '';
                document.getElementById('editQualifications').value = job.qualifications || '';
                document.getElementById('editApplicationDeadline').value = job.applicationDeadline || '';
                document.getElementById('editContactInfo').value = job.contactInfo || '';

                // Check if the modal element exists
                const modalElement = document.getElementById('editJobModal');
                if (!modalElement) {
                    throw new Error('Edit job modal element not found');
                }

                // Check if Bootstrap is available
                if (typeof bootstrap === 'undefined' || typeof bootstrap.Modal === 'undefined') {
                    throw new Error('Bootstrap is not loaded');
                }

                // Try to initialize and show the modal
                try {
                    const editModal = new bootstrap.Modal(modalElement);
                    editModal.show();
                } catch (modalError) {
                    console.error('Error showing modal:', modalError);
                    throw new Error('Failed to show edit modal');
                }
            })
            .catch(error => {
                console.error('Error in editJob:', error);
                alert(`An error occurred while editing the job. Please try again. (${error.message})`);
            });
    }

    // Function to view job details
    function viewJob(jobId) {
        fetch(`backend/get_job_details.php?id=${jobId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(job => {
                if (job.error) {
                    throw new Error(job.error);
                }
                document.getElementById('viewJobTitle').textContent = job.jobTitle || 'N/A';
                document.getElementById('viewJobDescription').textContent = job.jobDescription || 'N/A';
                document.getElementById('viewQualifications').textContent = job.qualifications || 'N/A';
                document.getElementById('viewApplicationDeadline').textContent = job.applicationDeadline ? new Date(
                    job.applicationDeadline).toLocaleDateString() : 'N/A';
                document.getElementById('viewContactInfo').textContent = job.contactInfo || 'N/A';

                const viewModal = new bootstrap.Modal(document.getElementById('viewJobModal'));
                viewModal.show();
            })
            .catch(error => {
                console.error('Error fetching job details:', error);
                alert(`Failed to load job details: ${error.message}`);
            });
    }

    // Function to add a new job posting
    document.getElementById('addJobForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('backend/save_job_posting.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const responseMessage = document.getElementById('responseMessage');
                responseMessage.innerHTML = data.message;

                if (data.success) {
                    alert(data.message);
                    this.reset();
                    location.reload(); // Refresh the page after adding
                } else {
                    console.error('Error saving job posting:', data.message);
                    alert('Failed to save job posting: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
    });

    // Function to update a job posting
    document.getElementById('editJobForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const jobData = {
            id: document.getElementById('editJobId').value,
            jobTitle: document.getElementById('editJobTitle').value,
            jobDescription: document.getElementById('editJobDescription').value,
            qualifications: document.getElementById('editQualifications').value,
            applicationDeadline: document.getElementById('editApplicationDeadline').value,
            contactInfo: document.getElementById('editContactInfo').value,
        };

        fetch('backend/update_job_posting.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(jobData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    const editModal = bootstrap.Modal.getInstance(document.getElementById('editJobModal'));
                    editModal.hide();
                    location.reload(); // Refresh the page after updating
                } else {
                    throw new Error(data.message || 'Unknown error occurred');
                }
            })
            .catch(error => {
                console.error('Error updating job posting:', error);
                alert('Failed to update job posting. Please try again.');
            });
    });

    // Function to delete a job posting
    function deleteJob(id) {
        if (confirm("Are you sure you want to delete this job posting?")) {
            fetch('backend/delete_job_posting.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload(); // Refresh the page after deletion
                    } else {
                        throw new Error(data.message || 'Failed to delete job posting');
                    }
                })
                .catch(error => {
                    console.error('Error deleting job posting:', error);
                    alert('Failed to delete job posting: ' + error.message);
                });
        }
    }

    // Initialize the page
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOMContentLoaded event fired');
        loadJobPostings(); // Load job postings on page load
    });
    </script>
</body>

</html>