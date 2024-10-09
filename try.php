<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - SEAITGraduateTracer</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Profile Overview</h5>
                            <div>
                                <p><strong>Name:</strong> John Doe</p>
                                <p><strong>Email:</strong> johndoe@example.com</p>
                                <p><strong>Account Type:</strong> Administrator</p>
                            </div>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
                            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">List of Users</h5>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#adduser" style="margin-right: 12px;">
                                    <i class="bx bx-plus"></i>Add User
                                </button>
                            </div>
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Account Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM user ORDER BY id DESC";
                                    if ($result = $con->query($query)) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['firstname'] . " " . $row['middlename'] . " " . $row['lastname'] . "</td>";
                                            echo "<td>" . $row['username'] . "</td>";
                                            echo "<td>" . $row['account_type'] . "</td>";
                                            echo "<td>
                                                    <button class='btn btn-success btn-sm' 
                                                              data-bs-toggle='modal' 
                                                              data-bs-target='#updateaccount' 
                                                              data-id='" . $row['id'] . "' 
                                                              data-firstname='" . $row['firstname'] . "' 
                                                              data-middlename='" . $row['middlename'] . "' 
                                                              data-lastname='" . $row['lastname'] . "' 
                                                              data-username='" . $row['username'] . "' 
                                                              data-account_type='" . $row['account_type'] . "' 
                                                              data-email='" . $row['email'] . "'>
                                                              Update
                                                    </button>
                                                    <button class='btn btn-danger btn-sm' 
                                                          data-bs-toggle='modal' 
                                                          data-bs-target='#deleteUserModal' 
                                                          data-id='" . $row['id'] . "'>
                                                          Delete
                                                    </button>
                                                  </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No data found.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Add User Modal -->
        <form action="backend/add-user.php" method="POST" id="addUserForm">
            <div class="modal fade" id="adduser" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">User Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for="firstname" class="form-label">First Name</label>
                                    <input type="text" name="firstname" class="form-control" id="firstname" required>
                                </div>
                                <div class="col-4">
                                    <label for="middlename" class="form-label">Middle Name</label>
                                    <input type="text" name="middlename" class="form-control" id="middlename">
                                </div>
                                <div class="col-4">
                                    <label for="lastname" class="form-label">Last Name</label>
                                    <input type="text" name="lastname" class="form-control" id="lastname" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" id="username" required>
                                </div>
                                <div class="col-6">
                                    <label for="inputState" class="form-label">Account Type</label>
                                    <select id="inputState" name="account_type" class="form-select">
                                        <option selected disabled>Select Account Type</option>
                                        <option value="registrar">Registrar</option>
                                        <option value="accounting">Accounting</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" name="email" class="form-control" id="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Update User Modal -->
        <form action="backend/update-user.php" method="POST" id="updateUserForm">
            <div class="modal fade" id="updateaccount" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Update User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="user_id" id="update_user_id">
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <label for="update_firstname" class="col-sm-2 col-form-label">First Name</label>
                                    <input type="text" class="form-control" id="update_firstname" name="update_firstname" required>
                                </div>
                                <div class="col-sm-4">
                                    <label for="update_middlename" class="col-sm-2 col-form-label">Middle Name</label>
                                    <input type="text" class="form-control" id="update_middlename" name="update_middlename">
                                </div>
                                <div class="col-sm-4">
                                    <label for="update_lastname" class="col-sm-2 col-form-label">Last Name</label>
                                    <input type="text" class="form-control" id="update_lastname" name="update_lastname" required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <label for="update_username" class="col-sm-2 col-form-label">Username</label>
                                    <input type="text" class="form-control" id="update_username" name="update_username" required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="update_account_type" class="col-sm-2 col-form-label">Account Type</label>
                                    <select class="form-select" id="update_account_type" name="update_account_type">
                                        <option selected disabled>Select Account Type</option>
                                        <option value="registrar">Registrar</option>
                                        <option value="accounting">Accounting</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-8">
                                    <label for="update_email" class="col-sm-2 col-form-label">Email</label>
                                    <input type="text" class="form-control" id="update_email" name="update_email" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Delete User Modal -->
        <div class="modal fade" id="deleteUserModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this user?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="backend/delete-user.php" method="POST">
                            <input type="hidden" name="delete_user_id" id="delete_user_id">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Profile Modal -->
        <div class="modal fade" id="editProfileModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="backend/edit-profile.php" method="POST">
                            <div class="mb-3">
                                <label for="editName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="editName" name="editName" value="John Doe">
                            </div>
                            <div class="mb-3">
                                <label for="editEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="editEmail" name="editEmail" value="johndoe@example.com">
                            </div>
                            <div class="mb-3">
                                <label for="editAccountType" class="form-label">Account Type</label>
                                <input type="text" class="form-control" id="editAccountType" name="editAccountType" value="Administrator" readonly>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Change Password Modal -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="backend/change-password.php" method="POST">
                            <div class="mb-3">
                                <label for="currentPassword" class="form-label">Current Password</label>
                                <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                            </div>
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmNewPassword" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <script>
        // Update user modal
        $('#updateaccount').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var userId = button.data('id');
            var firstname = button.data('firstname');
            var middlename = button.data('middlename');
            var lastname = button.data('lastname');
            var username = button.data('username');
            var accountType = button.data('account_type');
            var email = button.data('email');

            var modal = $(this);
            modal.find('#update_user_id').val(userId);
            modal.find('#update_firstname').val(firstname);
            modal.find('#update_middlename').val(middlename);
            modal.find('#update_lastname').val(lastname);
            modal.find('#update_username').val(username);
            modal.find('#update_account_type').val(accountType);
            modal.find('#update_email').val(email);
        });

        // Delete user modal
        $('#deleteUserModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var userId = button.data('id');

            var modal = $(this);
            modal.find('#delete_user_id').val(userId);
        });
    </script>

</body>

</html>
