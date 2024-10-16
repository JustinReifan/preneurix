<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= form_open_multipart(''); ?>

            <div class="mb-3">
                <label for="id" class="form-label text-white">Id</label>
                <input type="text" class="form-control" id="id" name="id" value="<?= $module['id']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="module_title" class="form-label text-white">Module Name</label>
                <input type="text" class="form-control" id="module_title" name="module_title"
                    value="<?= $module['module_title']; ?>">
                <?= form_error('module_title', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="mb-3">
                <label for="courses_id" class="form-label text-white">Course</label>
                <select name="courses_id" id="courses_id" class="form-select">
                    <option value="">Select Course..</option>
                    <?php foreach ($courses as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= $c['course_title'] ?></option>
                    <?php endforeach ?>
                </select>
                <?= form_error('courses_id', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="mb-3">
                <div class="form-label text-white">Video</div>

                <div class="row">
                    <div class="col-sm-12">
                        <video controls src="<?= base_url('assets/vid_modules/') . $module['url_video']; ?>"
                            class="object-fit-cover" width="250px"></video>
                    </div>
                    <div class="col-sm-12">
                        <input class="form-control" type="file" id="url_video" name="url_video">
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