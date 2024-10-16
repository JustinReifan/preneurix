<h1><?= $keyword ?></h1>
<h5>Results : <?= $total_rows; ?></h5>

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
            <td><?= $m['url_video']; ?></td>
            <td>
                <div class="form-check">
                    <input class="form-check-input module-check" type="checkbox"
                        <?= check_active($m['id'], 'modules'); ?> data-module="<?= $m['id']; ?>"
                        data-active="<?= $m['is_active']; ?>">

                </div>
            </td>
            <td>
                <a href="<?= base_url('admin/editmodule/') . $m['id']; ?>" class="badge badge-success">Edit</a>
                <a href="<?= base_url('admin/deletemodule/') . $m['id']; ?>" class="badge badge-danger">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->pagination->create_links(); ?>