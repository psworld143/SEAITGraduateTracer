<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <!-- Avatar Section -->
    <div class="sidebar-avatar">
        <img src="assets/img/image.png" alt="User Avatar" class="avatar-img">
    </div>
    <br>

    <!-- Sidebar Navigation -->
    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Back -->
        <li class="nav-item">
            <a class="nav-link active" href="manage_survey.php">
                <i class="bi bi-chevron-left"></i>
                <span>Back</span>
            </a>
        </li><!-- Back -->

        <!-- Dynamic Dashboard Link -->
        <li class="nav-item">
            <a class="nav-link active" href="index_graduates.php?id=<?php echo htmlspecialchars($_GET['id']); ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <!-- Dynamic Students Link -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="batch_page.php?id=<?php echo htmlspecialchars($_GET['id']); ?>">
                <i class="bi bi-person-badge"></i>
                <span>Students</span>
            </a>
        </li>
    </ul><!-- End Sidebar Navigation -->

</aside><!-- End Sidebar -->
