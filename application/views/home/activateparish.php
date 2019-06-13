<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Activate Parish | Parish Manager</title>
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

        <!-- Animation Css -->
        <link href="<?php echo base_url(); ?>assets/plugins/animate-css/animate.css" rel="stylesheet" />

        <!-- Bootstrap Select Css -->
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

        <!-- Custom Css -->
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    </head>

    <body class="login-page" style="background-color: #3F51B5">
        <div class="login-box">
            <div class="logo">
                <a href="javascript:void(0);"><b>Parish Manager</b></a>
                <small>A complete solution for parish management</small>
            </div>
            <div class="card">
                <div class="body">
                    <div class="msg">Create your login session</div>
                    <div id="msg">
                        <?php
                        if (isset($error_message)) {
                            ?>
                            <div class="alert alert-danger alert-dismissable fade in">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><?php echo $error_message; ?></strong>
                            </div>
                            <?php
                        }
                        if (isset($warning_message)) {
                            ?>
                            <div class="alert alert-warning alert-dismissable fade in">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><?php echo $warning_message; ?></strong>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                    <?php
                    $attributes = array('id' => 'sign_in');
                    echo form_open('activateparish', $attributes);
                    ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">vpn_key</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="key" placeholder="Productkey" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">whatshot</i>
                        </span>
                        <div class="form-line">
                            <select name="parish" class="form-control show-tick" required="">
                                <option value="">Select parish</option>
                                <?php
                                if (isset($parishes)):
                                    foreach ($parishes as $parish):
                                        ?>
                                        <option value="<?php echo $this->myencrypt->encrypt_url($parish->mparish_id); ?>"><?php echo $parish->name . ", " . $parish->city; ?></option>
                                        <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-offset-4 col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit" name="submit" value="submitted">ACTIVATE</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

        <!-- Jquery Core Js -->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core Js -->
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.js"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="<?php echo base_url(); ?>assets/plugins/node-waves/waves.js"></script>

        <!-- Validation Plugin Js -->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/jquery.validate.js"></script>

        <!-- Select Plugin Js -->
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

        <!-- Input Mask Plugin Js -->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>

        <!-- Custom Js -->
        <script src="<?php echo base_url(); ?>assets/js/admin.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/pages/examples/sign-in.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/pages/forms/advanced-form-elements.js"></script>
    </body>

</html>