<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Parish Manager</title>
        <!-- Favicon-->
        <link rel="icon" href="<?php echo base_url();?>assets/favicon.ico" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

        <!-- Bootstrap Core Css -->
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="<?php echo base_url(); ?>assets/plugins/node-waves/waves.css" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="<?php echo base_url();?>assets/plugins/animate-css/animate.css" rel="stylesheet" />

        <!-- Custom Css -->
        <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
        <style>
            .loading:after {
                content: ' .';
                animation: dots 1s steps(5, end) infinite;}

            @keyframes dots {
                0%, 20% {
                    color: rgba(0,0,0,0);
                    text-shadow:
                        .25em 0 0 rgba(0,0,0,0),
                        .5em 0 0 rgba(0,0,0,0);}
                40% {
                    color: black;
                    text-shadow:
                        .25em 0 0 rgba(0,0,0,0),
                        .5em 0 0 rgba(0,0,0,0);}
                60% {
                    text-shadow:
                        .25em 0 0 black,
                        .5em 0 0 rgba(0,0,0,0);}
                80%, 100% {
                    text-shadow:
                        .25em 0 0 black,
                        .5em 0 0 black;}}
                </style>
            </head>

            <body class="login-page">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader" style="top: calc(40% - 80px);">
                <div class="logo">
                    <h2 class="col-indigo">Parish Manager<h2>
                            </div>
                            <div class="preloader">
                                <div class="spinner-layer pl-indigo">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                            <p>Logging out<span class="loading">, please wait</span></p>
                            </div>
                            </div>
                            <script type="text/javascript">
                                setTimeout(function () {
                                    window.location = "login";
                                }, 3000);
                                <?php
                                if(!$this->session->has_userdata('user')){
                                ?>
                                window.history.forward();
                                <?php } ?>
                            </script>
                            </body>

                            </html>