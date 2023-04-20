<footer class="main-footer">
  <strong>Copyright &copy; 2020-2021 <a href="<?php echo base_url('admin/dashboard') ?>" class="footer-link"><span class="brand-text font-weight-bold"><?php echo APP_NAME ?></span></a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <!-- <b>Version</b> 3.0.4 -->
  </div>
</footer>

<!-- Control Sidebar -->
<!-- <aside class="control-sidebar control-sidebar-dark">
  </aside> -->
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

</body>

</html>

<script>
  var base_url = "<?php echo base_url(); ?>"
</script>

<script src="<?php url('assets/admin/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?php url('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?php url('assets/admin/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
<script src="<?php url('assets/admin/dist/js/adminlte.min.js') ?>"></script>

<script src="<?php url('assets/admin/dist/js/demo.js') ?>"></script>

<script src="<?php url('assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') ?>"></script>



<script src="<?php url('assets/admin/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php url('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php url('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?php url('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>

<script src="<?php url('assets/admin/plugins/summernote/summernote-bs4.min.js') ?>"></script>


<script src="<?php url('assets/admin/plugins/toastr/toastr.min.js') ?>"></script>

<script src="<?php url('assets/admin/plugins/select2/js/select2.full.min.js') ?>"></script>

<script src="<?php url('assets/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') ?>"></script>
<script src="<?php url('assets/js/adminjs.js') ?>"></script>
<script>
  $(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>