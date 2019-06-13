<div class="block-header">
    <h2>About</h2>
</div>
<?php
if (isset($enable_btn)) {
    ?>
    <div class="row clearfix align-center">
        <div id="button">
            <a onclick="sync()" class="btn btn-primary btn-lg waves-effect">Upload</a>
        </div>
        <div style="display: none" id="preloader">
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
            <p>Syncronization in progress, please wait. </p>
            <p>(This can take upto 20 minutes.)</p>
        </div>
    </div>
    <script>
        function sync() {
            var base_url = window.location.origin;
            $('#button').hide();
            $('#preloader').show();
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: base_url + "/ParishManager/sync",
                data: {},
                cache: false,
                success: function (result) {
                    console.log(result);
                    if ('success' in result) {
                        $('#preloader').hide();
                        swal({
                            title: "Completed",
                            text: result['success'],
                            type: "success",
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Done",
                            closeOnConfirm: false
                        }, function () {
                            window.location = base_url + "/ParishManager/admin/sync";
                        });
                    } else if ('warning' in result) {
                        $('#preloader').hide();
                        swal({
                            title: "Warning",
                            text: result['warning'],
                            type: "warning",
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Done",
                            closeOnConfirm: false
                        }, function () {
                            window.location = base_url + "/ParishManager/admin/sync";
                        });
                    } else {
                        $('#preloader').hide();
                        swal({
                            title: "Error",
                            text: 'Something went wrong.',
                            type: "error",
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Done",
                            closeOnConfirm: false
                        }, function () {
                            window.location = base_url + "/ParishManager/admin/sync";
                        });
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    $('#button').show();
                    $('#preloader').hide();
                    swal("Failed!", errorThrown, "error");
                }});
        }
    </script>
<?php } else { ?>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h3 class="align-center">Parish Manager</h3>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <?php
                                if (isset($abouts)):
                                    $i = 1;
                                    foreach ($abouts as $about) :
                                        ?>
                                        <tr>
                                            <td><?php echo $about->name; ?></td>
                                            <td><?php echo $about->data; ?></td>
                                            <?php if (!empty($about->remarks)) {
                                                ?>
                                                <td><?php echo $about->remarks; ?></td>
                                                <?php
                                            }
                                            ?>
                                        </tr>
                                        <?php
                                    endforeach;
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($server_dbversion)) {
        if ($local_dbversion['data'] < $server_dbversion['data']) {
            ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Update available (<?php echo 'V' . $server_dbversion['data']; ?>)</h2>
                            <small style="color: purple">Require internet connection.</small>
                        </div>
                        <div class="body">
                            <div class="align-center" id="content">
                                <p>Current Version - <b><?php echo 'V'.$local_dbversion['data']; ?></b></p>
                                <p>Do you wish to update to <b><?php echo 'V' . $server_dbversion['data'] . "?"; ?></b></p>
                                <a onclick="update()" class="btn btn-primary btn-lg waves-effect">Update</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function update() {
                    var base_url = window.location.origin;
                    swal({
                        title: "Update database?",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: true,
                    }, function () {
                        window.location.replace("<?php echo base_url() . 'admin/backup?parish_name=' . $parishdetails['name']; ?>");
                    });
                }
            </script>
        <?php
        }
    }
    ?>
<?php } ?>