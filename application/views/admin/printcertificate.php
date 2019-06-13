<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo ucfirst($register['mevent_name']); ?> Certificate</title>
        <link href="<?php echo base_url(); ?>assets/plugins/Icon/MaterialDesignIcons.css" rel="stylesheet" type="text/css"/>

        <!-- Bootstrap Core Css -->
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="<?php echo base_url(); ?>assets/plugins/node-waves/waves.css" rel="stylesheet" />

        <!-- JQuery DataTable Css -->
        <link href="<?php echo base_url(); ?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

        <!-- Animation Css -->
        <link href="<?php echo base_url(); ?>assets/plugins/animate-css/animate.css" rel="stylesheet" />

        <!-- Bootstrap Material Datetime Picker Css -->
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" type="text/css"/>

        <!-- Sweetalert Css -->
        <link href="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

        <!-- Bootstrap Select Css -->
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

        <!-- Custom Css -->
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">

        <!-- Jquery Core Js -->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

        <script>
            $(document).ready(function () {
                window.print();
                history.back();
            });
        </script>
        <style>
            @page {
                margin: 0.0cm;
            }
            /* Login Page ================================== */
            .center-text {
                text-align: center;
            }
            .footer { 
                position: fixed; 
                bottom: 80px; 
                font-size: 14px;
            }
            .footer .left{
                text-align: left;
                left: 100px
            }
            .footer .right{
                text-align: right;
                right: 100px
            }
            .table1 {
                margin: auto;
                width: auto;
                padding: 10px;
                max-width: 100%;
                margin-bottom: 20px;
                font-size: 16px;
            }
            .table1 > thead > tr > th,
            .table1 > tbody > tr > th,
            .table1 > tfoot > tr > th,
            .table1 > thead > tr > td,
            .table1 > tbody > tr > td,
            .table1 > tfoot > tr > td {
                padding: 8px;
                line-height: 1.42857143;
                vertical-align: top;
            }
            .table1 > thead > tr > th {
                vertical-align: bottom;
            }

            .showHr{
                display: block;
                height: 2px;
                background: transparent;
                width: 100%;
                border: none;
                border-top: solid 1px #aaa;                
            }
        </style>
    </head>
    <body>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header center-text">
                        <h2 style="text-transform: uppercase">
                            <?php echo ucfirst($register['mevent_name']); ?> Certificate
                        </h2>
                        <h1 style="text-transform: uppercase">
                            <?php echo $parishdetails['name']; ?>
                        </h1>
                        <h2 style="text-transform: uppercase">
                            <?php echo $parishdetails['addressline1']; ?>, <?php echo $parishdetails['city']; ?>
                        </h2>
                        <br>
                        <h2 style="text-transform: uppercase">
                            <?php
                            echo $parishdetails['state'] . ', ' . $parishdetails['country'];
                            if (!empty($parishdetails['pincode'])) {
                                ?>, PIN:-<?php
                                echo $parishdetails['pincode'];
                            }
                            ?>.
                        </h2>
                    </div>
                    <hr class="showHr">
                    <div class="body">
                        <br>
                        <p class="center-text" style="font-size: 14px">An extract from the register of <?php echo strtolower($register['mevent_name']); ?>s maintained at <?php echo $parishdetails['name']; ?>, <?php echo $parishdetails['city']; ?></p>
                        <br>
                        <table class="table1">
                            <tr>
                                <td>Reg. No.</td>
                                <td>: <?php echo $register['register_no']; ?></td>
                            </tr>
                            <tr>
                                <td>Date of <?php echo $register['mevent_name']; ?></td>
                                <td>: <?php echo $register['date']; ?></td>
                            </tr>

                            <?php if ($register['mevent_id'] === '4') { ?>
                                <tr>
                                    <td></td>
                                    <th>&nbsp;&nbsp;Groom</th>
                                    <th>Bride</th>
                                </tr>
                                <tr>
                                    <td>Christian Name</td>
                                    <td>: <?php echo ucfirst($groom['firstname']).' '.ucfirst($groom['lastname']); ?></td>
                                    <td><?php echo ucfirst($bride['firstname']).' '.ucfirst($bride['lastname']); ?></td>
                                </tr>
                                <tr>
                                    <td>Date of Birth</td>
                                    <td>: <?php echo $groom['dateofbirth']; ?></td>
                                    <td><?php echo $bride['dateofbirth']; ?></td>
                                </tr>
                                <tr>
                                    <td>Name of Father</td>
                                    <td>: <?php echo ucfirst($groom['father']); ?></td>
                                    <td><?php echo ucfirst($bride['father']); ?></td>
                                </tr>
                                <tr>
                                    <td>Name of Mother</td>
                                    <td>: <?php echo ucfirst($groom['mother']); ?></td>
                                    <td><?php echo ucfirst($bride['mother']); ?></td>
                                </tr>
                                <tr>
                                    <td>Occupation</td>
                                    <td>: <?php echo ucfirst($groom['occupation']); ?></td>
                                    <td><?php echo ucfirst($bride['occupation']); ?></td>
                                </tr>
                                <tr>
                                    <td>First Witness</td>
                                    <td>: <?php echo ucfirst($register['witness1']); ?></td>
                                </tr>
                                <tr>
                                    <td>Second Witness</td>
                                    <td>: <?php echo ucfirst($register['witness2']); ?></td>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <td>Name</td>
                                    <td>: <?php echo $member['firstname'] . ' ' . $member['lastname']; ?></td>
                                </tr>
                                <?php if ($register['mevent_id'] === '1') {
                                    ?>
                                    <tr>
                                        <td>Christian Name</td>
                                        <td>: <?php echo $register['baptismal_name']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr>
                                    <td>Date of Birth</td>
                                    <td>: <?php echo $member['dateofbirth']; ?></td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td>: <?php echo ucfirst($member['gender']); ?></td>
                                </tr>
                                <tr>
                                    <td>Name of Father</td>
                                    <td>: <?php echo ucfirst($member['father']); ?></td>
                                </tr>
                                <tr>
                                    <td>Name of Mother</td>
                                    <td>: <?php echo ucfirst($member['mother']); ?></td>
                                </tr>
                            <?php
                            }
                            if ($register['mevent_id'] === '1' || $register['mevent_id'] === '3') {
                                ?>
                                <tr>
                                    <td>Name of God-Father</td>
                                    <td>: <?php echo $register['godfather']; ?></td>
                                </tr>
                                <tr>
                                    <td>Name of God-Mother</td>
                                    <td>: <?php echo $register['godmother']; ?></td>
                                </tr>
    <?php } ?>
                                <tr>
                                    <td>Minister of <?php echo $register['mevent_name']; ?></td>
                                    <td>: <?php echo $register['minister']; ?></td>
                                </tr>
                                <tr>
                                    <td>Place of <?php echo $register['mevent_name']; ?></td>
                                    <td>: <?php echo $register['place']; ?></td>
                                </tr>
                                <tr>
                                    <td>Venue Parish</td>
                                    <td>: <?php echo $register['venueparish_name'] . ', ' . $register['venueparish_city']; ?></td>
                                </tr>
                                <tr>
                                    <td>Remarks</td>
                                    <td>: <?php echo $register['remarks']; ?></td>
                            </tr>
                        </table>
                        <br>
                        <p class="center-text">I certify that the above extract is a true copy</p>
                        <br>
                        <div class="footer">

                            <p class="footer left">Date :</p>
                            <p class="footer right">Parish Priest</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

