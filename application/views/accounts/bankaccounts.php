<?php
if (isset($bankaccount)):
    $id = $this->myencrypt->encrypt_url($bankaccount['mbankaccount_id']);
    ?>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a onclick="window.history.back()" class="btn btn-default">Back</a>
                    <h3 class="align-center"><?php echo $bankaccount['name']; ?></h3>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="managebankaccount?id=<?php echo $this->myencrypt->encrypt_url($bankaccount['mbankaccount_id']); ?>&edit=true" class="btn btn-primary">Edit</a>
                            <a onclick="deleteBankaccount()" class="btn btn-danger">Delete</a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="row">ID</th>
                                    <td>: <?php echo $bankaccount['mbankaccount_id']; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Bank</th>
                                    <td>: <?php echo $bankaccount['bank_name']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Branch</th>
                                    <td>: <?php echo $bankaccount['branch']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Account Number</th>
                                    <td>: <?php echo $bankaccount['account_number']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">IFSC</th>
                                    <td>: <?php echo $bankaccount['ifsc_code']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Cash Balance</th>
                                    <td>: <b><?php echo $balance['balance']; ?></b></td>
                                </tr>
                                <tr>
                                    <th scope="row">Fixed Deposits</th>
                                    <td>: <b><?php echo $fixed_deposit['fixedamount']; ?></b></td>
                                </tr>
                                <tr>
                                    <th scope="row">Remarks</th>
                                    <td>: <?php echo $bankaccount['remarks']; ?></td>
                                </tr>

                                <tr>
                                    <th scope="row">Created at</th>
                                    <td>: <?php echo $bankaccount['created_at']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Updated at</th>
                                    <td>: <?php echo $bankaccount['updated_at']; ?></td>
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
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h2>TRANSACTIONS</h2>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <h4>Recent transactions</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable">
                            <thead>
                                <tr>

                                    <th>Date</th>
                                    <th>Particular</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($transactions)) {
                                    foreach ($transactions as $transaction) :
                                        ?>
                                        <tr>

                                            <td><?php echo $transaction->date; ?></td>
                                            <td><a href="transactions?transaction_id=<?php echo $this->myencrypt->encrypt_url($transaction->ttransaction_id); ?>&view=true"><?php echo $transaction->particular; ?>
                                                    <?php
                                                    if (isset($transaction->mbankaccount_id)) {
                                                        echo " - " . $transaction->account_name;
                                                    }
                                                    if (!empty($transaction->fixed_deposit)) {
                                                        echo " (Fixed Deposit)";
                                                    }
                                                    ?>
                                                </a></td>
                                            <td><?php
                                                if (isset($transaction->bank_credit)) {
                                                    echo $transaction->bank_credit;
                                                } else if (isset($transaction->bank_debit)) {
                                                    echo $transaction->bank_debit;
                                                }
                                                ?></td>
                                        </tr>
                                        <?php
                                    endforeach;
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="3">Sorry, no records found</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteBankaccount() {
            swal({
                title: "Delete bankaccount?",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                window.location.replace("<?php echo base_url() . 'accounts/managebankaccount?id=' . $this->myencrypt->encrypt_url($bankaccount['mbankaccount_id']) . '&delete=true'; ?>");
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
                            <h2>BANK ACCOUNTS</h2>
                        </div>
                        <div class="col-xs-12 col-sm-6 align-right">
                            <div class="switch panel-switch-btn">
                                <a href="managebankaccount" class="btn btn-primary waves-effect"><i class="material-icons">add</i><span>NEW</span></a>
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
                                if (isset($bankaccounts)):
                                    $i = 1;
                                    foreach ($bankaccounts as $bankaccount) :
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><a href="<?php echo base_url() . 'accounts/bankaccounts?bankaccount_id=' . $this->myencrypt->encrypt_url($bankaccount->mbankaccount_id) . '&view=true'; ?>"><?php echo $bankaccount->name; ?></a></td>
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

