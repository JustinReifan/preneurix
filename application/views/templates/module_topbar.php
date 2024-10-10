<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php if ($nextModule && $prevModule):  ?>
        <div class="container text-center">
            <div class="row">
                <div class="col-2 d-md-none">
                    <!-- Sidebar Toggle (Topbar) -->

                    <a class="d-flex align-items-center mx-3 text-decoration-none" href="<?= base_url('course') ?>">
                        <i class="fas fa-fw fa-chevron-circle-left text-white mr-3"></i>
                        <i class="fas fa-code text-white"></i>
                    </a>
                </div>
                <div class="col-5 col-md-6">
                    <a href="<?= base_url('course/module/') . $prevModule['id']; ?>"
                        class="text-decoration-none btn btn-block btn-primary rounded-0 py-2 fw-semibold text-white"
                        type="button"><i class="fas fa-arrow-left mx-md-2 fa-xs"></i>Previous </a>
                </div>
                <div class="col-5 col-md-6">
                    <a href="<?= base_url('course/module/') . $nextModule['id']; ?>"
                        class="text-decoration-none btn btn-block btn-primary rounded-0 py-2 fw-semibold text-white"
                        type="button">Next
                        <i class="fas fa-arrow-right mx-md-2 fa-xs"></i></a>
                </div>



            </div>
        </div>


        <?php elseif ($nextModule && $prevModule == false):  ?>
        <div class="d-grid mx-1">
            <a href="<?= base_url('course/module/') . $nextModule['id']; ?>"
                class="btn btn-primary text-decoration-none rounded-0 py-2 fw-semibold text-white">Next
                Module <i class="fas fa-arrow-right mx-2 fa-xs"
                    onclick="location.href = '<?= base_url('course/module/') . $nextModule['id']; ?>'"></i></a>
        </div>
        <?php elseif ($prevModule && $nextModule == false):
        ?>
        <div class="d-grid mx-1">
            <a href="<?= base_url('course/module/') . $prevModule['id']; ?>"
                class="btn btn-primary text-decoration-none rounded-0 py-2 fw-semibold text-white"><i
                    class="fas fa-arrow-left mx-2 fa-xs"></i>Previous
                Module
            </a>
        </div>

        <?php endif; ?>
        <!-- End of Topbar -->