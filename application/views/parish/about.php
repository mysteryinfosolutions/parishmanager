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
                            window.location = base_url + "/ParishManager/parish/sync";
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
                            window.location = base_url + "/ParishManager/parish/sync";
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
                            window.location = base_url + "/ParishManager/parish/sync";
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
                        <div class="align-center" id="content">
                            <a onclick="checkForUpdate()" class="btn btn-primary btn-lg waves-effect">Check for Update</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (!empty($install_update)) { ?>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Update Availiable <span style="color: red">Restart required</span></h2>
                        <small style="color: purple">Strongly recommended.</small>
                    </div>
                    <div class="body">
                        <div class="align-center" id="content">
        <!--                            <p>Current Version - <b><?php echo 'V' . $local_dbversion['data']; ?></b></p>
                            <p>Do you wish to update to <b><?php echo 'V' . $server_dbversion['data'] . "?"; ?></b></p>-->
                            <a onclick="installUpdate()" class="btn btn-primary btn-lg waves-effect">Update</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                installUpdate();
            });

        </script>
    <?php } ?>
    <script>
        function installUpdate() {
            var base_url = window.location.origin;
            var base_url = "http://localhost:8888/ParishManager";
            swal({
                title: "Install Update",
                text: "Update downloded and ready for install.<span style='color: red'> Application Restart required</span>. Do you wish to continue?",
                type: "info",
                html: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: base_url + "/installupdate",
                    cache: false,
                    success: function (result) {
                        if (result['status'] == true) {
                            var
                                    redirectInSeconds = 5,
                                    displayText = "Application restarts in #1 seconds.",
                                    timer;

                            swal({
                                title: "Installation successfull",
                                type: "success",
                                text: displayText.replace(/#1/, redirectInSeconds),
                                timer: redirectInSeconds * 1000,
                                showConfirmButton: false
                            });
                            timer = setInterval(function () {
                                redirectInSeconds--;

                                if (redirectInSeconds < 0) {

                                    clearInterval(timer);
                                }
                                $('.sweet-alert > p').text(displayText.replace(/#1/, redirectInSeconds));
                            }, 1000);
                            window.setTimeout(function () {
                                window.location.href = base_url + "/logout";
                            }, 5000);
                        } else {
                            swal("Failed!", "Update installation failed.", "error");
                        }
                    }});
            });
        }
        function checkForUpdate() {
            var base_url = window.location.origin;
            var base_url = "http://localhost:8888/ParishManager";
            swal({
                title: "Check for update?",
                type: "info",
                html: true,
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function () {
                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: base_url + "/checkforupdate",
                    timeout: "5000",
                    cache: false,
                    success: function (result) {
                        if (result['status'] == true) {
                            swal({
                                title: "Update availiable",
                                text: "Do you want to update to latest version?",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Yes",
                                closeOnConfirm: false
                            }, function () {
                                $.ajax({
                                    type: "GET",
                                    dataType: 'json',
                                    url: base_url + "/update",
                                    //                                    timeout: "15000"s
                                    cache: false,
                                    success: function (result) {
                                        if (result['status'] == true) {
                                            if (result['app_updated']) {
                                                swal({
                                                    title: "Install Update",
                                                    text: "Update downloded and ready for install.<span style='color: red'> Application Restart required</span>. Do you wish to continue?",
                                                    type: "info",
                                                    html: true,
                                                    showCancelButton: true,
                                                    confirmButtonColor: "#DD6B55",
                                                    confirmButtonText: "Yes",
                                                    closeOnConfirm: false
                                                }, function () {
                                                    $.ajax({
                                                        type: "GET",
                                                        dataType: 'json',
                                                        url: base_url + "/installupdate",
                                                        cache: false,
                                                        success: function (result) {
                                                            if (result['status'] == true) {
                                                                var
                                                                        redirectInSeconds = 5,
                                                                        displayText = "Application restarts in #1 seconds.",
                                                                        timer;

                                                                swal({
                                                                    title: "Installation successfull",
                                                                    type: "success",
                                                                    text: displayText.replace(/#1/, redirectInSeconds),
                                                                    timer: redirectInSeconds * 1000,
                                                                    showConfirmButton: false
                                                                });
                                                                timer = setInterval(function () {
                                                                    redirectInSeconds--;

                                                                    if (redirectInSeconds < 0) {

                                                                        clearInterval(timer);
                                                                    }
                                                                    $('.sweet-alert > p').text(displayText.replace(/#1/, redirectInSeconds));
                                                                }, 1000);
                                                                window.setTimeout(function () {
                                                                    window.location.href = base_url + "/logout";
                                                                }, 5000);
                                                            } else {
                                                                swal("Failed!", "Update installation failed.", "error");
                                                            }
                                                        }});
                                                });
                                            } else {
                                                swal({
                                                    title: "Success",
                                                    text: "Update completed successfully.",
                                                    type: "success",
                                                    confirmButtonColor: "#DD6B55",
                                                    confirmButtonText: "Ok"
                                                });
                                            }
                                        } else if (result['status'] == false) {
                                            swal("Success", "" + result['msg'], "success");
                                        } else {
                                            swal("Failed!", "" + result['error'], "warning");
                                        }
                                    },
                                    error: function (jqXHR, exception) {
                                        var msg = '';
                                        if (jqXHR.status === 0) {
                                            msg = 'No Internet Connection.\n Verify Network.';
                                        } else if (jqXHR.status == 404) {
                                            msg = 'Requested page not found. [404]';
                                        } else if (jqXHR.status == 500) {
                                            msg = 'Internal Server Error [500].';
                                        } else if (exception === 'parsererror') {
                                            msg = 'Requested JSON parse failed.';
                                        } else if (exception === 'timeout') {
                                            msg = 'Time out error.';
                                        } else if (exception === 'abort') {
                                            msg = 'Ajax request aborted.';
                                        } else {
                                            msg = 'Uncaught Error.\n' + jqXHR.responseText;
                                        }
                                        swal("Failed!", msg, "error");
                                    }});
                            });
                        } else if (result['status'] == false) {
                            swal("Success", "" + result['msg'], "success");
                        } else {
                            swal("Failed!", "" + result['error'], "warning");
                        }
                    },
                    error: function (jqXHR, exception) {
                        var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'No Internet Connection.\n Verify Network.';
                        } else if (jqXHR.status == 404) {
                            msg = 'Requested page not found. [404]';
                        } else if (jqXHR.status == 500) {
                            msg = 'Internal Server Error [500].';
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                        } else {
                            msg = 'Uncaught Error.\n' + jqXHR.responseText;
                        }
                        swal("Failed!", msg, "error");
                    }});
            });
        }
    </script>
<?php } ?>