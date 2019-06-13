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

    <body class="fp-page" style="background-color: #a2a2a245">
        <div class="fp-box">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="align-center">ABOUT</h2>
                        </div>
                        <div class="body">
                            <ul class="dashboard-stat-list">
                                <?php
                                foreach ($application as $key => $value) {
                                    ?>
                                    <li>
                                        <?php echo ucfirst($key . " :"); ?>
                                        <span class="pull-right"><b><?php echo isset($value) ? $value : null; ?></b></span>
                                    </li>  
                                    <?php
                                }
                                ?>
                                <li>
                                    <a onclick="window.history.back()" class="btn btn-default btn-block btn-lg">BACK</a>
                                </li>
                            </ul>
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