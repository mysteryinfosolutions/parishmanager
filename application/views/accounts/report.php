<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php
        if (isset($report)) {
            $opening_balance = $report['opening_balance'];
            ?>

            <div class="card">
                <div class="header">
                    <h2>Report from <?php echo $report['from_date']; ?> to <?php echo $report['to_date']; ?><h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped dataTable js-exportable" data-page-length="100">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Particulars</th>
                                                <th>Cash Debit</th>
                                                <th>Cash Credit</th>
                                                <th>Bank Credit</th>
                                                <th>Bank Debit</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Date</th>
                                                <th>Particulars</th>
                                                <th>Cash Debit</th>
                                                <th>Cash Credit</th>
                                                <th>Bank Credit</th>
                                                <th>Bank Debit</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $opening_cash_balance = $opening_balance['cash_debit'] - $opening_balance['cash_credit'];
                                            $opening_bank_balance = $opening_balance['bank_credit'] - $opening_balance['bank_debit'];
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td><b>Opening Balance</b></td>
                                                <td align="right"><b><?php echo $opening_cash_balance; ?></b></td>
                                                <td align="right"></b></td>
                                                <td align="right"><b><?php echo $opening_bank_balance; ?></b></td>
                                                <td></td>
                                            </tr>
                                            <?php
                                            if (isset($report['report_data'])) {

                                                $report_data = $report['report_data'];
                                                $cash_debits = 0;
                                                $cash_credits = 0;
                                                $bank_debits = 0;
                                                $bank_credits = 0;
                                                foreach ($report_data as $row) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row->date; ?></td>
                                                        <td><?php echo $row->particular; ?></td>
                                                        <td align="right"><?php
                                                            if (isset($row->cash_debit)) {
                                                                echo $row->cash_debit;
                                                                $cash_debits = $cash_debits + $row->cash_debit;
                                                            }
                                                            ?></td>
                                                        <td align="right"><?php
                                                            if (isset($row->cash_credit)) {
                                                                echo $row->cash_credit;
                                                                $cash_credits = $cash_credits + $row->cash_credit;
                                                            }
                                                            ?></td>
                                                        <td align="right"><?php
                                                            if (isset($row->bank_credit)) {
                                                                echo $row->bank_credit;
                                                                $bank_credits = $bank_credits + $row->bank_credit;
                                                            }
                                                            ?></td>
                                                        <td align="right"><?php
                                                            if (isset($row->bank_debit)) {
                                                                echo $row->bank_debit;
                                                                $bank_debits = $bank_debits + $row->bank_debit;
                                                            }
                                                            ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                <tr>
                                                    <td><b>Amount Total</b></td>
                                                    <td></td>
                                                    <td align="right"><b><?php echo $cash_debits; ?></b></td>
                                                    <td align="right"><b><?php echo $cash_credits; ?></b></td>
                                                    <td align="right"><b><?php echo $bank_credits; ?></b></td>
                                                    <td align="right"><b><?php echo $bank_debits; ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Balance</b></td>
                                                    <td></td>
                                                    <td align="right"><b><?php echo $cash_debits - $cash_credits + $opening_cash_balance; ?></b></td>
                                                    <td align="right"></td>
                                                    <td align="right"><b><?php echo $bank_credits - $bank_debits + $opening_bank_balance; ?></b></td>
                                                    <td align="right"></td>
                                                </tr>
                                                <?php
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="5">Sorry,  no record found</td>
                                                </tr><?php }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                        <?php
                        } else if (isset($summarized_report)) {
                            $opening_balance = $summarized_report['opening_balance'];
                            ?>

                            <div class="card">
                                <div class="header">
                                    <h2>Report from <?php echo $summarized_report['from_date']; ?> to <?php echo $summarized_report['to_date']; ?><h2>
                                            </div>
                                            <div class="body">
                                                <div class="table-responsive">
                                                    <table id="example" class="table table-bordered table-striped" data-page-length="100">
                                                        <thead>
                                                            <tr>
                                                                <th>Particulars</th>
                                                                <th>Cash Debit</th>
                                                                <th>Cash Credit</th>
                                                                <th>Bank Credit</th>
                                                                <th>Bank Debit</th>
                                                            </tr>
                                                        </thead>
                                                        <tfoot>
                                                            <tr>
                                                                <th>Particulars</th>
                                                                <th>Cash Debit</th>
                                                                <th>Cash Credit</th>
                                                                <th>Bank Credit</th>
                                                                <th>Bank Debit</th>
                                                            </tr>
                                                        </tfoot>
                                                        <tbody>
                                                            <?php
                                                            $opening_cash_balance = $opening_balance['cash_debit'] - $opening_balance['cash_credit'];
                                                            $opening_bank_balance = $opening_balance['bank_credit'] - $opening_balance['bank_debit'];
                                                            ?>
                                                            <tr>
                                                                <td><b> Opening Balance</b></td>
                                                                <td align="right"><b><?php echo $opening_cash_balance; ?></b></td>
                                                                <td align="right"></b></td>
                                                                <td align="right"><b><?php echo $opening_bank_balance; ?></b></td>
                                                                <td></td>
                                                            </tr>
                                                            <?php
                                                            if (isset($summarized_report['report_data'])) {

                                                                $summarized_report_data = $summarized_report['report_data'];
                                                                $cash_debits = 0;
                                                                $cash_credits = 0;
                                                                $bank_debits = 0;
                                                                $bank_credits = 0;
                                                                foreach ($summarized_report_data as $row) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $row->particular; ?></td>
                                                                        <td align="right"><?php
                                                                            if (!empty($row->cash_debit)) {
                                                                                echo $row->cash_debit;
                                                                                $cash_debits = $cash_debits + $row->cash_debit;
                                                                            }
                                                                            ?></td>
                                                                        <td align="right"><?php
                                                                            if (!empty($row->cash_credit)) {
                                                                                echo $row->cash_credit;
                                                                                $cash_credits = $cash_credits + $row->cash_credit;
                                                                            }
                                                                            ?></td>
                                                                        <td align="right"><?php
                                                                            if (!empty($row->bank_credit)) {
                                                                                echo $row->bank_credit;
                                                                                $bank_credits = $bank_credits + $row->bank_credit;
                                                                            }
                                                                            ?></td>
                                                                        <td align="right"><?php
                                                                            if (!empty($row->bank_debit)) {
                                                                                echo $row->bank_debit;
                                                                                $bank_debits = $bank_debits + $row->bank_debit;
                                                                            }
                                                                            ?></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <td><b>Amount Total</b></td>
                                                                    <td align="right"><b><?php echo $cash_debits; ?></b></td>
                                                                    <td align="right"><b><?php echo $cash_credits; ?></b></td>
                                                                    <td align="right"><b><?php echo $bank_credits; ?></b></td>
                                                                    <td align="right"><b><?php echo $bank_debits; ?></b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Balance</b></td>
                                                                    <td align="right"><b><?php echo $cash_debits - $cash_credits + $opening_cash_balance; ?></b></td>
                                                                    <td align="right"></td>
                                                                    <td align="right"><b><?php echo $bank_credits - $bank_debits + $opening_bank_balance; ?></b></td>
                                                                    <td align="right"></td>
                                                                </tr>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <tr>
                                                                    <td colspan="5">Sorry,  no record found</td>
                                                                </tr><?php }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="card">
                                                <div class="header">
                                                    <h2>REPORT</h2>
                                                </div>
                                                <div class="body">
                                                    <?php
                                                    $attributes = array('id' => 'form_advanced_validation',
                                                        'class' => 'form-horizontal');
                                                    echo form_open('accounts/report', $attributes);
                                                    ?>
                                                    <div class="row clearfix">
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 form-control-label">
                                                            <label for="df">From date *</label>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-7">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" name="form_from_date" id="df" class="datepicker form-control" placeholder="Choose a date..." value="<?php echo isset($financialyear['start_date']) ? $financialyear['start_date'] : date('Y-04-01'); ?>" required/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 form-control-label">
                                                            <label for="dt">To date *</label>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-7">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" name="form_to_date" id="dt" class="datepicker form-control" placeholder="Choose a date..." value="<?php echo isset($financialyear['start_date']) ? $financialyear['end_date'] : date('Y-04-01'); ?>" required/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row clearfix">
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 form-control-label">
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-7">
                                                            <div class="form-group">
                                                                <input type="checkbox" id="basic_checkbox_2" class="filled-in chk-col-indigo" name="form_summarized" value="1">
                                                                <label for="basic_checkbox_2">Summarize report</label>
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
                                                            <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect" name="submit" value="submitted">SUBMIT</button>
                                                            <button type="reset" class="btn bg-grey btn-lg m-l-15 waves-effect">RESET</button>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
<?php } ?>
                                        </div>
                                        </div>