<!-- Begin Page Content -->
<div class="container-fluid py-3">

    <!-- Page Heading -->

    <div class="container py-0">
        <h1 class="h6 mb-4 text-white px-md-4"><?= $title  ?></h1>
        <div class="row py-0 px-md-4">
            <video controlsList="nodownload" oncontextmenu="return false;" controls
                src="<?= base_url('assets/vid_modules/') . $module['url_video'] ?>"></video>
        </div>
    </div>

    <?php if ($nextModule && $prevModule):  ?>
    <div class="container text-center">
        <div class="row px-md-4 g-2">
            <div class="col-4 col-md-6">
                <a href="<?= base_url('course/module/') . $prevModule['id']; ?>"
                    class="text-decoration-none btn btn-primary btn-block  rounded-0 py-2 fw-semibold text-white text-vid-control"
                    type="button"><i class="fas fa-fw fa-arrow-left mx-md-2 mx-1 fa-xs"></i>Previous </a>
            </div>
            <div class="col-4 col-md-6 d-md-none ">
                <a href="<?= base_url('course/details/') . $course['id']; ?>"
                    class="text-decoration-none btn btn-primary btn-block  rounded-0 py-2 fw-semibold text-white text-vid-control"
                    type="button">
                    <i class="fas fa-fw fa-th-list mx-md-2 me-1 fa-xs"></i>All</a>
            </div>
            <div class="col-4 col-md-6">
                <a href="<?= base_url('course/module/') . $nextModule['id']; ?>"
                    class="text-decoration-none btn btn-primary btn-block  rounded-0 py-2 fw-semibold text-white text-vid-control"
                    type="button">Next
                    <i class="fas fa-fw fa-arrow-right mx-md-2 mx-1 fa-xs"></i></a>
            </div>



        </div>
    </div>


    <?php elseif ($nextModule && $prevModule == false):  ?>
    <div class="container">
        <div class="d-grid px-md-4 ">
            <a href="<?= base_url('course/module/') . $nextModule['id']; ?>"
                class="btn btn-primary text-decoration-none rounded-0 py-2 fw-semibold text-white text-vid-control">Next
                Module <i class="fas fa-arrow-right mx-2 fa-xs"
                    onclick="location.href = '<?= base_url('course/module/') . $nextModule['id']; ?>'"></i></a>

        </div>
    </div>
    <?php elseif ($prevModule && $nextModule == false):
    ?>
    <div class="container">
        <div class="d-grid px-md-4 ">
            <a href="<?= base_url('course/module/') . $prevModule['id']; ?>"
                class="btn btn-primary text-decoration-none rounded-0 py-2 fw-semibold text-white text-vid-control"><i
                    class="fas fa-arrow-left mx-2 fa-xs"></i>Previous
                Module
            </a>
        </div>
    </div>

    <?php endif; ?>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->