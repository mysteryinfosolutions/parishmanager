<?php
if (isset($convent)):
    $id = $this->myencrypt->encrypt_url($convent['mconvent_id']);
    ?>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a onclick="window.history.back()" class="btn btn-default">Back</a>
                    <h3 class="align-center"><?php echo $convent['name']; ?></h3>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="manageconvent?id=<?php echo $this->myencrypt->encrypt_url($convent['mconvent_id']); ?>&edit=true" class="btn btn-primary">Edit</a>
                            <a onclick="deleteConvent()" class="btn btn-danger">Delete</a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="row">ID</th>
                                    <td>:  <?php echo $convent['mconvent_id']; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Congregation</th>
                                    <td>: <?php echo $convent['congregation_name']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Address</th>
                                    <td>: <?php
                                        if (!empty($convent['addressline1'])) {
                                            echo $convent['addressline1'] . "<br>";
                                        }
                                        if (!empty($convent['addressline2'])) {
                                            echo $convent['addressline2'] . "<br>";
                                        }
                                        if (!empty($convent['city'])) {
                                            echo $convent['city'] . ", ";
                                        }
                                        if (!empty($convent['state_name'])) {
                                            echo $convent['state_name'] . "<br>";
                                        }
                                        if (!empty($convent['country_name'])) {
                                            echo $convent['country_name'];
                                        }
                                        if (!empty($convent['pincode'])) {
                                            echo " Pin:-" . $convent['pincode'];
                                        }
                                        ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Remarks</th>
                                    <td>: <?php echo $convent['remarks']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Created at</th>
                                    <td>: <?php echo $convent['created_at']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Updated at</th>
                                    <td>: <?php echo $convent['updated_at']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Community
                    </h2>  
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="manageconventcommunity?mconvent_id=<?php echo $this->myencrypt->encrypt_url($convent['mconvent_id']); ?>&add_community=true" class="btn btn-primary">Manage Community</a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NAME</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($community_members)):
                                    if (count($community_members) > 0):
                                        $i = 1;
                                        foreach ($community_members as $community_member) :
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $community_member->name; ?></td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    else:
                                        ?>
                                        <tr>
                                            <td colspan="2">No records found.</td>
                                        </tr>
                                    <?php
                                    endif;
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteConvent() {
            swal({
                title: "Delete convent?",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                window.location.replace("<?php echo base_url() . 'admin/manageconvent?id=' . $this->myencrypt->encrypt_url($convent['mconvent_id']) . '&delete=true'; ?>");
            });
        }
    </script>      
<?php else:
    ?>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h2>CONVENTS</h2>
                        </div>
                        <div class="col-xs-12 col-sm-6 align-right">
                            <div class="switch panel-switch-btn">
                                <a href="manageconvent" class="btn btn-primary waves-effect"><i class="material-icons">add</i><span>NEW</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable" data-page-length="100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($convents)):
                                    $i = 1;
                                    foreach ($convents as $convent) :
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><a href="<?php echo base_url() . 'admin/convents?convent_id=' . $this->myencrypt->encrypt_url($convent->mconvent_id) . '&view=true'; ?>"><?php echo $convent->name; ?></a></td>
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
endif;
?>
               