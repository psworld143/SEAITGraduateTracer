<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar bg-light shadow-sm">

    <!-- Avatar Section -->
    <div class="sidebar-avatar text-center py-3">
        <img src="assets/img/image.png" alt="User Avatar" class="avatar-img rounded-circle img-fluid"
            style="width: 80px; height: 80px;">
        <p class="mt-2 fw-bold">Welcome, Admin!</p>
    </div>

    <!-- Sidebar Navigation -->
    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Main Section -->
        <li class="nav-heading text-muted">Main</li>

        <!-- Dashboard Section -->
        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <i class="bi bi-grid text-primary"></i>
                <span class="ms-2">Dashboard</span>
            </a>
        </li>

        <!-- Survey Section (Collapsible) -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#survey-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-file-text text-primary"></i>
                <span class="ms-2">Survey Management</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="survey-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="manage_survey.php" class="ps-4">
                        <i class="bi bi-circle"></i><span class="ms-2">Manage Alumni</span>
                    </a>
                </li>
                <li>
                    <a href="survey_result.php" class="ps-4">
                        <i class="bi bi-circle"></i><span class="ms-2">Survey Results</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Job Management Section (Collapsible) -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#job-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-briefcase text-primary"></i>
                <span class="ms-2">Job Management</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="job-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="job_posting.php" class="ps-4">
                        <i class="bi bi-circle"></i><span class="ms-2">Job Postings</span>
                    </a>
                </li>
                <li>
                    <a href="manage_application.php" class="ps-4">
                        <i class="bi bi-circle"></i><span class="ms-2">Manage Applications</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Document Management Section -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="document_inquiry.php">
                <i class="bi bi-folder text-primary"></i>
                <span class="ms-2">Manage Documents</span>
            </a>
        </li>

        <!-- User Management Section -->
        <li class="nav-heading text-muted">User Management</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="users_profile.php">
                <i class="bi bi-person-circle text-primary"></i>
                <span class="ms-2">User Profiles</span>
            </a>
        </li>

    </ul><!-- End Sidebar Navigation -->

</aside><!-- End Sidebar -->