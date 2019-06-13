<?php
if (isset($donation)):
    $id = $this->myencrypt->encrypt_url($donation['ttransaction_id']);
    ?>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a onclick="window.history.back()" class="btn btn-default">Back</a>
                    <h3 class="align-center">Donations</h3>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="managedonation?id=<?php echo $this->myencrypt->encrypt_url($donation['ttransaction_id']); ?>&edit=true" class="btn btn-primary">Edit</a>
                            <a onclick="deleteTransaction()" class="btn btn-danger">Delete</a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="row">ID</th>
                                    <td>: <?php echo $donation['voucher_number']; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Date</th>
                                    <td>: <?php echo $donation['date']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Particular</th>
                                    <td>: <?php echo $donation['particular']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Amount</th>
                                    <td>: <?php echo $donation['cash_debit']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Remarks</th>
                                    <td>: <?php echo $donation['remarks']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Created at</th>
                                    <td>: <?php echo $donation['created_at']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Updated at</th>
                                    <td>: <?php echo $donation['updated_at']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteTransaction() {
            swal({
                title: "Delete donation?",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
    <?php
    $target="";
    if (!empty($donation['mscc_id'])) {
        $target = '&mscc_id=' . $this->myencrypt->encrypt_url($donation['mscc_id']);
    }
    if (!empty($donation['mfamily_id'])) {
        $target = '&mfamily_id=' . $this->myencrypt->encrypt_url($donation['mfamily_id']);
    }
    ?>
                window.location.replace("<?php echo base_url() . 'admin/managedonation?id=' . $this->myencrypt->encrypt_url($donation['ttransaction_id']) . '&delete=true'.$target; ?>");
            });
        }
    </script>      
    <?php
endif;
?>
               