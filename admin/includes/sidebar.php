    <!-- Sidebar -->
    <div class="sidebar d-none d-md-block" style="width: 250px;">
        <div class="p-4 text-center border-bottom border-secondary">
            <h4 class="text-white fw-bold m-0"><i class="fas fa-graduation-cap text-primary me-2"></i>EduAdmin</h4>
        </div>
        <div class="py-3">
            <a href="dashboard.php" class="sidebar-link <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>"><i class="fas fa-home"></i> Dashboard</a>
            <a href="admissions.php" class="sidebar-link <?php echo basename($_SERVER['PHP_SELF']) == 'admissions.php' ? 'active' : ''; ?>"><i class="fas fa-user-plus"></i> Admissions</a>
            <a href="courses.php" class="sidebar-link <?php echo basename($_SERVER['PHP_SELF']) == 'courses.php' ? 'active' : ''; ?>"><i class="fas fa-book"></i> Courses</a>
            <a href="faculty.php" class="sidebar-link <?php echo basename($_SERVER['PHP_SELF']) == 'faculty.php' ? 'active' : ''; ?>"><i class="fas fa-chalkboard-teacher"></i> Faculty</a>
            <a href="results.php" class="sidebar-link <?php echo basename($_SERVER['PHP_SELF']) == 'results.php' ? 'active' : ''; ?>"><i class="fas fa-poll"></i> Results</a>
            <a href="notices.php" class="sidebar-link <?php echo basename($_SERVER['PHP_SELF']) == 'notices.php' ? 'active' : ''; ?>"><i class="fas fa-bell"></i> Notices</a>
            <a href="gallery.php" class="sidebar-link <?php echo basename($_SERVER['PHP_SELF']) == 'gallery.php' ? 'active' : ''; ?>"><i class="fas fa-images"></i> Gallery</a>
            
            <div class="mt-5 px-3">
                <a href="../index.php" class="btn btn-outline-light btn-sm w-100 mb-2" target="_blank"><i class="fas fa-external-link-alt me-1"></i> View Site</a>
                <a href="logout.php" class="btn btn-danger btn-sm w-100"><i class="fas fa-sign-out-alt me-1"></i> Logout</a>
            </div>
        </div>
    </div>

    <!-- Main Content Wrapper -->
    <div class="main-content d-flex flex-column" style="min-height: 100vh;">
        <!-- Topbar -->
        <div class="topbar d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <button class="btn btn-light d-md-none me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="m-0 fw-bold text-dark">
                    <?php 
                        $page = basename($_SERVER['PHP_SELF'], '.php');
                        echo ucwords(str_replace('-', ' ', $page)); 
                    ?>
                </h5>
            </div>
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle bg-white border-0" type="button" data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=3b82f6&color=fff" class="rounded-circle me-2" width="30" height="30" alt="Admin">
                        <span class="fw-semibold">Admin</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                        <li><a class="dropdown-item text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Mobile Sidebar Offcanvas -->
        <div class="offcanvas offcanvas-start bg-dark" tabindex="-1" id="sidebarOffcanvas">
            <div class="offcanvas-header border-bottom border-secondary">
                <h5 class="offcanvas-title text-white fw-bold"><i class="fas fa-graduation-cap text-primary me-2"></i>EduAdmin</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body p-0 py-3">
                <a href="dashboard.php" class="sidebar-link"><i class="fas fa-home"></i> Dashboard</a>
                <a href="admissions.php" class="sidebar-link"><i class="fas fa-user-plus"></i> Admissions</a>
                <a href="courses.php" class="sidebar-link"><i class="fas fa-book"></i> Courses</a>
                <a href="faculty.php" class="sidebar-link"><i class="fas fa-chalkboard-teacher"></i> Faculty</a>
                <a href="results.php" class="sidebar-link"><i class="fas fa-poll"></i> Results</a>
                <a href="notices.php" class="sidebar-link"><i class="fas fa-bell"></i> Notices</a>
                <a href="gallery.php" class="sidebar-link"><i class="fas fa-images"></i> Gallery</a>
            </div>
        </div>

        <!-- Page Content -->
        <div class="p-4 flex-grow-1">
