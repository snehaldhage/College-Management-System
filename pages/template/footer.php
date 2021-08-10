  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; <?php echo date('Y'); ?><a href="https://hbminfotech.in" target="_blank"> &nbsp; Powered by HBM Infotech</a>.</strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
</div>
<script type="text/javascript">
 const site_url = "<?php echo $obj->base_url(); ?>";
</script>
<!-- jQuery -->
<script src="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $obj->base_url(); ?>assets/theme_assets/dist/js/adminlte.js"></script>
<script src="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/select2/js/select2.full.min.js"></script>
<script src="<?php echo $obj->base_url("assets/theme_assets/plugins/sweetalert2/sweetalert2.js"); ?>"></script>
<script src="<?php echo $obj->base_url("assets/theme_assets/plugins/sweetalert2/sweetalert2.min.js"); ?>"></script>
<script src="<?php echo $obj->base_url("assets/theme_assets/plugins/toastr/toastr.min.js"); ?>"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- user defined js: custom.js  -->
<script src="<?php echo __site_url; ?>assets/js/custom.js?v=<?php echo time(); ?>"></script>