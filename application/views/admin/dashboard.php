<div class="block-header">
    <h2>DASHBOARD</h2>
</div>

<!-- Widgets -->
<div class="row clearfix">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="sccs" style="text-decoration: none;"><div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">group</i>
                </div>
                <div class="content">
                    <div class="text">SCC'S</div>
                    <div class="number count-to" data-from="0" data-to="<?php echo isset($dashboard_data) ? $dashboard_data['sccs'] : 0; ?>" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="families" style="text-decoration: none;">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">home</i>
                </div>
                <div class="content">
                    <div class="text">FAMILIES</div>
                    <div class="number count-to" data-from="0" data-to="<?php echo isset($dashboard_data) ? $dashboard_data['families'] : 0; ?>" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
       <a href="members" style="text-decoration: none;">
           <div class="info-box bg-orange hover-expand-effect">
            <div class="icon">
                <i class="material-icons">person</i>
            </div>
            <div class="content">
                <div class="text">MEMBERS</div>
                <div class="number count-to" data-from="0" data-to="<?php echo isset($dashboard_data) ? $dashboard_data['members'] : 0; ?>" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
       </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-light-green hover-expand-effect">
            <div class="icon">
                <i class="material-icons">all_inclusive</i>
            </div>
            <div class="content">
                <div class="text">CATECHISTS</div>
                <div class="number count-to" data-from="0" data-to="<?php echo isset($dashboard_data['catechists']) ? $dashboard_data['catechists'] : 0; ?>" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>

</div>
<!-- #END# Widgets -->