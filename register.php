<?php
// Start the session
session_start();

// Include the database connection
require_once 'db_conn.php';

$error_message = '';
$success_message = '';

// Get token from URL parameter
$token = $_GET['token'] ?? '';

// If no token is provided, show error
if (empty($token)) {
    $error_message = "Invalid activation link. Please check your email for the correct activation link.";
} else {
    // Verify if token exists in database
    $stmt = $conn->prepare("SELECT id FROM students WHERE activation_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $error_message = "Invalid or expired activation token. Please request a new activation link.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['password'] ?? '';

    if (empty($new_password)) {
        $error_message = "Please enter a new password.";
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
            $success_message = "Account activated successfully! Redirecting to login page...";
            
            // Clear the activation token
            $stmt = $conn->prepare("UPDATE students SET activation_token = NULL WHERE activation_token = ?");
            $stmt->bind_param("s", $token);
            $stmt->execute();

            // Redirect to index2.php after 2 seconds
            header("refresh:2;url=index2.php");
        } else {
            $error_message = "Failed to activate account. Please try again or contact support.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SEAIT Graduate Tracer</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/logoseait.png" rel="icon">
    <link href="assets/img/logoseait.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

    <style>
    :root {
        --primary-gradient: linear-gradient(135deg, #ff9a3f, #ff6f3f, #ff3f3f);
        --primary-color: #ff6f3f;
        --primary-light: #ff9a3f;
        --primary-dark: #ff3f3f;
        --text-dark: #2c3e50;
        --text-light: #ffffff;
        --bg-light: #ffffff;
        --bg-gray: #f8f9fa;
        --transition-speed: 0.3s;
    }

    /* Header Styles */
    .header {
        background: var(--primary-gradient);
        padding: 15px 0;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }

    .header .logo .sitename,
    .header .navmenu a,
    .header .btn-getstarted {
        color: var(--text-light);
    }

    .header .navmenu a {
        font-weight: 500;
        padding: 8px 15px;
        transition: all var(--transition-speed) ease;
    }

    .header .navmenu a:hover,
    .header .navmenu .active {
        color: rgba(255, 255, 255, 0.9);
        transform: translateY(-2px);
    }

    .header .btn-getstarted {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 8px 20px;
        border-radius: 50px;
        transition: all var(--transition-speed) ease;
    }

    .header .btn-getstarted:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Hero Section */
    .hero {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, rgba(13, 110, 253, 0.1) 0%, rgba(13, 110, 253, 0.05) 100%);
        padding: 2rem 0;
    }

    .hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        opacity: 1;
    }

    .hero-bg img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Activation Card */
    .activation-card {
        background-color: rgba(255, 255, 255, 0.98);
        padding: 2.5rem;
        border-radius: 1.5rem;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
        width: 100%;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transform: translateY(0);
        transition: all var(--transition-speed) ease;
        margin: 0 auto;
    }

    .activation-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.75rem 2rem rgba(0, 0, 0, 0.15);
    }

    .activation-card .logo {
        text-align: center;
        margin-bottom: 2rem;
    }

    .activation-card .logo img {
        height: 50px;
        margin-bottom: 1rem;
    }

    .activation-card .logo h1 {
        color: var(--primary-color);
        font-size: 1.5rem;
        margin: 0;
    }

    .activation-card .card-title {
        color: var(--text-dark);
        font-size: 1.5rem;
        font-weight: 600;
        text-align: center;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 1rem;
    }

    .activation-card .card-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background: var(--primary-gradient);
        border-radius: 3px;
    }

    /* Form Elements */
    .form-label {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .form-control {
        border-radius: 10px;
        padding: 0.8rem 1rem;
        border: 1px solid rgba(0, 0, 0, 0.1);
        font-size: 0.95rem;
        transition: all var(--transition-speed) ease;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(255, 111, 63, 0.25);
    }

    .btn-activate {
        background: var(--primary-gradient);
        color: var(--text-light);
        border: none;
        border-radius: 10px;
        padding: 0.8rem;
        font-size: 1rem;
        font-weight: 500;
        width: 100%;
        transition: all var(--transition-speed) ease;
    }

    .btn-activate:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 111, 63, 0.3);
    }

    /* Alert Messages */
    .alert {
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        border: none;
        box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.05);
    }

    .alert-danger {
        background-color: #fff5f5;
        border-color: #feb2b2;
        color: #c53030;
    }

    .alert-success {
        background-color: #f0fff4;
        border-color: #9ae6b4;
        color: #2f855a;
    }

    /* Footer */
    .footer {
        background: var(--bg-gray);
        border-top: 1px solid rgba(255, 111, 63, 0.1);
        padding: 2rem 0;
    }

    .footer .social-links a {
        color: var(--primary-color);
        transition: color var(--transition-speed) ease;
    }

    .footer .social-links a:hover {
        color: var(--primary-dark);
    }

    .footer .credits {
        text-align: center;
        margin-top: 1rem;
        color: var(--text-dark);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .activation-card {
            margin: 1.5rem;
            padding: 2rem;
        }

        .hero {
            padding: 1rem;
        }
    }

    @media (max-width: 576px) {
        .activation-card {
            margin: 1rem;
            padding: 1.5rem;
        }

        .activation-card .card-title {
            font-size: 1.75rem;
        }
    }
    </style>
</head>

<body class="index-page">
    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">
            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <img src="assets/img/logoseait.png" alt="Logo 1" height="30" class="d-inline-block align-text-top me-2">
                <h1 class="sitename">AlumniGraduateTracer</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="index.php#about">About</a></li>
                    <li><a href="index.php#documents">Documents</a></li>
                    <li><a href="index.php#job-posting">Job Posting</a></li>
                    <li><a href="index.php#news">News</a></li>
                    <li><a href="index.php#survey">Survey</a></li>
                    <li><a href="index.php#contact">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="index2.php">Login</a>
        </div>
    </header>

    <main class="main">
        <section id="hero" class="hero section position-relative">
            <div class="hero-bg">
                <img src="assets/img/alumni.jpg" alt="">
            </div>
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-7 col-sm-9">
                        <div class="activation-card">
                            <div class="logo">
                                <img src="assets/img/logoseait.png" alt="SEAIT Logo">
                                <h1>SEAIT Graduate Tracer</h1>
                            </div>

                            <h5 class="card-title">Activate your account</h5>
                            
                            <?php if (!empty($error_message)): ?>
                                <div class="alert alert-danger"><?php echo $error_message; ?></div>
                            <?php endif; ?>
                            
                            <?php if (!empty($success_message)): ?>
                                <div class="alert alert-success"><?php echo $success_message; ?></div>
                            <?php endif; ?>

                            <?php if (empty($error_message) || strpos($error_message, 'Please enter') !== false): ?>
                            <form action="register.php?token=<?php echo htmlspecialchars($token); ?>" method="POST" class="needs-validation" novalidate>
                                <div class="mb-4">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" name="password" class="form-control" id="password" required>
                                    <div class="invalid-feedback">Please enter your new password!</div>
                                </div>

                                <button class="btn btn-activate" type="submit">Activate Account</button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer id="footer" class="footer">
        <div class="container">
            <div class="social-links d-flex justify-content-center">
                <a href=""><i class="bi bi-twitter-x"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
            <div class="credits">
                Designed by CodeCollective IT Solution
            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
</body>
</html>