<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Accounts | Parish Manager</title>
        <!-- Favicon-->
        <link rel="icon" href="<?php echo base_url(); ?>assets/images/general/favicon.ico" type="image/x-icon">

        <!-- Google Fonts -->
<!--        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">-->
        
        <link href="<?php echo base_url(); ?>assets/plugins/Icon/MaterialDesignIcons.css" rel="stylesheet" type="text/css"/>

        <!-- Bootstrap Core Css -->
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="<?php echo base_url(); ?>assets/plugins/node-waves/waves.css" rel="stylesheet" />

        <!--WaitMe Css-->
        <link href="<?php echo base_url(); ?>assets/plugins/waitme/waitMe.css" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="<?php echo base_url(); ?>assets/plugins/animate-css/animate.css" rel="stylesheet" />

        <!-- JQuery DataTable Css -->
        <link href="<?php echo base_url(); ?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

        <!-- Multi Select Css -->
        <link href="<?php echo base_url(); ?>assets/plugins/multi-select/css/multi-select.css" rel="stylesheet">

        <!-- Custom Css -->
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">

        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="<?php echo base_url(); ?>assets/css/themes/all-themes.css" rel="stylesheet" />

        <!-- Bootstrap Material Datetime Picker Css -->
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

        <!-- Sweetalert Css -->
        <link href="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

        <!-- Bootstrap Select Css -->
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

        <!-- Jquery Core Js -->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    </head>

    <body class="theme-<?php echo isset($usertheme) ? $usertheme : "indigo"; ?>">
        <?php if (!empty($show_loader)) { ?>
            <!-- Page Loader -->
            <div class="page-loader-wrapper">
                <div class="loader">
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
                    <p>Please wait...</p>
                </div>
            </div>
            <!-- #END# Page Loader -->
        <?php } ?>
        <!-- Overlay For Sidebars -->
        <div class="overlay"></div>
        <!-- #END# Overlay For Sidebars -->
        <!-- Top Bar -->
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                    <a href="javascript:void(0);" class="bars"></a>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>accounts/dashboard"><?php echo isset($parishdetails) ? strtoupper($parishdetails['name'] . " " . $parishdetails['city']) : "PARISH MANAGER"; ?> - ACCOUNTS</a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Notifications -->
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                <i class="material-icons">notifications</i>
                                <span class="label-count">1</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">NOTIFICATIONS</li>
                                <li class="body">
                                    <ul class="menu">
                                        <li>
                                            <a href="javascript:void(0);">
                                                <div class="icon-circle bg-light-green">
                                                    <i class="material-icons">sync</i>
                                                </div>
                                                <div class="menu-info">
                                                    <h4>Sync to keep data safe.</h4>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- #END# Notifications -->
                        <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- #Top Bar -->
        <section>
            <!-- Left Sidebar -->
            <aside id="leftsidebar" class="sidebar">
                <!-- User Info -->
                <div class="user-info" style="background-color:#3F51B5">
                    <div class="image">
                        <img src="<?php echo base_url() . $user['profile_image']; ?>" width="48" height="48" alt="Admin" />
                    </div>
                    <div class="info-container">
                        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $user['name']; ?></div>
                        <div class="email">Last login: <?php echo isset($user['lastlogin']) ? $user['lastlogin']['login_at'] : "Never"; ?></div>
                        <div class="btn-group user-helper-dropdown">
                            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="<?php echo base_url(); ?>logout"><i class="material-icons">input</i>Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #User Info -->
                <!-- Menu -->
                <div class="menu">
                    <ul class="list">
                        <li class="header">MAIN NAVIGATION</li>
                        <li <?php
                        if ($title === 'Dashboard') {
                            echo 'class="active"';
                        }
                        ?>>
                            <a href="<?php echo $base_url; ?>dashboard">
                                <i class="material-icons">dashboard</i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li <?php
                        if ($title === 'Transactions' || $title === 'Managetransaction') {
                            echo 'class="active"';
                        }
                        ?>>
                            <a href="<?php echo $base_url; ?>transactions">
                                <i class="material-icons">account_balance_wallet</i>
                                <span>Transactions</span>
                            </a>
                        </li>
                        <li <?php
                        if (isset($bank_data)) {
                            if ($bank_data['name'] === 'accounts') {
                                echo 'class="active"';
                            }
                        }
                        ?>>
                            <a href="<?php echo $base_url; ?>bankaccounts">
                                <i class="material-icons">account_balance</i>
                                <span>Bank Accounts</span>
                            </a>
                        </li>
                        <li <?php
                        if ($title === 'Report') {
                            echo 'class="active"';
                        }
                        ?>>
                            <a href="<?php echo $base_url; ?>report">
                                <i class="material-icons">assignment</i>
                                <span>Reports</span>
                            </a>
                        </li>
                        <li <?php
                        if (isset($settings_data)) {
                            echo 'class="active"';
                        }
                        ?>>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">settings</i>
                                <span>Settings</span>
                            </a>
                            <ul class="ml-menu">
                                <li <?php
                                if (isset($settings_data)) {
                                    if ($settings_data['name'] === 'Financialyears' || $settings_data['name'] === 'Managefinancialyear') {
                                        echo 'class="active"';
                                    }
                                }
                                ?>>
                                    <a href="<?php echo $base_url; ?>financialyears">
                                        <span>Financial Year</span>
                                    </a>
                                </li>
                                <li <?php
                                if (isset($settings_data)) {
                                    if ($settings_data['name'] === 'Tledgers' || $settings_data['name'] === 'Managetledger') {
                                        echo 'class="active"';
                                    }
                                }
                                ?>>
                                    <a href="<?php echo $base_url; ?>tledgers">
                                        <span>Collections</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>parish/dashboard"">
                                <i class="material-icons">chevron_left</i>
                                <span>Back to Parish Manager</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- #Menu -->
                <!-- Footer -->
                <div class="legal">
                    <div class="copyright">
                        &copy; 2019 <a href="http://www.mysteryinfosolutions.com" target="_blank">Mystery Info Solutions</a>
                    </div>
                    <div class="version">
                        <b>Version: </b> 1.0.0
                    </div>
                </div>
                <!-- #Footer -->
            </aside>
            <!-- #END# Left Sidebar -->
            <!-- Right Sidebar -->
            <aside id="rightsidebar" class="right-sidebar">
                <ul class="nav nav-tabs tab-nav-right" role="tablist">
                    <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                        <ul class="demo-choose-skin">
                            <?php
                            if (isset($themes)) {
                                foreach ($themes as $theme) {
                                    ?>
                                    <li data-theme="<?php echo $theme->name; ?>" <?php
                                    if (isset($user['theme_name'])) {
                                        if ($user['theme_name'] === $theme->name) {
                                            ?>class="active"<?php
                                            }
                                        }
                                        ?>>
                                        <div class="<?php echo $theme->name; ?>"></div>
                                        <span><?php echo ucfirst($theme->name); ?></span>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </aside>
            <!-- #END# Right Sidebar -->
        </section>

        <section class="content">
            <div class="container-fluid">