<!-- Begin Page Content -->
<div class="container-fluid ">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-white px-3"><?= $title ?></h1>

    <div class="container pl-4">
        <div class="row py-2">
            <div class="list-group col" data-bs-theme="dark">
                <a href="#" class="list-group-item list-group-item-action fw-bold rounded-0">Daftar Modul</a>
                <?php foreach ($module as $m): ?>
                <a href="#"
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center rounded-0"
                    aria-current="true">
                    <div class="left-section">
                        <span class="far fa-fw fa-file-video"></span>
                        <span class="fas fa-fw fa-play-circle px-2"></span>
                        <p class="text-white fw-bold d-inline px-2">
                            <?= $m['module_title']; ?>
                        </p>
                    </div>
                    <div class="right-section">
                        <div class="btn rounded-1 fw-bold btn-sm btn-primary "
                            onclick="location.href='<?= base_url('course/module/') . $m['id'] ?>'">Start
                        </div>
                    </div>
                </a>

                <?php endforeach; ?>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->