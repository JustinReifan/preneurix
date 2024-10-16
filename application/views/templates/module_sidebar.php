<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-module sidebar-dark accordion d-none d-md-block"
    style="background-color: #111111;" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center" href="<?= base_url('course/details/') . $course['id'] ?>">
        <i class="fas fa-fw fa-chevron-circle-left text-white mr-3"></i>
        <div class="d-flex align-items-center">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-code"></i>
            </div>
            <div class="sidebar-brand-text mx-3">PRENEURIX</div>
        </div>

    </a>

    <div class="nav-item">
        <div class="nav-link mx-auto">
            <img src="<?= base_url('assets/img/thumbnail/') . $course['url_img']; ?>" alt="" class="img-fluid  pt-3">
        </div>

    </div>
    <div class="nav-item">
        <div class="accordion" data-bs-theme="dark" id="modul">
            <div class="accordion-item border-0 rounded-0" style="background-color: #111111; ">
                <h2 class="accordion-header">
                    <button class="accordion-button fw-bold text-white" style="background-color: #000;" type="button"
                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseOne">
                        Daftar Modul
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show ">
                    <div class="accordion-body py-0 px-0">
                        <div class="list-group rounded-0 row">

                            <?php foreach ($moduleList as $ml): ?>
                                <?php if ($this->uri->segment(3) == $ml['id']): ?>
                                    <a href="<?= base_url('course/module/') . $ml['id']; ?>"
                                        class="list-group-item active list-group-item-action border-start-0 border-end-0"
                                        aria-current="true">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <i class="far fa-fw fa-circle me-2"></i>
                                            <div class="text-white fw-bold">
                                                <i class="far fa-fw fa-file-alt px-1"></i>
                                                <?= $ml['module_title'] ?>
                                            </div>
                                        </div>
                                    </a>
                                <?php else: ?>
                                    <a href="<?= base_url('course/module/') . $ml['id']; ?>"
                                        class="list-group-item list-group-item-action border-start-0 border-end-0"
                                        aria-current="true">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <i class="far fa-fw fa-circle me-2"></i>
                                            <div class="text-white fw-bold">
                                                <i class="far fa-fw fa-file-alt px-1"></i>
                                                <?= $ml['module_title'] ?>
                                            </div>
                                        </div>
                                    </a>
                                <?php endif; ?>

                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




</ul>
<!-- End of Sidebar -->