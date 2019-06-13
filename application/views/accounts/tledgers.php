<?php
if (isset($tledger)):
    $id = $this->myencrypt->encrypt_url($tledger['tledger_id']);
    ?>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a onclick="window.history.back()" class="btn btn-default">Back</a>
                    <h3 class="align-center"><?php echo $tledger['name']; ?></h3>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="managetledger?id=<?php echo $this->myencrypt->encrypt_url($tledger['tledger_id']); ?>&edit=true" class="btn btn-primary">Edit</a>
                            <a onclick="deleteScc()" class="btn btn-danger">Delete</a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="row">ID</th>
                                    <td>: <?php echo $tledger['tledger_id']; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Ledger Master</th>
                                    <td>: <?php echo $tledger['mledger_name']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Created at</th>
                                    <td>: <?php echo $tledger['created_at']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Updated at</th>
                                    <td>: <?php echo $tledger['updated_at']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteTledger() {
            swal({
                title: "Delete Ledger?",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                window.location.replace("<?php echo base_url() . 'accounts/managetledger?id=' . $this->myencrypt->encrypt_url($tledger['tledger_id']) . '&delete=true'; ?>");
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
                            <h2>COLLECTIONS</h2>
                        </div>
                        <div class="col-xs-12 col-sm-6 align-right">
                            <div class="switch panel-switch-btn">
                                <a href="managetledger" class="btn btn-primary waves-effect"><i class="material-icons">add</i><span>NEW</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($tledgers)):
                                    $i = 1;
                                    foreach ($tledgers as $tledger) :
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><a href="<?php echo base_url() . 'accounts/tledgers?tledger_id=' . $this->myencrypt->encrypt_url($tledger->tledger_id) . '&view=true'; ?>"><?php echo $tledger->name; ?></a></td>
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
               