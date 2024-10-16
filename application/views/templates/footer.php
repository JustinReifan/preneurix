<!-- Footer -->
<footer class="sticky-footer" style="background-color: #13161d;">
    <div class="container my-auto">
        <div class="copyright text-center my-auto text-white">
            <span>Copyright &copy; Preneurix <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-theme="dark">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-white">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js2/bootstrap.bundle.min.js"></script>


<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<script>
$(document).ready(function() {


    $('.alert').alert().delay(4000).slideUp('slow');


    $("#sidebarToggle, #sidebarToggleTop").on("click", function(e) {
        // alert('tes');
        $(".sidebar").toggleClass("d-none");
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
        if ($(".sidebar").hasClass("toggled")) {
            $(".sidebar .collapse").collapse("hide");
        }
    });

    $('.checkRole').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('admin/changeaccess'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function(res) {
                document.location.href = "<?= base_url('admin/roleaccess/') ?>" + roleId;
                console.log(res);

            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

    $('.module-check').on('click', function() {
        const dataId = $(this).data('id');
        const active = $(this).data('active');
        const table = $(this).data('table');
        const url = $(this).data('url');

        $.ajax({
            url: "<?= base_url('admin/checkActive'); ?>",
            type: 'post',
            data: {
                dataId: dataId,
                active: active,
                table: table,
                url: url
            },
            success: function() {
                document.location.href = '<?= base_url() ?>' + url;
            }
        });
    });
});
</script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.js"></script>
</body>

</html>