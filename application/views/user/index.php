<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-white"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->tempdata('message'); ?>
        </div>
    </div>


    <div class="card mb-3 col-lg-8 border border-primary bg-gray-900">
        <div class="row">
            <div class="col-md-4 d-flex justify-content-center align-items-center">
                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>"
                    class="img-fluid rounded mx-auto d-block" alt="...">
            </div>
            <div class="col-md-8  ">
                <div class="card-body">
                    <h5 class="card-title text-white"><?= $user['name']; ?></h5>
                    <p class="card-text text-white"><?= $user['email']; ?></p>
                    <p class="card-text"><small class="text-white">Member since
                            <?= date('d F Y', $user['date_created']) ?></small></p>
                    <button class="btn text-white" style="background-color: #13161d;"
                        onclick="location.href = '<?= base_url('user/edit'); ?>'">Edit Profile</button>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->