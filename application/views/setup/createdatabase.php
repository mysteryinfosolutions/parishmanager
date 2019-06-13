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
                            <h2 class="align-center">DATABASE CONFIGURATION</h2>
                        </div>
                        <div class="body">
                            <div id="view">
                                <ul class="dashboard-stat-list">
                                    <?php
                                    foreach ($db_config as $key => $value) {
                                        ?>
                                        <li>
                                            <?php echo ucfirst($key . " :"); ?>
                                            <span class="pull-right"><b><?php echo isset($value) ? $value : null; ?></b></span>
                                        </li>  
                                        <?php
                                    }
                                    ?>
                                    <li>
                                        <a onclick="window.history.back()" class="btn btn-default">Back</a>
                                        <button class="btn btn-primary" onclick="edit()">EDIT</button>
                                    </li>
                                </ul>
                            </div>
                            <div id="edit" style="display: none">
                                <form id="wizard_with_validation" action="database_config" method="POST">
                                    <fieldset>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="hostname" name="hostname" value="<?php echo isset($db_config) ? $db_config['hostname'] : null; ?>" required>
                                                <label class="form-label">Host *</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="user" name="username" value="<?php echo isset($db_config) ? $db_config['username'] : null; ?>" required>
                                                <label class="form-label">Username *</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="password" name="password" value="<?php echo isset($db_config) ? $db_config['password'] : null; ?>" required>
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
                                    <div class="align-center">
                                        <button class="btn btn-primary waves-effect" style="display: none" id="submit" name="submit" value="submit" type="submit">SAVE</button>
                                    </div>
                                </form>
                                <br>
                                <div class="align-center">
                                    <button class="btn btn-success waves-effect" onclick="showAjaxLoaderMessage()" type="reset">Check Connection</button>
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
                                            title: "Check connection?",
                                            text: "",
                                            type: "warning",
                                            showCancelButton: true,
                                            closeOnConfirm: false,
                                            showLoaderOnConfirm: true,
                                        }, function () {
                                            getdata();
                                        });
                                    }

                                    async function getdata() {
                                        var base_url = window.location.origin;
                                        var host = document.getElementById("hostname").value;
                                        var user = document.getElementById("user").value;
                                        var password = document.getElementById("password").value;
                                        $.ajax({
                                            type: "POST",
                                            url: base_url + "/ParishManagerfinal/checkmysqlconnection",
                                            data: {hostname: host, username: user, password: password},
                                            cache: false,
                                            success: function (result) {
                                                var response = JSON.parse(result);
                                                if (response.status == true) {
                                                    swal({
                                                        title: "Success",
                                                        text: "Mysql server connection successfull.",
                                                        type: "success",
                                                        showCancelButton: true,
                                                        confirmButtonColor: "#DD6B55",
                                                        confirmButtonText: "Save",
                                                        closeOnConfirm: false
                                                    }, function () {
                                                        swal({
                                                            title: "Save settings?",
                                                            text: "Would you like to make these changes permanent?",
                                                            type: "warning",
                                                            showCancelButton: true,
                                                            confirmButtonText: "Yes",
                                                            closeOnConfirm: false,
                                                        }, function () {
                                                            document.getElementById("submit").click()
                                                        });
                                                    });
                                                } else {
                                                    swal("Failed, Error -" + response.error_code, "" + response.error_message, "error");
                                                }
                                            }});
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