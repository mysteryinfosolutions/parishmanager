<!DOCTYPE html>
<?php
//if($_POST('submit')){
//    
//}
$db_config_file = "system/config/database.json";
if (file_exists($db_config_file)) {
    $strJsonFileContents = file_get_contents($db_config_file);
    $db_config = json_decode($strJsonFileContents, true);
}
?>
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
                            <h2 class="align-center">DATABASE CONFIGURATION</h2>
                        </div>
                        <div class="body">
                            <form id="wizard_with_validation" method="POST">
                                <fieldset>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="hostname" value="<?php echo isset($db_config) ? $db_config['hostname'] : null; ?>" required>
                                            <label class="form-label">Host *</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="username" value="<?php echo isset($db_config) ? $db_config['username'] : null; ?>" required>
                                            <label class="form-label">Username *</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="password" class="form-control" name="password" id="password" value="<?php echo isset($db_config) ? $db_config['password'] : null; ?>" required>
                                            <label class="form-label">Password *</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="databasename" value="<?php echo isset($db_config) ? $db_config['database'] : null; ?>" required>
                                            <label class="form-label">Database Name *</label>
                                        </div>
                                    </div>
                                </fieldset>
                                <a onclick="window.history.back()" class="btn btn-default">Back</a>
                                <button class="btn btn-primary waves-effect" name="submit" value="submit" type="submit">SUBMIT</button>
                            </form>
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

        <!-- Custom Js -->
        <script src="<?php echo base_url(); ?>assets/js/admin.js"></script>

        <script src="<?php echo base_url(); ?>assets/js/pages/forms/form-wizard.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/pages/examples/forgot-password.js"></script>
    </body>

</html>