<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Parish Manager | Setup</title>
        <!-- Favicon-->
        <link rel="icon" href="<?php echo base_url(); ?>assets/favicon.ico" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

        <!-- Bootstrap Core Css -->
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="<?php echo base_url(); ?>assets/plugins/node-waves/waves.css" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="<?php echo base_url(); ?>assets/plugins/animate-css/animate.css" rel="stylesheet" />

        <!-- Sweetalert Css -->
        <link href="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

        <!-- Custom Css -->
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">

    </head>

    <body class="fp-page" style="background-color: #a2a2a245">
        <div class="fp-box">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="align-center">BACKUP & RESTORE</h2>
                        </div>
                        <div class="body">
                            <div id="view">
                                <button type="button" class="btn btn-primary waves-effect btn-block btn-lg" onclick="backup()">
                                    <i class="material-icons">backup</i>
                                    <span>BACKUP</span>
                                </button>
                                <button type="button" class="btn btn-success waves-effect btn-block btn-lg" onclick="edit()">
                                    <i class="material-icons">restore</i>
                                    <span>RESTORE</span>
                                </button>
                                <a onclick="window.history.back()" class="btn btn-default btn-block">BACK</a>
                            </div>
                            <div id="edit" style="display: none">
                                <?php
                                $attributes = array('id' => 'wizard_with_validation');
                                echo form_open_multipart('setup/importdb', $attributes);
                                ?>
                                <fieldset>
                                    <input type="file" name="userfile" size="20"  required=""/>
                                </fieldset>
                                <div class="align-center">
                                    <button class="btn btn-primary waves-effect" style="display: none" id="submit" name="submit" value="submit" type="submit">SAVE</button>
                                </div>
                                </form>
                                <br>
                                <div class="align-center">
                                    <button class="btn btn-success waves-effect" onclick="showAjaxLoaderMessage()" type="reset">IMPORT</button>
                                </div>
                                <button class="btn btn-danger" onclick="edit()">CANCEL</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jquery Core Js -->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core Js -->
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.js"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="<?php echo base_url(); ?>assets/plugins/node-waves/waves.js"></script>
        <!-- JQuery Steps Plugin Js -->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-steps/jquery.steps.js"></script>
        <!-- Validation Plugin Js -->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/jquery.validate.js"></script>
        <!-- Bootstrap Notify Plugin Js -->
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-notify/bootstrap-notify.js"></script>
        <!-- Custom Js -->
        <script src="<?php echo base_url(); ?>assets/js/admin.js"></script>

        <!-- SweetAlert Plugin Js -->
        <script src="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.min.js"></script>

        <!-- ajax requests -->
        <script src="<?php echo base_url(); ?>assets/js/ajax/general.js"></script>

        <script src="<?php echo base_url(); ?>assets/js/pages/forms/form-wizard.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/pages/examples/forgot-password.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/pages/ui/notifications.js"></script>
        <script>
                                    function backup() {
                                        var base_url = window.location.origin;
                                        swal({
                                            title: "Backup to PC?",
                                            type: "info",
                                            showCancelButton: true,
                                            closeOnConfirm: true,
                                        }, function () {
                                            window.location.replace("<?php echo base_url() . 'setup/backup'; ?>");
                                        });
                                    }
                                    function edit() {
                                        var view = document.getElementById("view");
                                        var edit = document.getElementById("edit");
                                        if (view.style.display === "none" && edit.style.display === "block") {
                                            view.style.display = "block";
                                            edit.style.display = "none";
                                        } else {
                                            view.style.display = "none";
                                            edit.style.display = "block";
                                        }
                                    }

                                    function showAjaxLoaderMessage() {
                                        swal({
                                            title: "Import Database!",
                                            text: "This will replace the existing database. Make sure to backup database if exist before proceeding. Want to continue ?",
                                            type: "warning",
                                            showCancelButton: true,
                                            closeOnConfirm: false,
                                            showLoaderOnConfirm: true,
                                        }, function () {
                                            document.getElementById("submit").click()
                                        });
                                    }
        </script>
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