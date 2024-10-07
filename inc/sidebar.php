<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <!-- Avatar Section -->
    <div class="sidebar-avatar text-center py-3">
        <img src="assets/img/image.png" alt="User Avatar" class="avatar-img rounded-circle img-fluid" style="width: 80px; height: 80px;">
        <p class="mt-2 fw-bold">Welcome, Admin!</p>
    </div>

    <?php
        // Get the current page name
        $current_page = basename($_SERVER['PHP_SELF']);
    ?>

    <!-- Sidebar Navigation -->
    <nav class="sidebar-nav" id="sidebar-nav">
        <ul>

            <!-- Main Section -->
            <li class="nav-heading text-muted">Dashboard</li>

            <!-- Dashboard Section -->
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php" aria-label="Dashboard">
                    <i class="bi bi-grid <?php echo ($current_page == 'index.php') ? 'text-white' : 'text-primary'; ?>"></i>
                    <span class="ms-2">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'manage_alumni.php') ? 'active' : ''; ?>" href="manage_alumni.php" aria-label="Manage Alumni">
                    <i class="bi bi-person-lines-fill <?php echo ($current_page == 'manage_alumni.php') ? 'text-white' : 'text-primary'; ?>"></i>
                    <span class="ms-2">Manage Alumni</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'news_dashboard.php') ? 'active' : ''; ?>" href="news_dashboard.php" aria-label="News Dashboard">
                    <i class="bi bi-check-circle <?php echo ($current_page == 'news_dashboard.php') ? 'text-white' : 'text-primary'; ?>"></i>
                    <span class="ms-2">News Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'job_posting.php') ? 'active' : ''; ?>" href="job_posting.php" aria-label="Job Posting">
                    <i class="bi bi-briefcase <?php echo ($current_page == 'job_posting.php') ? 'text-white' : 'text-primary'; ?>"></i>
                    <span class="ms-2">Job Posting</span>
                </a>
            </li>

            <!-- Document Management Section -->
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'document_inquiry.php') ? 'active' : ''; ?>" href="document_inquiry.php" aria-label="Manage Documents">
                    <i class="bi bi-folder <?php echo ($current_page == 'document_inquiry.php') ? 'text-white' : 'text-primary'; ?>"></i>
                    <span class="ms-2">Manage Documents</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'user.php') ? 'active' : ''; ?>" href="user.php" aria-label="User">
                    <i class="bi bi-person-circle <?php echo ($current_page == 'user.php') ? 'text-white' : 'text-primary'; ?>"></i>
                    <span class="ms-2">User Account</span>
                </a>
            </li>

            <!-- <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'users_profile.php') ? 'active' : ''; ?>" href="users_profile.php" aria-label="User Profiles">
                    <i class="bi bi-person-circle <?php echo ($current_page == 'users_profile.php') ? 'text-white' : 'text-primary'; ?>"></i>
                    <span class="ms-2">User Profiles</span>
                </a>
            </li> -->

        </ul>
    </nav>

</aside><!-- End Sidebar -->
