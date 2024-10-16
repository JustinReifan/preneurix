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
                data-bs-target="#newModuleModal">Add New
                Module</a>

            <div id="container-table">


                <h5 class="text-white">Results : <?= $total_rows; ?></h5>

                <table class="table table-hover table-dark table-borderless table-responsive-md">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Course</th>
                            <th scope="col">Video Url</th>
                            <th scope="col">Active</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($modules)): ?>
                        <tr>
                            <td>Data not found!</td>
                        </tr>
                        <?php endif; ?>
                        <?php foreach ($modules as $m): ?>
                        <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td><?= $m['module_title']; ?></td>
                            <td><?= $m['course_title']; ?></td>
                            <td>
                                <video controls preload="none" autoplay="false"
                                    src="<?= base_url('assets/vid_modules/') . $m['url_video']; ?>"
                                    class="object-fit-cover" width="150px"></video>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input module-check" type="checkbox"
                                        <?= check_active($m['id'], 'modules'); ?> data-id="<?= $m['id']; ?>"
                                        data-active="<?= $m['is_active']; ?>" data-table="modules"
                                        data-url="<?= $url ?>">

                                </div>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/editmodule/') . $m['id']; ?>"
                                    class="badge badge-success">Edit</a>
                                <a href="<?= base_url('admin/deletemodule/') . $m['id']; ?>"
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



<!-- Modal -->
<div class="modal fade" id="newModuleModal" tabindex="-1" aria-labelledby="newModuleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="newModuleModalLabel">Add New Module</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open_multipart('admin/module'); ?>
            <div class="modal-body">
                <div class=" mb-3">
                    <label for="module_title" class="form-label">Module Name</label>

                    <input type="text" id="module_title" name="module_title" class="form-control"
                        placeholder="Input name..">
                </div>
                <div class=" mb-3">
                    <label for="courses_id" class="form-label">Course</label>

                    <select name="courses_id" id="courses_id" class="form-select">
                        <option value="">Select Courses</option>
                        <?php foreach ($courses as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= $c['course_title'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="url_video" class="form-label">Video</label>
                    <input class="form-control" type="file" id="url_video" name="url_video">
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