<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login - SEAIT Graduate Tracer</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
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
            <section class="section register d-flex flex-column align-items-center justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                    <div class="d-flex justify-content-center py-4">
                        <a href="index.html" class="logo d-flex align-items-center w-auto">
                            <span class="ms-2">SEAIT Graduate Tracer</span>
                        </a>
                    </div>

                    <div class="card login-card">

                        <div class="card-body">
                            <div class="pt-3 pb-2">
                                <h5 class="card-title text-center">Login to Your Account</h5>
                            </div>

                            <form id="loginForm" class="row g-3 needs-validation" novalidate>
                                <div class="col-12">
                                    <label for="yourUsername" class="form-label">Username</label>
                                    <div class="input-group has-validation">
                                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                                        <div class="invalid-feedback">Please enter your username.</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                                    <div class="invalid-feedback">Please enter your password!</div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">Remember me</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Login</button>
                                </div>

                                <div class="col-12 text-center">
                                    <p class="small mt-3">Don't have an account? <a href="pages-register.html">Create one</a></p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>
