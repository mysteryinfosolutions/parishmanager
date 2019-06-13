<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Parish Manager</title>
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

    <body class="login-page">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader" style="top: calc(40% - 80px);">
                <div class="logo">
                    <h2 class="col-indigo">Parish Manager</h2>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 col-sm-12 col-xs-12">
                        <a href="activeparishcheck" class="btn btn-primary btn-lg btn-block"><h4>LOGIN</h4></a>
                    </div>
                </div>
                <br>
                <div class="row clearfix">
                    <a href="setup/home" class="btn btn-danger btn-lg">SETTINGS</a>
                </div>
            </div>
        </div>
    </body>
</html>