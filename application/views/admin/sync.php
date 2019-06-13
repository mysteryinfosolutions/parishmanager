<div class="block-header">
    <h2>SYNC WITH SERVER</h2>
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
                    <h2>Backup database (Offline)</h2>
                    <small style="color: green">Save to PC. Doesn't require internet connection.</small>
                </div>
                <div class="body">
                    <div class="align-center" id="content">
                        <a onclick="backup()" class="btn btn-primary btn-lg waves-effect">Backup</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Sync database (Online)</h2>
                    <small style="color: red">Internet Connection Required</small>
                </div>
                <div class="body">
                    <div class="align-center" id="content">
                        <a onclick="checkConnection()" class="btn btn-primary btn-lg waves-effect">Connect</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function backup() {
            var base_url = window.location.origin;
            swal({
                title: "Backup to PC?",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: true,
            }, function () {
                window.location.replace("<?php echo base_url() . 'admin/backup?parish_name=' . $parishdetails['name']; ?>");
            });
        }
        function checkConnection() {
            swal({
                title: "Connect to server?",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function () {
//                var base_url = window.location.origin;
                    var base_url = "http://diocese-manager.esy.es";
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: base_url + "/sync/authenticate",
                    timeout: "5000",
                    data: {pid: '<?php echo $parishdetails['mparish_id']; ?>'},
                    cache: false,
                    success: function (result) {
                        var base_url = window.location.origin;
                        if (result['status'] == true) {
                            swal({
                                title: "Connected",
                                text: "Server connection successfull, proceed to upload?",
                                type: "success",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Yes",
                                closeOnConfirm: false
                            }, function () {
                                window.location = base_url + "/ParishManager/admin/sync?sync_btn=true&p_id=<?php echo $this->myencrypt->encrypt_url($parishdetails['mparish_id']); ?>";
                            });
                        } else {
                            swal("Failed!", "" + result['error'], "warning");
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        if (XMLHttpRequest.readyState == 4) {
                            swal("Failed!", errorThrown, "error");
                        } else if (XMLHttpRequest.readyState == 0) {
                            swal("Connection timed-out");
                        } else {
                            swal("Something went wrong");
                        }
                    }});
            });
        }
    </script>
<?php } ?>