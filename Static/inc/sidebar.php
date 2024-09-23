<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <!-- Avatar Section -->
    <div class="sidebar-avatar text-center">
        <img src="assets/img/image.png" alt="User Avatar" class="avatar-img">
    </div>
    <br>

    <!-- Sidebar Navigation -->
    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Main Section -->
        <li class="nav-heading">Main</li>

        <!-- Dashboard Section -->
        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Survey Section (Collapsible) -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#survey-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-file-text"></i>
                <span>Survey Management</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="survey-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="manage_survey.php">
                        <i class="bi bi-circle"></i><span>Manage Alumni</span>
                    </a>
                </li>
                <li>
                    <a href="survey_result.php">
                        <i class="bi bi-circle"></i><span>Survey Results</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Job Management Section (Collapsible) -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#job-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-briefcase"></i>
                <span>Job Management</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="job-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="job_posting.php">
                        <i class="bi bi-circle"></i><span>Job Postings</span>
                    </a>
                </li>
                <li>
                    <a href="manage_application.php">
                        <i class="bi bi-circle"></i><span>Manage Applications</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Document Management Section -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="document_inquiry.php">
                <i class="bi bi-folder"></i>
                <span>Manage Documents</span>
            </a>
        </li>

        <!-- User Management Section -->
        <li class="nav-heading">User Management</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="users_profile.php">
                <i class="bi bi-person-circle"></i>
                <span>User Profiles</span>
            </a>
        </li>

    </ul><!-- End Sidebar Navigation -->

</aside><!-- End Sidebar -->
