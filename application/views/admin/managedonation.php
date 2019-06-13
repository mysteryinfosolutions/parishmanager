<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <a onclick="window.history.back()" class="btn btn-default">Back</a>
                <h3 class="align-center">MANAGE DONATIONS</h3>
            </div>
            <div class = "body">
                <?php
                $attributes = array('id' => 'form_advanced_validation',
                    'class' => 'form-horizontal');
                echo form_open('admin/managedonation', $attributes);
                ?>
                <!--<input type="hidden" name="mledger_id" value="<?php echo isset($donation) ? $this->myencrypt->encrypt_url($donation['mledger_id']) : $this->myencrypt->encrypt_url('16'); ?>">-->
                <input type="hidden" name="edit_id" value="<?php echo isset($donation) ? $this->myencrypt->encrypt_url($donation['ttransaction_id']) : null; ?>">
                <input type="hidden" name="form_mparish_id" value="<?php echo isset($donation) ? $this->myencrypt->encrypt_url($donation['mparish_id']) : $this->myencrypt->encrypt_url($parishdetails['mparish_id']); ?>">
                <?php
                if (isset($mscc_id)) {
                    ?>
                    <input type="hidden" name="form_mscc_id" value="<?php echo $this->myencrypt->encrypt_url($mscc_id); ?>">
                    <?php
                }
                if (isset($mfamily_id)) {
                    ?>
                    <input type="hidden" name="form_mfamily_id" value="<?php echo $this->myencrypt->encrypt_url($mfamily_id); ?>">
                    <?php
                }
                ?>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="date">Date</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_date" id="start_date" class="datepicker form-control" placeholder="Choose a date..." value="<?php echo isset($donation) ? $donation['date'] : date("Y-m-d"); ?>" required/>
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
                                echo isset($donation) ? $donation['cash_debit'] : null;
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
                                <select name="form_tledger_id" id="ledger_id" class="form-control show-tick" required="">
                                    <option value="">Nothing selected</option>
                                    <?php
                                    if (isset($ledgers)):
                                        foreach ($ledgers as $ledger) :
                                            ?>
                                            <option value="<?php echo $this->myencrypt->encrypt_url($ledger->tledger_id); ?>" <?php
                                            if (isset($donation)) {
                                                if ($donation['tledger_id'] === $ledger->tledger_id) {
                                                    ?> selected="true"<?php
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