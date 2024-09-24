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
                            <h5 class="card-title mb-0">Add New Job Posting</h5>
                        </div>
                        <div class="card-body">
                            <form id="addJobForm" class="row g-3" enctype="multipart/form-data">
                                <div class="col-12">
                                    <label for="jobTitle" class="form-label">Job Title:</label>
                                    <input type="text" class="form-control" name="jobTitle" id="jobTitle" required>
                                </div>
                                <div class="col-12">
                                    <label for="jobDescription" class="form-label">Job Description:</label>
                                    <textarea class="form-control" name="jobDescription" id="jobDescription" rows="4"
                                        required></textarea>
                                </div>
                                <div class="col-12">
                                    <label for="qualifications" class="form-label">Qualifications/Requirements:</label>
                                    <textarea class="form-control" name="qualifications" id="qualifications" rows="3"
                                        required></textarea>
                                </div>
                                <div class="col-12">
                                    <label for="applicationDeadline" class="form-label">Application Deadline:</label>
                                    <input type="date" class="form-control" name="applicationDeadline"
                                        id="applicationDeadline" required>
                                </div>
                                <div class="col-12">
                                    <label for="contactInfo" class="form-label">Contact Information:</label>
                                    <input type="text" class="form-control" name="contactInfo" id="contactInfo"
                                        required>
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
    document.getElementById('addJobForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        const formData = new FormData(this); // Create a FormData object from the form

        fetch('backend/save_job_posting.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.json().then(data => {
                    console.log(data); // Log the entire response
                    const responseMessage = document.getElementById('responseMessage');
                    responseMessage.innerHTML = data.message; // Display success or error message

                    // Only reset the form and load job postings if the response indicates success
                    if (data.success) {
                        this.reset(); // Reset the form on success
                        loadJobPostings(); // Refresh the job postings list
                    } else {
                        console.error('Error saving job posting:', data.message);
                    }
                });
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('responseMessage').innerHTML =
                    'An error occurred. Please try again.';
            });
    });

    let dataTable; // Declare the datatable variable

    // Function to load job postings
    function loadJobPostings() {
        fetch('backend/get_job_postings.php')
            .then(response => response.json())
            .then(data => {
                const jobPostingsList = document.getElementById('jobPostingsList');
                jobPostingsList.innerHTML = ''; // Clear the list
                data.forEach(job => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${job.jobTitle}</td>
                        <td>${new Date(job.datePosted).toLocaleDateString()}</td>
                        <td>${job.status}</td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="deleteJob(${job.id})">Delete</button>
                            <button class="btn btn-success btn-sm" onclick="deleteJob(${job.id})">View</button>
                        </td>
                    `;
                    jobPostingsList.appendChild(row);
                });

                // Initialize the DataTable after loading the job postings
                if (dataTable) {
                    dataTable.destroy(); // Destroy the previous instance of the DataTable if it exists
                }
                dataTable = new simpleDatatables.DataTable("#jobPostingsTable"); // Initialize new DataTable
            })
            .catch(error => console.error('Error loading job postings:', error));
    }

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
                    alert(data.message);
                    loadJobPostings(); // Refresh the job postings list
                })
                .catch(error => console.error('Error deleting job posting:', error));
        }
    }

    // Call loadJobPostings on page load to populate the list
    window.onload = loadJobPostings;
    </script>



</body>

</html>
