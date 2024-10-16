<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-module sidebar-dark accordion d-none d-md-block"
    style="background-color: #111111;" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center" href="<?= base_url('course') ?>">
        <i class="fas fa-fw fa-chevron-circle-left text-white mr-3"></i>
        <div class="d-flex align-items-center">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-code"></i>
            </div>
            <div class="sidebar-brand-text mx-3">PRENEURIX</div>
        </div>

    </a>

    <div class=" nav-item" style="background-color: #000">
        <div class="nav-link text-white fw-bold d-flex justify-content-center">
            <span><?= $course['course_title'] ?></span>

        </div>
    </div>

    <img src="<?= base_url('assets/img/thumbnail/') . $course['url_img']; ?>" alt="" class="img-fluid px-3 pt-3">

    <div class="nav-item">
        <div class="nav-link  w-100">
            <h6 class="mb-2 text-secondary">Course Details</h6>
            <p class="text-white"><?= $course['description']; ?>
            </p>

        </div>
    </div>


</ul>
<!-- End of Sidebar -->