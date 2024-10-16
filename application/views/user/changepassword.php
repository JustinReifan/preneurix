<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>


    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->tempdata('message'); ?>
            <form action="<?= base_url('user/changepassword') ?>" method="post">
                <div class="mb-3">
                    <label for="current_password" class="form-label text-white">Current Password</label>
                    <input type="password" name="current_password" class="form-control" id="current_password">
                    <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="mb-3">
                    <label for="new_password1" class="form-label text-white">New Password</label>
                    <input type="password" name="new_password1" class="form-control" id="new_password1">
                    <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="mb-3">
                    <label for="new_password2" class="form-label text-white">Repeat Password</label>
                    <input type="password" name="new_password2" class="form-control" id="new_password2">
                    <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->