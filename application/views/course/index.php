<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-white px-3 d-none d-md-block"><?= $title ?></h1>

    <div class="container">
        <div class="row py-2">
            <?php foreach ($courses as $c): ?>
            <div class="col-md-4 px-3">
                <a href="<?= base_url('course/details/') . $c['id'] ?>" class="d-inline text-decoration-none">
                    <div class="card bg-transparent border-0 ">
                        <img src="<?= base_url('assets/img/thumbnail/') . $c['url_img']; ?>"
                            class="card-img-top overflow-hidden rounded-3" alt="...">
                        <div class="card-img-overlay">
                            <h5 class="card-title badge rounded-pill text-bg-dark py-2 px-3">
                                <?= $this->courses->countModuleByCourseId($c['id']) ?> Module
                            </h5>
                        </div>
                        <div class="card-body text-white px-1 py-2">
                            <p class="card-text text-capitalize fs-5 fw-bold"><?= $c['course_title'] ?></p>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->