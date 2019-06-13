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

        <!-- Custom Css -->
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    </head>

    <body class="fp-page" style="margin:5% 5%; max-width: -webkit-fill-available; background-color: #a2a2a245">
        <div class="fp-box">
            <div class="logo">
                <a class="col-indigo"><b>SETTINGS</b></a>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php
                    if (isset($mysql_connection)) {
                        if (empty($mysql_connection['status'])) {
                            ?>
                            <div class="alert alert-warning">
                                <strong>WARNING: </strong><span>
                                    <!--Database not configured.-->
                                    <?php
                                    echo $mysql_connection['error_message'];
                                    ?>
                                </span>
                            </div>
                            <?php
                        }
                    }
                    if (isset($database)) {
                        if (empty($database['status'])) {
                            ?>
                            <div class="alert alert-danger">
                                <strong>WARNING: </strong><span>
                                    <!--Database not configured.-->
                                    <?php
                                    echo $database['msg'];
                                    ?>
                                </span>
                            </div>
                            <?php
                        }
                    }
                    if (isset($table_error)) {
                        ?>
                        <div class="alert alert-danger">
                            <strong>WARNING: </strong><span>
                                <!--Database not configured.-->
                                <?php
                                echo $table_error;
                                ?>
                            </span>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <a href="<?php echo base_url(); ?>setup/database_config">
                                <div class="info-box-3 bg-red">
                                    <div class="icon">
                                        <i class="material-icons">storage</i>
                                    </div>
                                    <div class="content">
                                        <div class="text"><h4>DATABASE</h4></div>
                                        <div class="number"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <a href="<?php echo base_url(); ?>setup/backupandrestore" class="disabled">
                                <div class="info-box-3 bg-amber">
                                    <div class="icon">
                                        <i class="material-icons">restore</i>
                                    </div>
                                    <div class="content">
                                        <div class="text"><h4>BACKUP & RESTORE</h4></div>
                                        <div class="number">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!--                    <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <a href="register">
                                                    <div class="info-box-3 bg-cyan">
                                                        <div class="icon">
                                                            <i class="material-icons">vpn_key</i>
                                                        </div>
                                                        <div class="content">
                                                            <div class="text">REGISTER</div>
                                                            <div class="number"></div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <a href="update">
                                                    <div class="info-box-3 bg-orange">
                                                        <div class="icon">
                                                            <i class="material-icons">update</i>
                                                        </div>
                                                        <div class="content">
                                                            <div class="text">UPDATE</div>
                                                            <div class="number"></div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>-->
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <a href="<?php echo base_url(); ?>setup/about">
                                <div class="info-box-3 bg-green">
                                    <div class="icon">
                                        <i class="material-icons">spa</i>
                                    </div>
                                    <div class="content">
                                        <div class="text"><h4>ABOUT</h4></div>
                                        <div class="number"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-12">
                            <a class="btn btn-block btn-lg btn-primary" href="<?php echo base_url(); ?>home" ><h5 style="color: #ffffff"> <i class="material-icons">home</i>
                                    <span>HOME</span></h5></a>
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

    <script src="<?php echo base_url(); ?>assets/js/pages/forms/form-wizard.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/examples/forgot-password.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/ui/notifications.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/ui/tooltips-popovers.js"></script>
    <?php
    if (isset($mysql_connection)) {
        if (empty($mysql_connection['status'])) {
            ?>

            <script>
                $('.disabled').click(false);
            </script>
            <?php
        }
    }
    ?>
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