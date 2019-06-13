<?php
if (isset($association)):
    $id = $this->myencrypt->encrypt_url($association['tassociation_id']);
    ?>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a onclick="window.history.back()" class="btn btn-default">Back</a>
                    <h3 class="align-center"><?php echo $association['association_name']; ?></h3>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="manageassociation?tassociation_id=<?php echo $this->myencrypt->encrypt_url($association['tassociation_id']); ?>&massociation_id=<?php echo $this->myencrypt->encrypt_url($association['massociation_id']); ?>&edit=true" class="btn btn-primary">Edit</a>
                            <!--<a href="printcertificate?tassociation_id=<?php echo $this->myencrypt->encrypt_url($association['tassociation_id']); ?>&massociation_id=<?php echo $this->myencrypt->encrypt_url($association['massociation_id']); ?>&print=true" class="btn btn-warning">Print</a>-->
                            <a onclick="deleteRegister('<?php echo $this->myencrypt->encrypt_url($association['tassociation_id']); ?>', '<?php echo $association['association_name']; ?>', '<?php echo $this->myencrypt->encrypt_url($association['massociation_id']); ?>')" class="btn btn-danger">Delete</a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="row">Yearset</th>
                                    <td>:  <?php echo $association['name']; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">From Date</th>
                                    <td>: <?php echo $association['from_date']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">To Date</th>
                                    <td>: <?php echo $association['to_date']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">President</th>
                                    <td>: <?php echo $association['president']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Vice President</th>
                                    <td>: <?php echo $association['vicepresident']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Secretary</th>
                                    <td>: <?php echo $association['secretary']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Joint Secretary</th>
                                    <td>: <?php echo $association['jointsecretary']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Treasurer</th>
                                    <td>: <?php echo $association['treasurer']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Remarks</th>
                                    <td>: <?php echo $association['remarks']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Association Committee Members
                    </h2>  
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="manageassociationmembers?tassociation_id=<?php echo $this->myencrypt->encrypt_url($association['tassociation_id']); ?>&massociation_id=<?php echo $this->myencrypt->encrypt_url($association['massociation_id']); ?>&add_member=true" class="btn btn-primary">Manage Committee Members</a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NAME</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($committee_members)):
                                    if (count($committee_members) > 0):
                                        $i = 1;
                                        foreach ($committee_members as $committee_member) :
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $committee_member->name; ?></td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    else:
                                        ?>
                                        <tr>
                                            <td colspan="2">No records found.</td>
                                        </tr>
                                    <?php
                                    endif;
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($members)): ?>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6">
                                <h2>Members</h2>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($members)):
                                        $i = 1;
                                        foreach ($members as $member) :
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $member->firstname . " " . $member->lastname; ?></a></td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <script>
        function deleteRegister(id, association, massociation_id) {
            swal({
                title: "Delete " + association + " association?",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                window.location.replace("<?php echo base_url() . 'parish/manageassociation?tassociation_id='; ?>" + id + "<?php echo '&massociation_id='; ?>" + massociation_id + "&delete=true");
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
                                if (isset($massociation_data)) {
                                    echo strtoupper($massociation_data['abbreviation']);
                                }
                                ?></h2>
                            <?php
                            if (isset($massociation_data)) {
                                ?><small>(<?php echo $massociation_data['name']; ?></small>)<?php
                                }
                                ?>

                        </div>
                        <div class="col-xs-12 col-sm-6 align-right">
                            <div class="switch panel-switch-btn">
                                <a href="manageassociation?massociation_id=<?php
                                if (isset($massociation_data)) {
                                    echo $this->myencrypt->encrypt_url($massociation_data['id']);
                                }
                                ?>&add_association=true" class="btn btn-primary waves-effect"><i class="material-icons">add</i><span>NEW</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable" data-page-length="100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>From</th>
                                    <th>To</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($associations)):
                                    $i = 1;
                                    foreach ($associations as $association) :
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><a href="<?php echo base_url() . 'parish/associations?tassociation_id=' . $this->myencrypt->encrypt_url($association->tassociation_id) . '&view=true&massociation_id=' . $this->myencrypt->encrypt_url($association->massociation_id); ?>"><?php echo $association->name; ?></a></td>
                                            <td><?php echo $association->from_date; ?></td>
                                            <td><?php echo $association->to_date; ?></td>
                                        </tr>
                                        <?php
                                    endforeach;
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
endif;
?>
               