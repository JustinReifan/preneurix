<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= form_open_multipart(''); ?>

            <div class="mb-3">
                <label for="id" class="form-label text-white">Id</label>
                <input type="text" class="form-control" id="id" name="id" value="<?= $course['id']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="course_title" class="form-label text-white">Course Name</label>
                <input type="text" class="form-control" id="course_title" name="course_title"
                    value="<?= $course['course_title']; ?>">
                <?= form_error('course_title', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label text-white">Course Description</label>
                <input type="text" class="form-control" id="description" name="description" rows="3"
                    value="<?= $course['description']; ?>"></input>
                <?= form_error('description', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="mb-3">
                <div class="form-label text-white">Thumbnail</div>

                <div class="row">
                    <div class="col-sm-3">
                        <img src="<?= base_url('assets/img/thumbnail/') . $course['url_img']; ?>" class="img-thumbnail">
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