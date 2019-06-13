</div>
</section>

<!-- Bootstrap Core Js -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/node-waves/waves.js"></script>

<!-- Jquery Validation Plugin Css -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/jquery.validate.js"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-countto/jquery.countTo.js"></script>

<!-- Morris Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/morrisjs/morris.js"></script>

<!-- Bootstrap Notify Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-notify/bootstrap-notify.js"></script>

<!-- ChartJs -->
<script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.bundle.js"></script>

<!-- Flot Charts Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/flot-charts/jquery.flot.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/flot-charts/jquery.flot.resize.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/flot-charts/jquery.flot.pie.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/flot-charts/jquery.flot.categories.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/flot-charts/jquery.flot.time.js"></script>


<!-- Jquery DataTable Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

<!-- Autosize Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/autosize/autosize.js"></script>

<!-- Moment Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/momentjs/moment.js"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-sparkline/jquery.sparkline.js"></script>

<!-- Multi Select Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/multi-select/js/jquery.multi-select.js"></script>

<!-- SweetAlert Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.min.js"></script>

<!-- Wait Me Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/waitme/waitMe.js"></script>

<!-- Custom Js -->
<script src="<?php echo base_url(); ?>assets/js/admin.js"></script>
<?php if ($title === "Dashboard") { ?><script src="<?php echo base_url(); ?>assets/js/pages/index.js"></script><?php } ?>
<script src="<?php echo base_url(); ?>assets/js/pages/tables/jquery-datatable.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/forms/form-validation.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/ui/notifications.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/cards/basic.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/forms/basic-form-elements.js"></script>

<!-- ajax requests -->
<script src="<?php echo base_url(); ?>assets/js/ajax/genera.js"></script>

<!-- Demo Js -->
<script src="<?php echo base_url(); ?>assets/js/demo.js"></script>
<?php
if (isset($success)) {
    ?>
    <script>
        showNotification('bg-green', '<?php echo $success; ?>', 'top', 'right', 'animated zoomIn', 'animated zoomOut');
    </script>
    <?php
    $success = null;
}
if (isset($error)) {
    ?>   
    <script>
        showNotification('alert-danger', '<?php echo $error; ?>', 'top', 'right', 'animated zoomIn', 'animated zoomOut');
    </script>
    <?php
    $error = null;
}
if (isset($warning)) {
    ?> 
    <script>
        showNotification('alert-warning', '<?php echo $warning; ?>', 'top', 'right', 'animated zoomIn', 'animated zoomOut');
    </script>
    <?php
    $warning = null;
}
?>
</body>
</html>
