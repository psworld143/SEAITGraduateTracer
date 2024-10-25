<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Dashboard - SEAIT Graduate Tracer</title>
    <meta content="User management dashboard for SEAIT Graduate Tracer." name="description">
    <meta content="SEAIT, Graduate Tracer, User Management" name="keywords">

    <!-- Favicons -->
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

    <?php include('inc/header.php'); ?>
    <?php include('inc/sidebar.php'); ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>User Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php"><i class="bi bi-house-door"></i></a></li>
                    <li class="breadcrumb-item active">User Management</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="col-lg-20">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">List of Users</h5>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#adduser">
                                <i class="bx bx-plus"></i>Add User
                            </button>
                        </div>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- User data will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <!-- Add User Modal -->
        <form id="addUserForm">
            <div class="modal fade" id="adduser" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">User Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="firstname" class="form-label">First Name</label>
                                        <input type="text" name="firstname" class="form-control" id="firstname"
                                            required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="middlename" class="form-label">Middle Name</label>
                                        <input type="text" name="middlename" class="form-control" id="middlename">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="lastname" class="form-label">Last Name</label>
                                        <input type="text" name="lastname" class="form-control" id="lastname" required>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <div class="col-md-8">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" id="username" required>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <div class="col-md-8">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </main>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script>
    $(document).ready(function() {
        // Handle the form submission for adding a user
        $('#addUserForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting the default way

            // Collect form data
            const formData = {
                firstname: $('#firstname').val(),
                middlename: $('#middlename').val(),
                lastname: $('#lastname').val(),
                username: $('#username').val(),
                password: $('#password').val()
            };

            // Send data to add_user.php using AJAX
            $.ajax({
                type: 'POST',
                url: 'backend/add_user.php',
                data: formData,
                dataType: 'json', // Expect a JSON response
                success: function(response) {
                    // Handle the response from the server
                    if (response.success) {
                        // Reload the user list
                        fetchUserData();
                        // Close the modal
                        $('#adduser').modal('hide');

                        // Show success toast
                        showToast('User added successfully!', 'success');
                        // Reset the form fields
                        $('#addUserForm')[0].reset();
                    } else {
                        showToast('Error: ' + response.message, 'danger');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Request failed:', textStatus, errorThrown);
                    showToast('Request failed: ' + textStatus, 'danger');
                }
            });
        });

        // Function to fetch user data and display in DataTable
        function fetchUserData() {
            $.ajax({
                type: 'GET',
                url: 'backend/fetch_user.php', // Adjust path as necessary
                dataType: 'json',
                success: function(data) {
                    // Initialize the DataTable with the fetched data
                    const tableBody = $('table.datatable tbody');
                    tableBody.empty(); // Clear existing data

                    // Populate table with user data
                    data.forEach(user => {
                        tableBody.append(`
                    <tr>
                        <td>${user.firstname} ${user.middlename ? user.middlename + ' ' : ''}${user.lastname}</td>
                        <td>${user.username}</td>
                        <td>********</td> <!-- Password is not displayed for security -->
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="deleteUser(${user.id})">Delete</button> <!-- Example action -->
                        </td>
                    </tr>
                `);
                    });

                    // Initialize DataTable after populating
                    if ($.fn.DataTable.isDataTable('.datatable')) {
                        $('.datatable').DataTable()
                            .destroy(); // Destroy existing DataTable instance
                    }
                    $('.datatable').DataTable(); // Initialize new DataTable
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Failed to fetch user data:', textStatus, errorThrown);
                    showToast('Failed to fetch user data: ' + textStatus, 'danger');
                }
            });
        }

        // Function to show toast notifications
        function showToast(message, type) {
            // Create a toast element
            const toastHTML = `
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; top: 20px; right: 20px;">
                <div class="toast-header">
                    <strong class="me-auto">${type === 'success' ? 'Success' : 'Error'}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    ${message}
                </div>
            </div>
        `;

            // Append the toast to the body
            $('body').append(toastHTML);

            // Show the toast
            const toastElement = $('.toast').last();
            const bsToast = new bootstrap.Toast(toastElement[0]);
            bsToast.show();

            // Remove the toast after a timeout
            setTimeout(() => {
                toastElement.remove();
            }, 5000); // Adjust time as needed
        }

        // Call the fetchUserData function on page load
        fetchUserData();
    });
    </script>


</body>

</html>