<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <!-- Avatar Section -->
    <div class="sidebar-avatar text-center py-3">
        <img src="assets/img/image.png" alt="User Avatar" class="avatar-img rounded-circle" style="width: 80px; height: 80px;">
        <p class="mt-2 fw-bold">Welcome, Admin!</p>
    </div>

    <!-- Sidebar Navigation -->
    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Back Link -->
        <li class="nav-item">
            <a class="nav-link" href="manage_alumni.php">
                <i class="bi bi-chevron-left"></i>
                <span>Back</span>
            </a>
        </li><!-- End Back -->

        <!-- Dynamic Dashboard Link -->
        <li class="nav-item">
            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index_graduates.php') ? 'active' : ''; ?>" 
               href="index_graduates.php?id=<?php echo htmlspecialchars($_GET['id']); ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <!-- Dynamic Students Link -->
        <li class="nav-item">
            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'batch_page.php') ? 'active' : ''; ?>" 
               href="batch_page.php?id=<?php echo htmlspecialchars($_GET['id']); ?>">
                <i class="bi bi-person-badge"></i>
                <span>Students</span>
            </a>
        </li><!-- End Students Nav -->
        
    </ul><!-- End Sidebar Navigation -->

</aside><!-- End Sidebar -->
