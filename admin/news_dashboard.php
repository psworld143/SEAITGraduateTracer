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
    <title>Manage School News & Updates - SEAITGraduateTracer</title>

    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    <?php include('inc/header.php'); ?>
    <?php include('inc/sidebar.php'); ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Manage School News & Updates</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">School News</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Manage School News & Updates -->
                <div class="col-lg-8">
                    <div class="card shadow-sm border-light mb-4">
                        <div class="card-header text-dark">
                            <h5 class="card-title">School News & Updates</h5>
                        </div>
                        <div class="card-body pb-0">
                            <div class="table-responsive">
                                <table class="table table-bordered datatable" id="newsTable">
                                    <thead>
                                        <tr>
                                            <th>News Title</th>
                                            <th class="hidden-column">Image</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="newsList">
                                        <!-- News will be loaded via JS -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add New News/Update -->
                <div class="col-lg-4">
                    <div class="card shadow-sm border-light mb-4">
                        <div class="card-header text-dark">
                            <h5 class="card-title">Add New News/Update</h5>
                        </div>
                        <div class="card-body">
                            <form id="newsForm" class="row g-3" enctype="multipart/form-data">
                                <div class="col-12">
                                    <label for="newsTitle" class="form-label">News Title:</label>
                                    <input type="text" id="newsTitle" class="form-control" name="newsTitle" required>
                                </div>
                                <div class="col-12">
                                    <label for="newsImage" class="form-label">Attach Image:</label>
                                    <input type="file" id="newsImage" class="form-control" name="newsImage"
                                        accept="image/*" required>
                                </div>
                                <div class="col-12">
                                    <label for="newsDescription" class="form-label">News Description:</label>
                                    <div id="quillEditor" class="quill-editor-full" style="height: 200px;"></div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100">Post News</button>
                                </div>
                            </form>
                            <div id="responseMessage"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div class="modal fade" id="editNewsModal" tabindex="-1" aria-labelledby="editNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNewsModalLabel">Edit News</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editNewsForm" enctype="multipart/form-data">
                        <input type="hidden" id="editNewsId" name="newsId">
                        <div class="mb-3">
                            <label for="editNewsTitle" class="form-label">News Title</label>
                            <input type="text" class="form-control" id="editNewsTitle" name="newsTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="editNewsImage" class="form-label">Attach Image</label>
                            <input type="file" class="form-control" id="editNewsImage" name="newsImage"
                                accept="image/*">
                        </div>
                        <div class="mb-3" id="currentImageContainer"></div>
                        <div class="mb-3">
                            <label for="editNewsDescription" class="form-label">News Description</label>
                            <div id="editQuillEditor" style="height: 200px;"></div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include('inc/footer.php'); ?>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="assets/js/main.js"></script>
    <script>
    // Initialize Quill Editor for creating news
    var quill = new Quill('#quillEditor', {
        theme: 'snow',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline'],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                ['link', 'image', 'clean']
            ]
        }
    });

    // Initialize Quill Editor for editing news
    var editQuill = new Quill('#editQuillEditor', {
        theme: 'snow',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline'],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                ['link', 'image', 'clean']
            ]
        }
    });

    // Form submission for creating news
    document.getElementById('newsForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.append('newsDescription', quill.root.innerHTML);

        fetch('backend/save_news.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('responseMessage').textContent = data.message;
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        this.reset();
                        quill.setContents([]);
                        window.location.reload();
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while posting the news.'
                });
            });
    });

    // Fetch news and display in the table
    function loadNews() {
        fetch('backend/get_news.php')
            .then(response => response.json())
            .then(data => {
                const newsList = document.getElementById('newsList');
                newsList.innerHTML = ''; // Clear the list
                data.forEach(news => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${escapeHtml(news.newsTitle)}</td>
                        <td class="hidden-column"><img src="${news.newsImage}" alt="News Image" style="width: 100px; height: auto;"></td>
                        <td>${stripHTMLAndTruncate(news.newsDescription)}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="editNews(${news.id})">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="deleteNews(${news.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;
                    newsList.appendChild(row);
                });

                // Initialize DataTable
                const dataTable = new simpleDatatables.DataTable("#newsTable");
            })
            .catch(error => console.error('Error loading news:', error));
    }

    // Function to escape HTML characters for security
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Function to strip HTML tags and truncate text
    function stripHTMLAndTruncate(html, maxLength = 100) {
        const tmp = document.createElement("DIV");
        tmp.innerHTML = html;
        let text = tmp.textContent || tmp.innerText || "";
        return text.length > maxLength ? text.substr(0, maxLength) + "..." : text;
    }

    // Delete news
    function deleteNews(id) {
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
                fetch('backend/delete_news.php', {
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
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: data.message
                        });
                    }
                })
                .catch(error => {
                    console.error('Error deleting news:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while deleting the news.'
                    });
                });
            }
        });
    }

    // Edit News Function
    function editNews(id) {
        fetch(`backend/get_single_news.php?id=${id}`)
            .then(response => response.json())
            .then(response => {
                if (response.success) {
                    const data = response.data;
                    document.getElementById('editNewsId').value = data.id;
                    document.getElementById('editNewsTitle').value = data.newsTitle;
                    editQuill.root.innerHTML = data.newsDescription;

                    document.getElementById('editNewsImage').value = '';

                    const currentImageContainer = document.getElementById('currentImageContainer');
                    if (currentImageContainer) {
                        currentImageContainer.innerHTML = data.newsImage ?
                            `<img src="${data.newsImage}" alt="Current Image" style="max-width: 100px; margin-top: 10px;">` :
                            'No image currently';
                    }

                    const editNewsModal = document.getElementById('editNewsModal');
                    if (editNewsModal) {
                        editNewsModal.style.display = 'block';
                        editNewsModal.classList.add('show');
                    }
                } else {
                    throw new Error(response.message);
                }
            })
            .catch(error => {
                console.error('Error loading news:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while fetching the news data: ' + error.message
                });
            });
    }

    // Handle form submission for editing news
    document.getElementById('editNewsForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.append('newsDescription', editQuill.root.innerHTML);

        fetch('backend/update_news.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'News updated successfully!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        closeEditModal();
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.message
                    });
                }
            })
            .catch(error => {
                console.error('Error updating news:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while updating the news.'
                });
            });
    });

    // Function to close the modal
    function closeEditModal() {
        const editNewsModal = document.getElementById('editNewsModal');
        if (editNewsModal) {
            editNewsModal.style.display = 'none';
            editNewsModal.classList.remove('show');
        }
    }

    // Event listener for closing the modal
    document.addEventListener('DOMContentLoaded', function() {
        const closeButtons = document.querySelectorAll('[data-bs-dismiss="modal"]');
        closeButtons.forEach(button => {
            button.addEventListener('click', closeEditModal);
        });
    });

    // Load news on page load
    window.onload = loadNews;
    </script>


</body>

</html>