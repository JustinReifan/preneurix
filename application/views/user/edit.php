<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= form_open_multipart('user/edit'); ?>

            <div class="mb-3">
                <label for="name" class="form-label">Username</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>">
                <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="mb-3">
                <div class="form-label">Profile Image</div>

                <div class="row">
                    <div class="col-sm-3">
                        <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                    </div>
                    <div class="col-sm-9">
                        <input class="form-control" type="file" id="image" name="image">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>

            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->