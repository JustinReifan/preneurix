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
                    <label for="newMenu" class="text-white">ID</label>
                    <input type="text" value="<?= $menu['id'] ?>" name="id" class="form-control" id="id">
                    <label for="newMenu" class="text-white">Menu Name</label>
                    <input type="text" class="form-control" id="newMenu" name="newMenu" placeholder="New Menu Name"
                        value="<?= $menu['menu'] ?>">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

</div>
</div>