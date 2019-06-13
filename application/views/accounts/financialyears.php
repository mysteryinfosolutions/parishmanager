<?php
if (isset($financialyear)):
    $id = $this->myencrypt->encrypt_url($financialyear['mfinancialyear_id']);
    ?>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a onclick="window.history.back()" class="btn btn-default">Back</a>
                    <h3 class="align-center"><?php echo $financialyear['yearset']; ?></h3>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="managefinancialyear?id=<?php echo $this->myencrypt->encrypt_url($financialyear['mfinancialyear_id']); ?>&edit=true" class="btn btn-primary">Edit</a>
                            <a onclick="deleteFinancialyear()" class="btn btn-danger">Delete</a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="row">ID</th>
                                    <td>: <?php echo $financialyear['mfinancialyear_id']; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Status</th>
                                    <td>: <?php
                                        if (empty($financialyear['active'])) {
                                            echo "<span class='col-pink'>Inactive</span>";
                                            ?>
                                            &nbsp;<a href="<?php echo base_url() . 'accounts/managefinancialyear?id=' . $this->myencrypt->encrypt_url($financialyear['mfinancialyear_id']) . '&activate=true'; ?>" class="btn btn-primary">Activate</a>
                                            <?php
                                        } else {
                                            echo "<span class='col-teal'>Active</span>";
                                        }
                                        ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Term</th>
                                    <td>: <?php echo $financialyear['start_date'] . " to " . $financialyear['end_date']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Receipt No.</th>
                                    <td>: <?php echo $financialyear['receipt_prefix'] . $financialyear['receipt_voucher'] . $financialyear['receipt_suffix']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Payment No.</th>
                                    <td>: <?php echo $financialyear['payment_prefix'] . $financialyear['payment_voucher'] . $financialyear['payment_suffix']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Remarks</th>
                                    <td>: <?php echo $financialyear['remarks']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Created at</th>
                                    <td>: <?php echo $financialyear['created_at']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Updated at</th>
                                    <td>: <?php echo $financialyear['updated_at']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteFinancialyear() {
            swal({
                title: "Delete Financial Year?",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                window.location.replace("<?php echo base_url() . 'accounts/managefinancialyear?id=' . $this->myencrypt->encrypt_url($financialyear['mfinancialyear_id']) . '&delete=true'; ?>");
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
                            <h2>FINANCIAL YEARS</h2>
                        </div>
                        <div class="col-xs-12 col-sm-6 align-right">
                            <div class="switch panel-switch-btn">
                                <a href="managefinancialyear" class="btn btn-primary waves-effect"><i class="material-icons">add</i><span>NEW</span></a>
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
                                    <th>Yearset</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($financialyears)):
                                    $i = 1;
                                    foreach ($financialyears as $financialyear) :
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><a href="<?php echo base_url() . 'accounts/financialyears?financialyear_id=' . $this->myencrypt->encrypt_url($financialyear->mfinancialyear_id) . '&view=true'; ?>"><?php echo $financialyear->yearset; ?></a>
                                                <?php if ($financialyear->active === '1') {
                                                    ?> <span class="label label-success">Active</span>
                                                <?php } ?>
                                            </td>
                                            <td><?php if ($financialyear->active !== '1') {
                                                    ?> <a href="<?php echo base_url() . 'accounts/managefinancialyear?id=' . $this->myencrypt->encrypt_url($financialyear->mfinancialyear_id) . '&activate=true'; ?>" class="btn btn-primary">Activate</a>
                                                <?php } ?></td>
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
               