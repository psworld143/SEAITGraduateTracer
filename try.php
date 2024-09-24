<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Document Inquiry - Admin</title>

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

    <?php include('inc/header.php'); ?>
    <?php include('inc/sidebar.php'); ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Document Inquiry</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Document Inquiry</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-6">
                    <!-- Post Document Availability -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Post Document Availability</h5>
                            <form id="postDocumentForm" class="row g-3">
                                <div class="col-12">
                                    <label for="documentType" class="form-label">Document Type:</label>
                                    <select id="documentType" class="form-select" name="documentType" required>
                                        <option value="" selected>Select Document Type</option>
                                        <option value="Transcript">Transcript</option>
                                        <option value="Diploma">Diploma</option>
                                        <option value="Certification">Certification</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="availabilityStatus" class="form-label">Availability Status:</label>
                                    <select id="availabilityStatus" class="form-select" name="availabilityStatus"
                                        required>
                                        <option value="" selected>Select Status</option>
                                        <option value="Available for Release">Available for Release</option>
                                        <option value="Not Available">Not Available</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="releaseDate" class="form-label">Release Date:</label>
                                    <input type="date" class="form-control" name="releaseDate" id="releaseDate"
                                        required>
                                </div>
                                <div class="col-12">
                                    <label for="additionalInstructions" class="form-label">Additional
                                        Instructions:</label>
                                    <textarea class="form-control" name="additionalInstructions"
                                        id="additionalInstructions" rows="3"></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit/Post</button>
                                </div>
                            </form>
                            <div id="responseMessage"></div>
                        </div>
                    </div><!-- End Post Document Availability -->
                </div>

                <!-- Right side columns -->
                <div class="col-lg-6">
                    <!-- Manage Document Status -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Document Status</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Document Type</th>
                                        <th>Status</th>
                                        <th>Posted/Release Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="documentStatusList">
                                    <!-- Document Status Template will be loaded via JS -->
                                </tbody>
                            </table>
                        </div>
                    </div><!-- End Manage Document Status -->
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchDocuments();
    });

    // Function to fetch documents from the database
    function fetchDocuments() {
        fetch('backend/fetch_documents.php')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('documentStatusList');
                tableBody.innerHTML = ''; // Clear the table body

                data.forEach(doc => {
                    const newRow = document.createElement('tr');
                    newRow.innerHTML = 
                    <td>${doc.document_type}</td>
                    <td>${doc.availability_status}</td>
                    <td>${doc.release_date}</td>
                    <td><button class="btn btn-danger delete-btn" data-id="${doc.id}">Delete</button></td>
                ;
                    tableBody.appendChild(newRow);
                });

                // Attach event listeners to delete buttons
                attachDeleteListeners();
            })
            .catch(error => {
                console.error('Error fetching documents:', error);
            });
    }

    // Function to handle form submission
    document.getElementById('postDocumentForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        const releaseDate = new Date(document.getElementById('releaseDate').value);
        const today = new Date();

        if (releaseDate < today) {
            alert('Release date cannot be in the past.');
            return; // Prevent form submission if date is invalid
        }

        const formData = new FormData(this);

        fetch('backend/save_document.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const responseMessage = document.getElementById('responseMessage');
                responseMessage.innerHTML = data.message;

                if (data.status === 'success') {
                    // Append new row to the table
                    const tableBody = document.getElementById('documentStatusList');
                    const newRow = document.createElement('tr');

                    newRow.innerHTML = 
                <td>${data.data.documentType}</td>
                <td>${data.data.availabilityStatus}</td>
                <td>${data.data.releaseDate}</td>
                <td><button class="btn btn-danger delete-btn" data-id="${data.data.id}">Delete</button></td>
            ;

                    tableBody.appendChild(newRow);
                    this.reset(); // Reset form after submission

                    // Attach delete listener for the new button
                    attachDeleteListeners();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    // Function to attach delete listeners to delete buttons
    function attachDeleteListeners() {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const documentId = this.getAttribute('data-id');
                deleteDocument(documentId);
            });
        });
    }

    // Function to delete a document
    function deleteDocument(id) {
        console.log("Attempting to delete document with ID:", id);
        if (confirm('Are you sure you want to delete this document?')) {
            fetch(backend/delete_document.php?id=${id}, {
                    method: 'GET' // Changed to GET
                })
                .then(response => response.json())
                .then(data => {
                    const responseMessage = document.getElementById('responseMessage');
                    responseMessage.innerHTML = data.message;

                    if (data.status === 'success') {
                        fetchDocuments(); // Refresh the document list
                    }
                })
                .catch(error => {
                    console.error('Error deleting document:', error);
                });
        }
    }
    </script>


</body>

</html>