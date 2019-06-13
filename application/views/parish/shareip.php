<div class="block-header">
    <h2>Share IP</h2>
</div>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h3 class="align-center">Access from multiple client Devices</h3>
            </div>
            <div class="body">
                <?php
                if (isset($network_access)) {
                    if ($network_access) {
                        ?>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>1) Open any web browser in the client device.</td>
                                    </tr>
                                    <tr>
                                        <td>2) Type the following on the address bar and press enter:</td>
                                    </tr>
                                    <tr>
                                        <th><?php 
//                                        echo $server_ip;
//                                        if(isset($server_port)){
//                                            echo ":".$server_port;
//                                        }
//                                        echo base_url();
                                        echo str_replace("localhost",$server_ip,base_url())
                                        ?></th>
                                    </tr>
                                    <tr>
                                        <td style="color: red">Note: All devices must be on the same network as that of server.</td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <div class="align-center" id="content">
                                <p>Not connected to network. Connect to a network and try refreshing the page.</p>
                                <a onclick="location.reload()" class="btn btn-primary btn-lg waves-effect">REFRESH</a>
                            </div>
                        <?php } ?>
                    </div>  
                    <?php
                }
                ?>

            </div>
        </div>
    </div>
</div>
