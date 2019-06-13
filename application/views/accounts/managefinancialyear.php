<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <a onclick="window.history.back()" class="btn btn-default">Back</a>
                <h3>MANAGE FINANCIAL YEARS</h3>
            </div>
            <div class="body">
            <div class="body">
                <?php
                $attributes = array('id' => 'form_advanced_validation',
                    'class' => 'form-horizontal');
                echo form_open('accounts/managefinancialyear', $attributes);
                ?>
                <input type="hidden" name="edit_id" value="<?php echo isset($financialyear) ? $this->myencrypt->encrypt_url($financialyear['mfinancialyear_id']) : null; ?>">
                <input type="hidden" name="form_mparish_id" value="<?php echo isset($financialyear) ? $this->myencrypt->encrypt_url($financialyear['mparish_id']) : $this->myencrypt->encrypt_url($parishdetails['mparish_id']); ?>">
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="financialyear_name">Yearset *</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_yearset" id="financialyear_name" class="form-control show-tick" value="<?php echo isset($financialyear) ? $financialyear['yearset'] : date("Y") . " - " . date("Y", strtotime('+1 years')); ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="start_date">Start date *</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_start_date" id="start_date" class="datepicker form-control" placeholder="Choose a date..." value="<?php echo isset($financialyear) ? $financialyear['start_date'] : date("Y-04-01"); ?>" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="end_date">End date *</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_end_date" id="end_date" value="<?php echo isset($financialyear) ? $financialyear['end_date'] : date("Y-03-31", strtotime('+1 years')); ?>" placeholder="Choose a date..." class="datepicker form-control" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="rprefix">Receipt Prefix </label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_receipt_prefix" id="rprefix" class="form-control" value="<?php echo isset($financialyear) ? $financialyear['receipt_prefix'] : "R/"; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="rsuffix">Receipt Suffix </label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_receipt_suffix" id="rsuffix" class="form-control" value="<?php echo isset($financialyear) ? $financialyear['receipt_suffix'] : "/" . date("Y") . "-" . date("y", strtotime('+1 years')); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="pprefix">Payment prefix</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_payment_prefix" id="pprefix" class="form-control" value="<?php echo isset($financialyear) ? $financialyear['payment_prefix'] : "P/"; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="psuffix">Payment suffix</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_payment_suffix" id="psuffix" class="form-control" value="<?php echo isset($financialyear) ? $financialyear['payment_suffix'] : "/" . date("Y") . "-" . date("y", strtotime('+1 years')); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="financialyear_remarks">Remarks</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="4" id="financialyear_remarks" class="form-control no-resize" name="form_remarks" placeholder="Type your remarks..."><?php echo isset($financialyear) ? $financialyear['remarks'] : null; ?></textarea>
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
                        <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect" name="submit" value="submitted"><?php echo isset($financialyear) ? 'UPDATE' : 'SUBMIT'; ?></button>
                        <?php if (isset($financialyear)) { ?>
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
</div>