<?php
// Start the session
session_start();

// Include the database connection
require_once 'db_conn.php';

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_GET['token'] ?? '';
    $new_password = $_POST['password'] ?? '';

    if (empty($token) || empty($new_password)) {
        $error_message = "Please provide both token and new password.";
    } else {
        // Sanitize inputs
        $token = htmlspecialchars($token, ENT_QUOTES, 'UTF-8');
        $new_password = htmlspecialchars($new_password, ENT_QUOTES, 'UTF-8');

        // Hash the new password
        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password in students table
        $stmt = $conn->prepare("UPDATE students SET password_hash = ?, account_status = 'active' WHERE activation_token = ?");
        $stmt->bind_param("ss", $password_hash, $token);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Password updated successfully
            $success_message = "Password has been reset successfully. You can now login.";
            
            // Clear the activation token
            $stmt = $conn->prepare("UPDATE students SET activation_token = NULL WHERE activation_token = ?");
            $stmt->bind_param("s", $token);
            $stmt->execute();

            // Redirect to index2.php after 2 seconds
            header("refresh:2;url=index2.php");
        } else {
            $error_message = "Invalid or expired token. Please request a new password reset.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Activate Account</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

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
    <style>
    body {
        background: linear-gradient(135deg, #ff9a3f, #ff6f3f, #ff3f3f);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Poppins', sans-serif;
    }

    .login-card {
        border-radius: 15px;
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
        background-color: white;
        padding: 2rem;
    }

    .login-card .card-title {
        font-weight: 600;
        font-size: 1.5rem;
        color: #333;
    }

    .form-control {
        border-radius: 10px;
        padding: 0.8rem;
        margin-bottom: .5rem;
    }

    .btn-primary {
        background-color: #6e8efb;
        border-color: #6e8efb;
        border-radius: 10px;
        padding: 0.8rem;
        font-size: 1rem;
        font-weight: 500;
    }

    .btn-primary:hover {
        background-color: #5a7de0;
    }

    .form-check-label {
        font-size: 0.9rem;
        color: #666;
    }

    a {
        color: #6e8efb;
    }

    a:hover {
        color: #5a7de0;
    }
    </style>
</head>

<body>
    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <span class="d-none d-lg-block">SEAITGraduateTracer</span>
                                </a>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Activate your account</h5>
                                        <?php if (!empty($error_message)): ?>
                                            <div class="alert alert-danger mt-3"><?php echo $error_message; ?></div>
                                        <?php endif; ?>
                                        <?php if (!empty($success_message)): ?>
                                            <div class="alert alert-success mt-3"><?php echo $success_message; ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <form action="activate.php?token=<?php echo htmlspecialchars($_GET['token']); ?>" method="POST" class="row g-3 needs-validation" novalidate>
                                        <div class="col-12">
                                            <label for="password" class="form-label">New Password</label>
                                            <input type="password" name="password" class="form-control" id="password" required>
                                            <div class="invalid-feedback">Please enter your new password!</div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Reset Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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
</body>
</html> 