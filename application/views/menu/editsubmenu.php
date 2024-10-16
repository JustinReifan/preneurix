<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?php if (validation_errors()): ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
            <?php endif; ?>
            <form action="" method="post">
                <div class="mb-3">

                    <input type="hidden" class="form-control" id="id" name="id" placeholder="id"
                        value="<?= $subMenuDetails[0]['id'] ?>">

                    <label for="newMenu" class="text-white">Submenu</label>
                    <select name="menu_id" id="menu_id" class="form-select">
                        <option value="">Select Menu..</option>
                        <?php foreach ($menu as $m): ?>
                        <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                        <?php endforeach ?>
                    </select>

                    <label for="newMenu" class="text-white">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                        value="<?= $subMenuDetails[0]['title'] ?>">

                    <label for="newMenu" class="text-white">Url</label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="Url"
                        value="<?= $subMenuDetails[0]['url'] ?>">

                    <label for="newMenu" class="text-white">Icon</label>
                    <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon"
                        value="<?= $subMenuDetails[0]['icon'] ?>">

                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active"
                            checked>
                        <label class="form-check-label text-white" for="is_active">
                            Active?
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

</div>
</div>