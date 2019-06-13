<?php
if (isset($profile_data)):
    $parish_data = $profile_data['parish_data'];
    if (isset($profile_data['logins'])) {
        $logins = $profile_data['logins'];
    }
     if (isset($profile_data['recentlogins'])) {
        $recentlogins = $profile_data['recentlogins'];
    }
    ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                        <li role="presentation" class="active"><a href="#profile" data-toggle="tab" aria-expanded="true">PROFILE</a></li>
                        <li role="presentation"><a href="#logins" data-toggle="tab">LOGINS</a></li>
                        <?php
                        if (isset($parish_data)):
                            ?> <li role="presentation"><a href="#info" data-toggle="tab">INFO</a></li>
                                <?php
                            endif;
                            ?>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="profile">
                            <div class="body table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="row">ID</th>
                                            <td>:  <?php echo $parish_data['mparish_id']; ?></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Name</th>
                                            <td>:  <?php echo $parish_data['name']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Established In</th>
                                            <td>:  <?php echo $parish_data['established_in']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Diocese</th>
                                            <td>:  <?php echo $parish_data['diocese_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Deanary</th>
                                            <td>:  <?php echo $parish_data['deanary_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Contact 1</th>
                                            <td>:  <?php echo $parish_data['contact1']; ?></td>
                                        </tr>
                                        <?php if ($parish_data['contact2'] != "") { ?>
                                            <tr>
                                                <th scope="row">Contact 2</th>
                                                <td>:  <?php echo $parish_data['contact2']; ?></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td>:  <?php echo $parish_data['email1']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Address</th>
                                            <td>: <?php
                                                echo $parish_data['addressline1'] . ', ' . $parish_data['addressline2'] . '<br>' . $parish_data['city'] . '<br>' . $parish_data['state_name'] . ', ' . $parish_data['country_name'] . '<br>Pincode - ' . $parish_data['pincode'] . '.'
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Remarks</th>
                                            <td>: <?php echo $parish_data['remarks']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Status</th>
                                            <td>: <?php if ($parish_data['status'] == 0) { ?><span class="label label-danger">Inactive</span><?php } else { ?><span class="label label-success">Active</span><?php } ?></td>
                                        </tr>
<!--                                        <tr>
                                            <td colspan="2"><a href="<?php echo base_url() . 'admin/manageparish?id=' . $this->myencrypt->encrypt_url($parish_data['mparish_id']) . '&edit=true'; ?>" class="btn btn-primary btn-lg waves-effect btn-block">Edit</a>
                                            </td>-->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="logins">
                            <b>Logins</b>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" data-page-length="50">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($logins)):
                                            $i = 1;
                                            foreach ($logins as $login) :
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $login->name; ?></td>
                                                    <td><?php echo $login->username; ?></td>
                                                    <td><?php echo $this->encryption->decrypt($login->password); ?></td>
                                                    <td><a href="<?php echo base_url() . 'admin/managelogin?login_id=' . $this->myencrypt->encrypt_url($login->id) . '&edit=true'; ?>" class="btn btn-primary">Edit</a></td>
                                                </tr>
                                                <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <b>Recent Logins</b>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" data-page-length="50">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Timestamp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($recentlogins)):
                                            $i = 1;
                                            foreach ($recentlogins as $recentlogin) :
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $recentlogin->name; ?></td>
                                                    <td><?php echo $recentlogin->login_at; ?></td>
                                                </tr>
                                                <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                        if (isset($parish_data)):
                            ?>
                            <div role="tabpanel" class="tab-pane fade" id="info">
                                <b>Other details</b>
                                <div class="body table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="row">Created at</th>
                                                <td>: <?php echo $parish_data['created_at']; ?></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Updated at</th>
                                                <td>: <?php echo $parish_data['updated_at']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
endif;
?>
               