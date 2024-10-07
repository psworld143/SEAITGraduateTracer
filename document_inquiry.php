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
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
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

                <!-- Left side columns (Manage Document Status) -->
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow-sm border-light mb-4">
                                <div class="card-header text-dark">
                                    <h5 class="card-title">Manage Document Status</h5>
                                </div>
                                <div class="card-body pb-0">
                                    <div id="responseMessage"></div>
                                    <table id="documentStatusTable">
                                        <thead>
                                            <tr>
                                                <th>Document Type</th>
                                                <th>Status</th>
                                                <th>Posted/Release Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="documentStatusList">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Manage Document Status -->
                </div>


                <!-- Right side columns (Post Document Availability) -->
                <div class="col-lg-4">
                    <div class="card shadow-sm border-light mb-4">
                        <div class="card-header text-dark">
                            <h5 class="card-title"><i class="bi bi-plus-circle-fill"></i> Post Document Availability
                            </h5>
                        </div>
                        <div class="card-body">
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
                                    <label for="availabilityStatus" class="form-label">Availability
                                        Status:</label>
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
                                    <button type="submit" class="btn btn-primary w-100">Submit/Post</button>
                                </div>
                            </form>
                            <div id="responseMessage"></div>
                        </div>
                    </div><!-- End Post Document Availability -->
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <!-- View Document Modal -->
    <div class="modal fade" id="viewDocumentModal" tabindex="-1" aria-labelledby="viewDocumentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewDocumentModalLabel">Document Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 id="viewDocumentType" class="mb-3"></h6>

                    <p><strong>Availability Status:</strong></p>
                    <p id="viewAvailabilityStatus" class="text-muted"></p>

                    <p><strong>Release Date:</strong></p>
                    <p id="viewReleaseDate" class="text-muted"></p>

                    <p><strong>Additional Instructions:</strong></p>
                    <p id="viewAdditionalInstructions" class="text-muted"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Document Modal -->
    <div class="modal fade" id="editDocumentModal" tabindex="-1" aria-labelledby="editDocumentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDocumentModalLabel">Edit Document Inquiry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editDocumentForm">
                        <input type="hidden" id="editDocumentId" name="editDocumentId"> <!-- Add name attribute -->
                        <div class="mb-3">
                            <label for="editDocumentType" class="form-label">Document Type:</label>
                            <input type="text" class="form-control" id="editDocumentType" name="editDocumentType"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="editAvailabilityStatus" class="form-label">Availability Status:</label>
                            <input type="text" class="form-control" id="editAvailabilityStatus"
                                name="editAvailabilityStatus" required>
                        </div>
                        <div class="mb-3">
                            <label for="editReleaseDate" class="form-label">Release Date:</label>
                            <input type="date" class="form-control" id="editReleaseDate" name="editReleaseDate"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="editAdditionalInstructions" class="form-label">Additional Instructions:</label>
                            <textarea class="form-control" id="editAdditionalInstructions"
                                name="editAdditionalInstructions" rows="3" required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
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

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script>
    // Function to handle document submission
    document.getElementById('postDocumentForm').addEventListener('submit', function(e) {
        e.preventDefault();
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
                    alert(data.message);
                    this.reset();
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('responseMessage').innerHTML =
                    'An error occurred while saving the document.';
            });
    });

    let dataTable;

    // Load documents on DOM content loaded
    document.addEventListener('DOMContentLoaded', function() {
        loadDocuments();
    });

    // Function to fetch and display documents
    function loadDocuments() {
        fetch('backend/fetch_documents.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    throw new Error(data.error);
                }
                if (!Array.isArray(data)) {
                    throw new Error('Received data is not an array');
                }

                const documentStatusList = document.getElementById('documentStatusList');
                documentStatusList.innerHTML = ''; // Clear the list

                // Populate the document status list
                data.forEach(doc => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${doc.document_type || 'N/A'}</td>
                        <td>${doc.availability_status || 'N/A'}</td>
                        <td>${doc.release_date || 'N/A'}</td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="deleteDocument(${doc.id})">Delete</button>
                            <button class="btn btn-success btn-sm" onclick="viewDocument(${doc.id})">View</button>
                            <button class="btn btn-primary btn-sm" onclick="editDocument(${doc.id})">Edit</button>
                        </td>
                    `;
                    documentStatusList.appendChild(row);
                });

                // Initialize or refresh DataTable
                const documentStatusTable = document.getElementById('documentStatusTable');
                if (dataTable) {
                    dataTable.destroy(); // Destroy existing DataTable instance
                }
                dataTable = new simpleDatatables.DataTable("#documentStatusTable"); // Initialize new DataTable
            })
            .catch(error => {
                console.error('Error loading documents:', error);
            });
    }

    // Function to delete a document
    function deleteDocument(id) {
        if (confirm("Are you sure you want to delete this document?")) {
            fetch('backend/delete_document.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id
                    })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.success) {
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error deleting document:', error);
                    alert('An error occurred while deleting the document.');
                });
        }
    }

    // Function to view a document's details
    function viewDocument(docId) {
        fetch(`backend/get_document_details.php?id=${docId}`)
            .then(response => response.json())
            .then(doc => {
                document.getElementById('viewDocumentType').textContent = doc.document_type || 'N/A';
                document.getElementById('viewAvailabilityStatus').textContent = doc.availability_status || 'N/A';
                document.getElementById('viewReleaseDate').textContent = doc.release_date ? new Date(doc
                    .release_date).toLocaleDateString() : 'N/A';
                document.getElementById('viewAdditionalInstructions').textContent = doc.additional_instructions ||
                    'N/A';

                const viewModal = new bootstrap.Modal(document.getElementById('viewDocumentModal'));
                viewModal.show();
            })
            .catch(error => {
                console.error('Error fetching document details:', error);
                alert('Failed to load document details: ' + error.message);
            });
    }

    // Function to edit a document
    function editDocument(docId) {
        fetch(`backend/get_document_details.php?id=${docId}`)
            .then(response => response.json())
            .then(doc => {
                document.getElementById('editDocumentId').value = docId;
                document.getElementById('editDocumentType').value = doc.document_type;
                document.getElementById('editAvailabilityStatus').value = doc.availability_status;
                document.getElementById('editReleaseDate').value = doc.release_date;
                document.getElementById('editAdditionalInstructions').value = doc.additional_instructions;

                const editModal = new bootstrap.Modal(document.getElementById('editDocumentModal'));
                editModal.show();
                
            })
            .catch(error => {
                console.error('Error fetching document details for editing:', error);
            });
    }

    // Handle form submission for editing document
    document.getElementById('editDocumentForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent default form submission behavior

        const formData = new FormData(this); // Create a new FormData object from the form

        // Debugging: Log form data to verify it's being captured
        for (const [key, value] of formData.entries()) {
            console.log(key + ': ' + value); // Check what is being sent
        }

        // Fetch request to update the document
        fetch('backend/update_document.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Document updated successfully!');
                    $('#editDocumentModal').modal('hide'); // Hide the modal using Bootstrap method
                    window.location.reload(); // Refresh the page immediately
                } else {
                    alert('Error: ' + data.message); // Display server error message
                }
            })
            .catch(error => {
                console.error('Error updating document:', error); // Log error to console
                alert(
                    'An error occurred while updating the document. Please try again.'
                ); // User-friendly error message
            });
    });
    // Function to close the modal
    function closeEditModal() {
        const editDocumentModal = document.getElementById('editDocumentModal');
        if (editDocumentModal) {
            editDocumentModal.style.display = 'none';
            editDocumentModal.classList.remove('show');
        }
    }
    </script>
</body>

</html>