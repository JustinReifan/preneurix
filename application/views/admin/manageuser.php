<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()): ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
            <?php endif; ?>

            <?= $this->session->tempdata('message'); ?>
            <form action="" method="post" name="keywordForm">
                <div class="row">
                    <div class="col-md-5">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="keyword" id="keyword"
                                placeholder=" Search keyword.." autocomplete="off">
                            <input class="btn btn-outline-secondary" name="keywordBtn" type="submit" id="button-addon2">
                            <input class="btn btn-outline-danger " name="reset" type="submit" value="Reset">
                        </div>
                    </div>
                </div>
            </form>


            <a href="" id="modalBtn" class="btn btn-primary mb-3" data-bs-toggle="modal"
                data-bs-target="#newUserModal">Add New
                User</a>

            <div id="container-table">

                <table class="table table-hover table-dark table-borderless table-responsive-md col-9">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Profile Image</th>
                            <th scope="col">Role</th>
                            <th scope="col">Active</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($allUser)): ?>
                        <tr>
                            <td>Data not found!</td>
                        </tr>
                        <?php endif; ?>
                        <?php foreach ($allUser as $u): ?>
                        <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td><?= $u['name']; ?></td>
                            <td><?= $u['email']; ?></td>
                            <td>
                                <img src="<?= base_url('assets/img/profile/') .  $u['image']; ?>" alt=""
                                    class="img-fluid" width="50px">
                            </td>
                            <td><?= $u['role']; ?></td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input module-check" type="checkbox"
                                        <?= check_active($u['id'], 'user'); ?> data-id="<?= $u['id']; ?>"
                                        data-active="<?= $u['is_active']; ?>" data-table="user" data-url="<?= $url ?>">

                                </div>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/edituser/') . $u['id']; ?>"
                                    class="badge badge-success">Edit</a>
                                <a href="<?= base_url('admin/deleteuser/') . $u['id']; ?>"
                                    class="badge badge-danger">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->




<!-- Modal -->
<div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="newUserModalLabel">Add New User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open_multipart('admin/manageuser'); ?>
            <div class="modal-body">
                <div class=" mb-3">
                    <label for="name" class="form-label">User Name</label>

                    <input type="text" id="name" name="name" class="form-control" placeholder="Input name..">
                </div>
                <div class=" mb-3">
                    <label for="email" class="form-label">Email</label>

                    <input type="text" id="email" name="email" class="form-control" placeholder="Input email..">
                </div>
                <div class="mb-3">
                    <label for="password1" class="form-label">Password</label>
                    <input type="password" class="form-control form-control-user" id="password1" name="password1"
                        placeholder="Input Password..">
                </div>
                <div class="mb-3">
                    <label for="password2" class="form-label">Repeat Password</label>
                    <input type="password" class="form-control form-control-user" id="password2" name="password2"
                        placeholder="Repeat Password..">
                </div>

                <div class="mb-3">
                    <label for="role_id" class="form-label">Role</label>

                    <select name="role_id" id="role_id" class="form-select">
                        <option value="">Select Role</option>
                        <?php foreach ($allRole as $r) : ?>
                        <option value="<?= $r['id'] ?>"><?= $r['role'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="user_img" class="form-label">Profile Image <span class="text-info">(Optional)</span>
                    </label>
                    <input class="form-control" type="file" id="user_img" name="user_img">
                </div>

                <div class=" mb-3">

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active"
                            checked>
                        <label class="form-check-label" for="is_active">
                            Active?
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>