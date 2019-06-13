<?php
if (isset($substation)):
    $id = $this->myencrypt->encrypt_url($substation['msubstation_id']);
    ?>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a onclick="window.history.back()" class="btn btn-default">Back</a>
                    <h3 class="align-center"><?php echo $substation['name']; ?></h3>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="managesubstation?id=<?php echo $this->myencrypt->encrypt_url($substation['msubstation_id']); ?>&edit=true" class="btn btn-primary">Edit</a>
                            <a onclick="deleteSubstation()" class="btn btn-danger">Delete</a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="row">ID</th>
                                    <td>: <?php echo $substation['msubstation_id']; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Place</th>
                                    <td>: <?php echo $substation['place']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Established In</th>
                                    <td>: <?php echo $substation['established_in']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Remarks</th>
                                    <td>: <?php echo $substation['remarks']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Created at</th>
                                    <td>: <?php echo $substation['created_at']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Updated at</th>
                                    <td>: <?php echo $substation['updated_at']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteSubstation() {
            swal({
                title: "Delete substation?",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                window.location.replace("<?php echo base_url() . 'admin/managesubstation?id=' . $this->myencrypt->encrypt_url($substation['msubstation_id']) . '&delete=true'; ?>");
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
                            <h2>SUBSTATIONS</h2>
                        </div>
                        <div class="col-xs-12 col-sm-6 align-right">
                            <div class="switch panel-switch-btn">
                                <a href="managesubstation" class="btn btn-primary waves-effect"><i class="material-icons">add</i><span>NEW</span></a>
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
                                if (isset($substations)):
                                    $i = 1;
                                    foreach ($substations as $substation) :
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><a href="<?php echo base_url() . 'admin/substations?substation_id=' . $this->myencrypt->encrypt_url($substation->msubstation_id) . '&view=true'; ?>"><?php echo $substation->name; ?></a></td>
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
               