<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>



    <div class="row">
        <div class="col-lg-6">
            <?= form_error('course_title', '<div class="alert alert-danger" role="alert">
                    ', '</div>') ?>
            <?= form_error('url_img', '<div class="alert alert-danger" role="alert">
                    ', '</div>') ?>

            <?= $this->session->tempdata('message'); ?>
            <a href="" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newCourseModal">Add New
                Course</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Course</th>
                        <th scope="col">Thumbnail</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($courses as $c): ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $c['course_title']; ?></td>
                            <td>
                                <img src="<?= base_url('assets/img/thumbnail/') . $c['url_img']; ?>" class="img-fluid"
                                    width="75px">
                            </td>
                            <td>
                                <a href="" class="badge badge-success">Edit</a>
                                <a href="" class="badge badge-danger" onclick="">Delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>