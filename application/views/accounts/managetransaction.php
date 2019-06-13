<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <a onclick="window.history.back()" class="btn btn-default">Back</a>
                <h3 class="align-center">MANAGE <?php
                    if (isset($mode)) {
                        echo strtoupper($mode);
                    } else {
                        echo 'TRANSACTIONS';
                    }
                    ?></h3>
            </div>
            <div class = "body">
                <?php
                $attributes = array('id' => 'form_advanced_validation',
                    'class' => 'form-horizontal');
                echo form_open('accounts/managetransaction', $attributes);
                ?>
                <input type="hidden" name="mode" value="<?php echo isset($mode) ? $mode : 'Cash Receipt'; ?>">
                <input type="hidden" name="edit_id" value="<?php echo isset($transaction) ? $this->myencrypt->encrypt_url($transaction['ttransaction_id']) : null; ?>">
                <input type="hidden" name="form_mparish_id" value="<?php echo isset($transaction) ? $this->myencrypt->encrypt_url($transaction['mparish_id']) : $this->myencrypt->encrypt_url($parishdetails['mparish_id']); ?>">
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="date">Date</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_date" id="start_date" class="datepicker form-control" placeholder="Choose a date..." value="<?php echo isset($transaction) ? $transaction['date'] : date("Y-m-d"); ?>" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="amount">Amount</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" name="form_amount" id="amount" class="form-control" value="<?php
                                $amount = null;
                                if (isset($transaction)) {
                                    if (isset($transaction['cash_debit'])) {
                                        $amount = $transaction['cash_debit'];
                                    } else if (isset($transaction['cash_credit'])) {
                                        $amount = $transaction['cash_credit'];
                                    } else if (isset($transaction['bank_credit'])) {
                                        $amount = $transaction['bank_credit'];
                                    } else if (isset($transaction['bank_debit'])) {
                                        $amount = $transaction = ['bank_debit'];
                                    }
                                }
                                echo $amount;
                                ?>" required="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="ledger_id">Ledger</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <select name="form_mledger_id" id="ledger_id" class="form-control show-tick" 
                                        required="">
                                    <option value="">Nothing selected</option>
                                    <?php
                                    if (isset($ledgers)):
                                        foreach ($ledgers as $ledger) :
                                            ?>
                                            <option value="<?php echo $this->myencrypt->encrypt_url($ledger->id); ?>" <?php
                                            if (isset($transaction)) {
                                                if ($transaction['mledger_id'] === $ledger->id) {
                                                    ?> selected="true"<?php
                                                        }
                                                    }
                                                    if (isset($mode)) {
                                                        if ($mode === $ledger->name) {
                                                            ?>selected="true"<?php
                                                        }
                                                    }
                                                    ?>><?php echo $ledger->name; ?></option>
                                                    <?php
                                                endforeach;
                                            endif;
                                            ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if (isset($mode) || isset($transaction['mbankaccount_id'])) {
                    if (strpos($mode, 'Bank') !== FALSE || isset($transaction['mbankaccount_id'])) {
                        ?>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="bankaccount_id">Bank Account</label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="form_mbankaccount_id" id="bankaccount_id" class="form-control show-tick" required="">
                                            <option value="">Nothing selected</option>
                                            <?php
                                            if (isset($bankaccounts)):
                                                foreach ($bankaccounts as $bankaccount) :
                                                    ?>
                                                    <option value="<?php echo $this->myencrypt->encrypt_url($bankaccount->mbankaccount_id); ?>" <?php
                                                    if (isset($selected_bankaccount)) {
                                                        if ($selected_bankaccount === $bankaccount->mbankaccount_id) {
                                                            ?> selected="true"<?php
                                                                }
                                                            }
                                                            if (isset($transaction)) {
                                                                if ($transaction['mbankaccount_id'] === $bankaccount->mbankaccount_id) {
                                                                    ?> selected="true"<?php
                                                                }
                                                            }
                                                            ?>><?php echo $bankaccount->name; ?></option>
                                                            <?php
                                                        endforeach;
                                                    endif;
                                                    ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <?php
                if (isset($mode) || !empty($transaction['fixed_deposit'])) {
                    if ($mode == 'Bank Deposit' || !empty($transaction['fixed_deposit'])) {
                        ?>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <input type="checkbox" name="form_fixed_deposit" id="active" class="filled-in chk-col-indigo"
                                    <?php
                                    if (isset($transaction)) {
                                        if ($transaction['fixed_deposit'] === '1') {
                                            echo 'checked';
                                        }
                                    }
                                    if (isset($active_member)) {
                                        echo'checked';
                                    }
                                    ?>
                                           >
                                    <label for="active">Fixed deposit</label>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="transaction_remarks">Remarks</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="4" id="transaction_remarks" class="form-control no-resize" name="form_remarks" placeholder="Type your remarks..."><?php echo isset($transaction) ? $transaction['remarks'] : null; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <p class="col-pink">* - Mandatory fields</p>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect" name="submit" value="submitted"><?php echo isset($transaction) ? 'UPDATE' : 'SUBMIT'; ?></button>
                        <?php if (isset($transaction)) { ?>
                            <button type="reset" class="btn btn-danger btn-lg m-l-15 waves-effect" onclick="window.history.back()">Cancel</button>
                        <?php } else { ?>
                            <button type="reset" class="btn bg-grey btn-lg m-l-15 waves-effect">RESET</button>
                        <?php } ?>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>