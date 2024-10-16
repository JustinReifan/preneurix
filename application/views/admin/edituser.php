<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= form_open_multipart(''); ?>

            <div class="mb-3">
                <label for="id" class="form-label text-white">Id</label>
                <input type="text" class="form-control" id="id" name="id" value="<?= $userData['id']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label text-white">User Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $userData['name']; ?>">
                <?= form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label text-white">Email</label>
                <input type="text" class="form-control" id="email" name="email" rows="3"
                    value="<?= $userData['email']; ?>"></input>
                <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="mb-3">
                <label for="role_id" class="form-label text-white">Role</label>

                <select name="role_id" id="role_id" class="form-select">
                    <option value="<?= $currentRole['id']; ?>"><?= $currentRole['role']; ?></option>
                    <?php foreach ($allRole as $r) : ?>
                    <?php if ($r['id'] !== $currentRole['id']) : ?>
                    <option value="<?= $r['id'] ?>"><?= $r['role'] ?></option>
                    <?php endif; ?>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="mb-3">

                <label for="password1" class="form-label text-white">New Password <span class="text-danger">
                        ..For Reset Only (Optional)</span></label>
                <input type="password" class="form-control form-control-user" id="password1" name="password1"
                    placeholder="Input Password..">
            </div>
            <div class="mb-3">
                <label for="password2" class="form-label text-white">Repeat Password <span class="text-danger">
                        ..For Reset Only (Optional)</span></label>
                <input type="password" class="form-control form-control-user" id="password2" name="password2"
                    placeholder="Repeat Password..">
            </div>
            <div class="mb-3">
                <div class="form-label text-white">Profile Image <span class="text-info">(Optional)</span></div>

                <div class="row">
                    <div class="col-sm-3">
                        <img src="<?= base_url('assets/img/profile/') . $userData['image']; ?>" class="img-thumbnail">
                    </div>
                    <div class="col-sm-9">
                        <input class="form-control" type="file" id="user_img" name="user_img">
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