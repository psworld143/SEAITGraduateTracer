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
    <title>SEAIT Graduate Tracer</title>

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
                <div class="col-lg-8">
                    <!-- Manage Document Status -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card shadow-sm border-light">
                                <div class="card-header text-dark">
                                    <h5 class="card-title">Manage Document Status</h5>
                                </div>
                                <div class="card-body pb-0">
                                    <div id="documentStatusMessage"></div>
                                    <div class="table-responsive">
                                        <table id="documentStatusTable" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Document Type</th>
                                                    <th>Status</th>
                                                    <th>Posted/Release Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="documentStatusList">
                                                <!-- Document status entries will be populated here -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="row">
                        <div class="col-12">
                            <div class="card shadow-sm border-light">
                                <div class="card-header text-dark">
                                    <h5 class="card-title">Document Inquiry List</h5>
                                </div>
                                <div class="card-body pb-0">
                                    <div id="inquiryListMessage"></div>
                                    <div class="table-responsive">
                                        <table id="inquiryListTable" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Student Name</th>
                                                    <th>Document Type</th>
                                                    <th>Date Requested</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="inquiryList">
                                                 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>

                <!-- Right side column (Post Document Availability) -->
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
                                    <button type="submit" class="btn btn-primary w-100">Submit/Post</button>
                                </div>
                            </form>
                            <div id="postDocumentMessage"></div>
                        </div>
                    </div>
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

    <!-- View Inquiry Modal -->
    <div class="modal fade" id="viewInquiryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Inquiry Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <strong>Student Name:</strong>
                        <span id="viewStudentName"></span>
                    </div>
                    <div class="mb-3">
                        <strong>Document Type:</strong>
                        <span id="viewDocumentType"></span>
                    </div>
                    <div class="mb-3">
                        <strong>Date Requested:</strong>
                        <span id="viewDateRequested"></span>
                    </div>
                    <div class="mb-3">
                        <strong>Status:</strong>
                        <span id="viewStatus"></span>
                    </div>
                    <div class="mb-3">
                        <strong>Purpose:</strong>
                        <span id="viewPurpose"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Inquiry Modal -->
    <div class="modal fade" id="updateInquiryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Inquiry Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateInquiryForm">
                        <input type="hidden" id="updateInquiryId" name="inquiry_id">
                        <div class="mb-3">
                            <label for="updateStatus" class="form-label">Status</label>
                            <select class="form-select" id="updateStatus" name="status" required>
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="completed">Completed</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="updateRemarks" class="form-label">Remarks</label>
                            <textarea class="form-control" id="updateRemarks" name="remarks" rows="3"></textarea>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Status</button>
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
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    // Function to handle document submission
    document.getElementById('postDocumentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('backend/save_document.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message || 'Document saved successfully!',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.reset();
                            loadDocuments(); // Reload the documents list
                        }
                    });
                } else {
                    throw new Error(data.message || 'Failed to save document');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: error.message || 'An error occurred while saving the document.',
                    confirmButtonText: 'OK'
                });
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
                            <button class="btn btn-success btn-sm" onclick="viewDocument(${doc.id})">View</button>
                            <button class="btn btn-primary btn-sm" onclick="editDocument(${doc.id})">Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="deleteDocument(${doc.id})">Delete</button>
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
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
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
                        Swal.fire({
                            icon: data.success ? 'success' : 'error',
                            title: data.success ? 'Success!' : 'Error!',
                            text: data.message,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            if (data.success) {
                                window.location.reload();
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error deleting document:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred while deleting the document.',
                            confirmButtonText: 'OK'
                        });
                    });
            }
        });
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
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to load document details: ' + error.message,
                    confirmButtonText: 'OK'
                });
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
        e.preventDefault();

        const formData = new FormData(this);

        fetch('backend/update_document.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Document updated successfully!',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#editDocumentModal').modal('hide');
                            window.location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Error: ' + data.message,
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                console.error('Error updating document:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while updating the document. Please try again.',
                    confirmButtonText: 'OK'
                });
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

    <script>
    // Initialize DataTable variable
    let inquiryDataTable;

    // Function to load document inquiries
    function loadDocumentInquiries() {
        fetch('backend/fetch_inquiries.php')
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

                const inquiryList = document.getElementById('inquiryList');
                inquiryList.innerHTML = ''; // Clear existing entries

                // Populate the inquiry list
                data.forEach(inquiry => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                    <td>${inquiry.student_name || 'N/A'}</td>
                    <td>${inquiry.document_type || 'N/A'}</td>
                    <td>${formatDate(inquiry.date_requested) || 'N/A'}</td>
                    <td>
                        <span class="badge ${getStatusBadgeClass(inquiry.status)}">
                            ${inquiry.status || 'N/A'}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-info btn-sm" onclick="viewInquiry(${inquiry.id})">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-primary btn-sm" onclick="updateInquiryStatus(${inquiry.id})">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="deleteInquiry(${inquiry.id})">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                `;
                    inquiryList.appendChild(row);
                });

                // Initialize or refresh DataTable
                if (inquiryDataTable) {
                    inquiryDataTable.destroy(); // Destroy existing DataTable instance
                }

                inquiryDataTable = new simpleDatatables.DataTable("#inquiryListTable", {
                    searchable: true,
                    fixedHeight: true,
                    perPage: 10,
                    columns: [{
                            select: 3,
                            sort: "desc"
                        }, // Sort by status column by default
                    ],
                    labels: {
                        placeholder: "Search inquiries...",
                        perPage: "entries per page",
                        noRows: "No document inquiries found",
                        info: "Showing {start} to {end} of {rows} inquiries",
                    }
                });
            })
            .catch(error => {
                console.error('Error loading inquiries:', error);
                document.getElementById('inquiryListMessage').innerHTML = `
                <div class="alert alert-danger">
                    Error loading inquiries: ${error.message}
                </div>
            `;
            });
    }

    // Helper function to format date
    function formatDate(dateString) {
        if (!dateString) return 'N/A';
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    // Helper function to get appropriate badge class based on status
    function getStatusBadgeClass(status) {
        switch (status?.toLowerCase()) {
            case 'pending':
                return 'bg-warning text-dark';
            case 'approved':
                return 'bg-success';
            case 'rejected':
                return 'bg-danger';
            case 'processing':
                return 'bg-info';
            default:
                return 'bg-secondary';
        }
    }

    // Function to view inquiry details
    function viewInquiry(inquiryId) {
        fetch(`backend/get_inquiry_details.php?id=${inquiryId}`)
            .then(response => response.json())
            .then(inquiry => {
                // Populate modal with inquiry details
                document.getElementById('viewStudentName').textContent = inquiry.student_name;
                document.getElementById('viewDocumentType').textContent = inquiry.document_type;
                document.getElementById('viewDateRequested').textContent = formatDate(inquiry.date_requested);
                document.getElementById('viewStatus').textContent = inquiry.status;
                document.getElementById('viewPurpose').textContent = inquiry.purpose || 'N/A';

                // Show the modal
                const viewModal = new bootstrap.Modal(document.getElementById('viewInquiryModal'));
                viewModal.show();
            })
            .catch(error => {
                console.error('Error fetching inquiry details:', error);
                alert('Failed to load inquiry details: ' + error.message);
            });
    }

    // Function to update inquiry status
    function updateInquiryStatus(inquiryId) {
        fetch(`backend/get_inquiry_details.php?id=${inquiryId}`)
            .then(response => response.json())
            .then(inquiry => {
                document.getElementById('updateInquiryId').value = inquiryId;
                document.getElementById('updateStatus').value = inquiry.status;
                document.getElementById('updateRemarks').value = inquiry.remarks || '';

                const updateModal = new bootstrap.Modal(document.getElementById('updateInquiryModal'));
                updateModal.show();
            })
            .catch(error => {
                console.error('Error fetching inquiry details for update:', error);
                alert('Failed to load inquiry details: ' + error.message);
            });
    }

    // Function to delete inquiry
    function deleteInquiry(inquiryId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('backend/delete_inquiry.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id: inquiryId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Inquiry deleted successfully!',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                loadDocumentInquiries();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Error: ' + data.message,
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error deleting inquiry:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred while deleting the inquiry.',
                            confirmButtonText: 'OK'
                        });
                    });
            }
        });
    }

    // Load inquiries when DOM content is loaded
    document.addEventListener('DOMContentLoaded', function() {
        loadDocumentInquiries();
    });

    // Update the loadDocumentInquiries function to handle errors better
    function loadDocumentInquiries() {
        const inquiryList = document.getElementById('inquiryList');
        if (!inquiryList) {
            console.error('Inquiry list element not found');
            return;
        }

        fetch('backend/fetch_inquiries.php')
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

                inquiryList.innerHTML = ''; // Clear existing entries

                data.forEach(inquiry => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                    <td>${inquiry.student_name || 'N/A'}</td>
                    <td>${inquiry.document_type || 'N/A'}</td>
                    <td>${formatDate(inquiry.date_requested) || 'N/A'}</td>
                    <td>
                        <span class="badge ${getStatusBadgeClass(inquiry.status)}">
                            ${inquiry.status || 'N/A'}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-info btn-sm" onclick="viewInquiry(${inquiry.id})">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-primary btn-sm" onclick="updateInquiryStatus(${inquiry.id})">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="deleteInquiry(${inquiry.id})">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                `;
                    inquiryList.appendChild(row);
                });

                // Initialize or refresh DataTable
                if (window.inquiryDataTable) {
                    window.inquiryDataTable.destroy();
                }

                window.inquiryDataTable = new simpleDatatables.DataTable("#inquiryListTable");
            })
            .catch(error => {
                console.error('Error loading inquiries:', error);
                inquiryList.innerHTML = `
                <tr>
                    <td colspan="5" class="text-center text-danger">
                        Error loading inquiries. Please try again later.
                    </td>
                </tr>
            `;
            });
    }
    </script>

</body>

</html>