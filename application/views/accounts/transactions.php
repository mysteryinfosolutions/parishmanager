<?php
if (isset($transaction)):
    $id = $this->myencrypt->encrypt_url($transaction['ttransaction_id']);
    ?>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a onclick="window.history.back()" class="btn btn-default">Back</a>
                    <h3 class="align-center">Transactions</h3>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="managetransaction?id=<?php echo $this->myencrypt->encrypt_url($transaction['ttransaction_id']); ?>&edit=true" class="btn btn-primary">Edit</a>
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
                                    <td>: <?php echo $transaction['ttransaction_id']; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Date</th>
                                    <td>: <?php echo $transaction['date']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Particular</th>
                                    <td>: <?php echo $transaction['particular']; ?></td>
                                </tr>
                                <?php
                                if (isset($transaction['mbankaccount_id'])) {
                                    ?>
                                    <tr>
                                        <th scope="row">Bank Account</th>
                                        <td>: <a href="bankaccounts?bankaccount_id=<?php echo $this->myencrypt->encrypt_url($transaction['mbankaccount_id']); ?>&view=true"><?php echo $transaction['account_name']; ?></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Account Number</th>
                                        <td>: <?php echo $transaction['bank_account_number']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <?php
                                if (!empty($transaction['fixed_deposit'])) {
                                    ?><tr>
                                        <th scope="row">Fixed Deposit</th>
                                        <td>: Yes <a href="managetransaction?id=<?php echo $this->myencrypt->encrypt_url($transaction['ttransaction_id']); ?>&release=true" class="btn btn-success">Release Deposit</a></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <th scope="row">Amount</th>
                                    <td>: <b><?php
                                            if (isset($transaction['cash_debit'])) {
                                                echo $transaction['cash_debit'];
                                            } else if (isset($transaction['cash_credit'])) {
                                                echo $transaction['cash_credit'];
                                            } else if (isset($transaction['bank_credit'])) {
                                                echo $transaction['bank_credit'];
                                            } else if (isset($transaction['bank_debit'])) {
                                                echo $transaction['bank_debit'];
                                            }
                                            ?></b></td>
                                </tr>
                                <tr>
                                    <th scope="row">Remarks</th>
                                    <td>: <?php echo $transaction['remarks']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Created at</th>
                                    <td>: <?php echo $transaction['created_at']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Updated at</th>
                                    <td>: <?php echo $transaction['updated_at']; ?></td>
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
                title: "Delete Transaction?",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                window.location.replace("<?php echo base_url() . 'accounts/managetransaction?id=' . $this->myencrypt->encrypt_url($transaction['ttransaction_id']) . '&delete=true'; ?>");
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
                            <h2>TRANSACTIONS</h2>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td>                   
                                    <a href="managetransaction?mode=Cash Receipt" class="btn btn-primary btn-lg waves-effect"><span>RECEIPT</span></a>
                                </td>
                                <td>                                
                                    <a href="managetransaction?mode=Cash Payment" class="btn btn-primary btn-lg waves-effect"><span>PAYMENT</span></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="managetransaction?mode=Bank Deposit" class="btn btn-primary btn-lg waves-effect"><span>BANK DEPOSIT</span></a>
                                </td>
                                <td>
                                    <a href="managetransaction?mode=Bank Withdrawal" class="btn btn-primary btn-lg waves-effect"><span>BANK WITHDRAW</span></a>
                                </td>
                            </tr>
                            <tr>
                                <td>                               
                                    <a href="managetransaction?mode=Received to Bank" class="btn btn-primary btn-lg waves-effect"><span>RECEIVE TO BANK</span></a>
                                </td>
                                <td>                               
                                    <a href="managetransaction?mode=Payment from Bank" class="btn btn-primary btn-lg waves-effect"><span>PAY FROM BANK</span></a>
                                </td>
                            </tr>
                        </table>
                    </div>
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
                                                if (isset($transaction->cash_debit)) {
                                                    echo $transaction->cash_debit;
                                                } else if (isset($transaction->cash_credit)) {
                                                    echo $transaction->cash_credit;
                                                } else if (isset($transaction->bank_credit)) {
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
                        <?php if (!empty($transactions) && !isset($unlimited)) { ?>
                            <a href="transactions?unlimited=true" class="btn btn-primary">Load More</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
endif;
?>
               