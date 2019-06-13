<?php
if (isset($register)):
    $id = $this->myencrypt->encrypt_url($register['tevent_id']);
    ?>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a onclick="window.history.back()" class="btn btn-default">Back</a>
                    <h3 class="align-center"><?php echo $register['mevent_name'] . ' register'; ?></h3>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="manageregister?tevent_id=<?php echo $this->myencrypt->encrypt_url($register['tevent_id']); ?>&mevent_id=<?php echo $this->myencrypt->encrypt_url($register['mevent_id']); ?>&edit=true" class="btn btn-primary">Edit</a>
                            <a href="printcertificate?tevent_id=<?php echo $this->myencrypt->encrypt_url($register['tevent_id']); ?>&mevent_id=<?php echo $this->myencrypt->encrypt_url($register['mevent_id']); ?>&print=true" class="btn btn-warning">Print</a>
                            <a onclick="deleteRegister('<?php echo $this->myencrypt->encrypt_url($register['tevent_id']); ?>', '<?php echo $register['mevent_name']; ?>', '<?php echo $this->myencrypt->encrypt_url($register['mevent_id']); ?>')" class="btn btn-danger">Delete</a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="row">Reg. No.</th>
                                    <td>:  <?php echo $register['register_no']; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($register['mevent_id'] === '4') {
                                    ?>
                                    <tr>
                                        <th scope="row">Bride</th>
                                        <td>: <a href="<?php echo base_url() . 'parish/members?member_id=' . $this->myencrypt->encrypt_url($register['mbride_id']) . '&view=true'; ?>"><?php echo $register['bride_firstname'] . " " . $register['bride_lastname']; ?></a></td>
                                    </tr> 
                                    <tr>
                                        <th scope="row">Groom</th>
                                        <td>: <a href="<?php echo base_url() . 'parish/members?member_id=' . $this->myencrypt->encrypt_url($register['mgroom_id']) . '&view=true'; ?>"><?php echo $register['groom_firstname'] . " " . $register['groom_lastname']; ?></a></td>

                                    </tr>
                                    <?php
                                } else {
                                    ?>
                                    <tr>
                                        <th scope="row">Member</th>
                                        <td>: <a href="<?php echo base_url() . 'parish/members?member_id=' . $this->myencrypt->encrypt_url($register['mmember_id']) . '&view=true'; ?>"><?php echo $register['member_firstname'] . " " . $register['member_lastname']; ?></a></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr>
                                    <th scope="row">Date</th>
                                    <td>: <?php echo $register['date']; ?></td>
                                </tr>
                                <?php if ($register['mevent_id'] === '6') {
                                    ?>
                                    <tr>
                                        <th scope="row">Funeral Date</th>
                                        <td>: <?php echo $register['funeral_date']; ?></td>
                                    </tr>
                                <?php }
                                ?>
                                <?php
                                if ($register['mevent_id'] === '1' || $register['mevent_id'] === '3') {
                                    if ($register['mevent_id'] === '1') {
                                        ?>
                                        <tr>
                                            <th scope="row">Baptismal name</th>
                                            <td>: <?php echo $register['baptismal_name']; ?></td>
                                        </tr>
                                    <?php } ?>

                                    <tr>
                                        <th scope="row">Godfather</th>
                                        <td>: <?php echo $register['godfather']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Godmother</th>
                                        <td>: <?php echo $register['godmother']; ?></td>
                                    </tr>
                                <?php } ?>
                                <?php if ($register['mevent_id'] === '4') {
                                    ?>
                                    <tr>
                                        <th scope="row">Witness 1</th>
                                        <td>: <?php echo $register['witness1']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Witness 2</th>
                                        <td>: <?php echo $register['witness2']; ?></td>
                                    </tr>
                                <?php }
                                ?>
                                <tr>
                                    <th scope="row">Minister</th>
                                    <td>: <?php echo $register['minister']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Place</th>
                                    <td>: <?php echo $register['place']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Parish</th>
                                    <td>: <?php echo $register['venueparish_name'] . ', ' . $register['venueparish_city']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Remarks</th>
                                    <td>: <?php echo $register['remarks']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteRegister(id, register, mevent_id) {
            swal({
                title: "Delete " + register + " register?",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                window.location.replace("<?php echo base_url() . 'parish/manageregister?tevent_id='; ?>" + id + "<?php echo '&mevent_id='; ?>" + mevent_id + "&delete=true");
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
                            <h2><?php
                                if (isset($mevent_data)) {
                                    echo strtoupper($mevent_data['name']);
                                }
                                ?> REGISTERS</h2>
                        </div>
                        <div class="col-xs-12 col-sm-6 align-right">
                            <div class="switch panel-switch-btn">
                                <a href="manageregister?mevent_id=<?php
                                if (isset($mevent_data)) {
                                    echo $this->myencrypt->encrypt_url($mevent_data['id']);
                                }
                                ?>&add_register=true" class="btn btn-primary waves-effect"><i class="material-icons">add</i><span>NEW</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <?php
                        if ($mevent_data['id'] === '4') {
                            ?>
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" data-page-length="100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Bride</th>
                                        <th>Groom</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($registers)):
                                        $i = 1;
                                        foreach ($registers as $register) :
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><a href="<?php echo base_url() . 'parish/members?member_id=' . $this->myencrypt->encrypt_url($register->mbride_id) . '&view=true'; ?>"><?php echo $register->bride_firstname . " " . $register->bride_lastname; ?></a></td>
                                                <td><a href="<?php echo base_url() . 'parish/members?member_id=' . $this->myencrypt->encrypt_url($register->mgroom_id) . '&view=true'; ?>"><?php echo $register->groom_firstname . " " . $register->groom_lastname; ?></a></td>
                                                <td><a href="<?php echo base_url() . 'parish/registers?tevent_id=' . $this->myencrypt->encrypt_url($register->tevent_id) . '&view=true&mevent_id=' . $this->myencrypt->encrypt_url($register->mevent_id); ?>" class="btn btn-primary">View</a></td>

                                            </tr>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </tbody>
                            </table>
                        <?php }else {
                            ?>
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" data-page-length="100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($registers)):
                                        $i = 1;
                                        foreach ($registers as $register) :
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><a href="<?php echo base_url() . 'parish/registers?tevent_id=' . $this->myencrypt->encrypt_url($register->tevent_id) . '&view=true&mevent_id=' . $this->myencrypt->encrypt_url($register->mevent_id); ?>"><?php echo $register->member_firstname . " " . $register->member_lastname; ?></a></td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
endif;
?>
               