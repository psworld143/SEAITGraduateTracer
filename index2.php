<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - Vesperr Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

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
    }

    .text-center {
        text-align: center;
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

    /* Section Title Styles */
    .section-title h2 {
        color: var(--primary-color);
        position: relative;
        padding-bottom: 15px;
    }

    .section-title h2::after {
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

    /* Button Styles */
    .btn-getstarted {
        background: var(--primary-gradient);
        border: none;
        padding: 8px 20px;
        border-radius: 50px;
        transition: all 0.3s ease;
    }

    .btn-getstarted:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 111, 63, 0.3);
    }

    /* Job Card Styles */
    .job-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(255, 111, 63, 0.1);
    }

    .job-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(255, 111, 63, 0.15);
    }

    .job-card .card-title a {
        color: var(--text-dark);
        transition: color 0.3s ease;
    }

    .job-card:hover .card-title a {
        color: var(--primary-color);
    }

    .job-details .badge {
        font-weight: 500;
        padding: 6px 12px;
        border-radius: 6px;
    }

    .badge.bg-primary {
        background: var(--primary-gradient) !important;
    }

    /* News Card Styles */
    .news-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(255, 111, 63, 0.1);
    }

    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(255, 111, 63, 0.15);
    }

    .news-card .card-title a {
        color: var(--text-dark);
        transition: color 0.3s ease;
    }

    .news-card:hover .card-title a {
        color: var(--primary-color);
    }

    .news-meta .badge {
        font-weight: 500;
        padding: 6px 12px;
        border-radius: 6px;
    }

    .news-card img.card-img-top {
        transition: transform 0.3s ease;
    }

    .news-card:hover img.card-img-top {
        transform: scale(1.05);
    }

    /* Footer Styles */
    .footer {
        background: var(--bg-gray);
        border-top: 1px solid rgba(255, 111, 63, 0.1);
    }

    .footer .sitename {
        color: var(--primary-color);
    }

    .footer .social-links a {
        color: var(--primary-color);
        transition: color 0.3s ease;
    }

    .footer .social-links a:hover {
        color: var(--primary-dark);
    }

    /* Scroll Top Button */
    .scroll-top {
        background: var(--primary-gradient);
        color: var(--text-light);
    }

    .scroll-top:hover {
        background: var(--primary-dark);
    }

    /* Section Backgrounds */
    .section {
        background: var(--bg-light);
    }

    .section.light-background {
        background: var(--bg-gray);
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
        <!-- Hero Section -->
        <section id="hero" class="hero section position-relative">
            <div class="hero-bg">
                <img src="assets/img/alumni.jpg" alt="">
            </div>
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-7 col-sm-9">
                        <div class="login-card">
                            <h2>Login</h2>
                            <form id="loginForm" class="needs-validation" novalidate>
                                <div class="form-group mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                        <div class="invalid-feedback">Please enter your username.</div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="password" class="form-control" id="password" name="password"
                                            required>
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <div class="invalid-feedback">Please enter your password.</div>
                                    </div>
                                </div>
                                <div class="form-group mb-3 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="rememberMe"
                                            name="rememberMe">
                                        <label class="form-check-label" for="rememberMe">Remember me</label>
                                    </div>
                                    <a href="#" class="text-decoration-none">Forgot password?</a>
                                </div>
                                <div class="form-group text-center mt-3">
                                    <p>Don't have an account? <a href="signup.php">Signup/Register</a></p>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary" id="loginButton">
                                        <span class="spinner-border spinner-border-sm d-none" role="status"
                                            aria-hidden="true"></span>
                                        Login
                                    </button>
                                </div>
                                <div class="alert alert-danger mt-3 d-none" id="errorMessage" role="alert"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Hero Section -->
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
                Designed by CodeCollective IT Solution</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

    <style>
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

    .login-card {
        background-color: rgba(255, 255, 255, 0.98);
        padding: 2.5rem;
        border-radius: 1.5rem;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
        width: 100%;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transform: translateY(0);
        transition: all 0.3s ease;
        margin: 0 auto;
    }

    .login-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.75rem 2rem rgba(0, 0, 0, 0.15);
    }

    .login-card h2 {
        margin-bottom: 2rem;
        text-align: center;
        color: #1a1a1a;
        font-weight: 700;
        font-size: 2rem;
        position: relative;
        padding-bottom: 1rem;
    }

    .login-card h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, #0d6efd, #0dcaf0);
        border-radius: 3px;
    }

    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .input-group {
        border-radius: 0.5rem;
        overflow: hidden;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
    }

    .input-group:focus-within {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .input-group-text {
        background-color: #f8f9fa;
        border: none;
        color: #6c757d;
    }

    .form-control {
        border: none;
        padding: 0.75rem 1rem;
    }

    .form-control:focus {
        box-shadow: none;
    }

    .btn-primary {
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

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 111, 63, 0.3);
    }

    .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .form-check-label {
        color: #6c757d;
    }

    .text-decoration-none {
        color: #0d6efd;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .text-decoration-none:hover {
        color: #0b5ed7;
        text-decoration: underline !important;
    }

    .alert {
        border-radius: 0.5rem;
        border: none;
        box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.05);
    }

    @media (max-width: 768px) {
        .login-card {
            margin: 1.5rem;
            padding: 2rem;
        }

        .hero {
            padding: 1rem;
        }
    }

    @media (max-width: 576px) {
        .login-card {
            margin: 1rem;
            padding: 1.5rem;
        }

        .login-card h2 {
            font-size: 1.75rem;
        }
    }
    </style>

    <script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('login.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes('Location:')) {
                    // If the response contains a Location header, redirect to that URL
                    window.location.href = data.split('Location: ')[1].trim();
                } else {
                    // Show error message using SweetAlert2
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Failed',
                        text: data,
                        confirmButtonColor: '#6e8efb'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while processing your request.',
                    confirmButtonColor: '#6e8efb'
                });
            });
    });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('loginForm');
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const loginButton = document.getElementById('loginButton');
        const errorMessage = document.getElementById('errorMessage');

        // Password visibility toggle
        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.querySelector('i').classList.toggle('bi-eye');
            this.querySelector('i').classList.toggle('bi-eye-slash');
        });

        // Check for remember me
        if (localStorage.getItem('rememberMe') === 'true') {
            document.getElementById('rememberMe').checked = true;
        }
    });
    </script>

</body>

</html>