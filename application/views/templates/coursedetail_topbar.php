<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column min-vh-100">

    <!-- Main Content -->
    <div id="content">

        <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow-lg "
            style="background-color:#14171f;">

            <a class="d-md-none d-flex align-items-center mx-3 text-decoration-none" href="<?= base_url('course') ?>">
                <i class="fas fa-fw fa-chevron-circle-left text-white mr-3"></i>
                <i class="fas fa-code text-white"></i>
            </a>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-white small"><?= ucwords($user['name']) ?></span>
                        <img class="img-profile rounded-circle"
                            src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown" data-bs-theme="dark">
                        <a class="dropdown-item" href="<?= base_url('user') ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-white"></i>
                            My Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('user/changepassword') ?>">
                            <i class="fas fa-fw fa-key mr-2 text-white"></i>
                            Change Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal"
                            data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-white"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>
        </nav>
        <!-- End of Topbar -->