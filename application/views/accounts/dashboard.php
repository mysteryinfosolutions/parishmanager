<div class="block-header">
    <h2>DASHBOARD</h2>
</div>
<div class="row clearfix">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-pink hover-expand-effect">
            <div class="icon">
                <i class="material-icons">calendar_today</i>
            </div>
            <div class="content">
                <div class="text">FINANCIAL YEAR</div>
                <div class="number"><?php echo isset($financialyear) ? $financialyear['yearset'] : "---- - ----"; ?></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons">account_balance_wallet</i>
            </div>
            <div class="content">
                <div class="text">CASH BALANCE</div>
                <div class="number count-to" data-from="0" data-to="<?php echo isset($dashboard_data['cash_balance']) ? $dashboard_data['cash_balance'] : 0; ?>" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-light-green hover-expand-effect">
            <div class="icon">
                <i class="material-icons">account_balance</i>
            </div>
            <div class="content">
                <div class="text">BANK BALANCE</div>
                <div class="number count-to" data-from="0" data-to="<?php echo isset($dashboard_data['bank_balance']) ? $dashboard_data['bank_balance'] : 0; ?>" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-orange hover-expand-effect">
            <div class="icon">
                <i class="material-icons">compare_arrows</i>
            </div>
            <div class="content">
                <div class="text">FIXED DEPOSITS</div>
                <div class="number count-to" data-from="0" data-to="<?php echo isset($dashboard_data['fixed_deposits']) ? $dashboard_data['fixed_deposits'] : 0; ?>" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
</div>