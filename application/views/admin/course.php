<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?= form_error('course_title', '<div class="alert alert-danger" role="alert">
                    ', '</div>') ?>
            <?= form_error('description', '<div class="alert alert-danger" role="alert">
                    ', '</div>') ?>
            <?= form_error('url_img', '<div class="alert alert-danger" role="alert">
                    ', '</div>') ?>


            <div class="row">
                <div class="col-md-5">
                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="keyword" id="keyword"
                                placeholder="Search keyword.." autocomplete="off">
                            <input class="btn btn-outline-secondary" name="keywordBtn" type="submit" id="button-addon2">
                            <input class="btn btn-outline-danger" name="reset" type="submit" value="Reset">
                        </div>
                    </form>
                </div>
            </div>
            <?= $this->session->tempdata('message'); ?>
            <a href="" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newCourseModal">Add New
                Course</a>
            <table class="table table-hover table-dark table-borderless table-responsive-md">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Course</th>
                        <th scope="col">Thumbnail</th>
                        <th scope="col">Description</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($courses as $c): ?>
                    <tr>
                        <th scope="row"><?= ++$start; ?></< /th>
                        <td><?= $c['course_title']; ?></td>
                        <td>
                            <img src="<?= base_url('assets/img/thumbnail/') . $c['url_img']; ?>" class="img-fluid"
                                width="75px">
                        </td>
                        <td class="pe-5"><?= $c['description']; ?></td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input module-check" type="checkbox"
                                    <?= check_active($c['id'], 'courses'); ?> data-id="<?= $c['id']; ?> "
                                    data-active="<?= $c['is_active']; ?>" data-table="courses" data-url="<?= $url ?>">

                            </div>
                        </td>
                        <td>
                            <a href="<?= base_url('admin/editcourse/') . $c['id'] ?>"
                                class="badge badge-success">Edit</a>
                            <a href="<?= base_url('admin/deletecourse/') . $c['id']; ?>"
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
<!-- /.container-fluid -->

</div>



<!-- Modal -->
<div class="modal fade" id="newCourseModal" tabindex="-1" aria-labelledby="newCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="newCourseModalLabel">Add New Course</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open_multipart('admin/course'); ?>
            <div class="modal-body">
                <div class=" mb-3">
                    <label for="course_title" class="form-label">Course Title</label>
                    <input type="text" id="course_title" name="course_title" class="form-control"
                        placeholder="Input Course Name..">
                </div>
                <div class="mb-3">
                    <label for="url_img" class="form-label">Thumbnail</label>
                    <input class="form-control" type="file" id="url_img" name="url_img">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Course Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                <div class="mb-3">

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