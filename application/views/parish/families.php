<?php
if (isset($family)):
    $id = $this->myencrypt->encrypt_url($family['mfamily_id']);
    ?>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a onclick="window.history.back()" class="btn btn-default">Back</a>
                    <h3 class="align-center"><?php echo $family['firstname'] . " " . $family['lastname']; ?></h3>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="managefamily?id=<?php echo $this->myencrypt->encrypt_url($family['mfamily_id']); ?>&edit=true" class="btn btn-primary">Edit</a>
                            <a onclick="deleteFamily()" class="btn btn-danger">Delete</a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="row">ID</th>
                                    <td>:  <?php echo $family['mfamily_id']; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Address</th>
                                    <td>: <?php
                                        if (!empty($family['addressline1'])) {
                                            echo $family['addressline1'] . "<br>";
                                        }
                                        if (!empty($family['addressline2'])) {
                                            echo $family['addressline2'] . "<br>";
                                        }
                                        if (!empty($family['city'])) {
                                            echo $family['city'] . ", ";
                                        }
                                        if (!empty($family['state_name'])) {
                                            echo $family['state_name'] . "<br>";
                                        }
                                        if (!empty($family['country_name'])) {
                                            echo $family['country_name'];
                                        }
                                        if (!empty($family['pincode'])) {
                                            echo " Pin:-" . $family['pincode'];
                                        }
                                        ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">SCC</th>
                                    <td>: <a href="sccs?scc_id=<?php echo $this->myencrypt->encrypt_url($family['mscc_id']) ?>&view=true"><?php echo $family['scc_name']; ?></a></td>
                                </tr>
                                <tr>
                                    <th scope="row">No. of members</th>
                                    <td>: <?php echo isset($members) ? count($members) : 0; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Remarks</th>
                                    <td>: <?php echo $family['remarks']; ?></td>
                                </tr>
<!--                                <tr>
                                    <th scope="row">Created at</th>
                                    <td>: <?php echo $family['created_at']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Updated at</th>
                                    <td>: <?php echo $family['updated_at']; ?></td>
                                </tr>-->
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
                        Members
                    </h2>  
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="managemember?scc_id=<?php echo $this->myencrypt->encrypt_url($family['mscc_id']); ?>&family_id=<?php echo $this->myencrypt->encrypt_url($family['mfamily_id']); ?>&add_member=true" class="btn btn-primary">Add Member</a>
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
                                if (isset($members)):
                                    if (count($members) > 0):
                                        $i = 1;
                                        foreach ($members as $member) :
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><a href="<?php echo base_url() . 'parish/members?member_id=' . $this->myencrypt->encrypt_url($member->mmember_id) . '&view=true'; ?>"><?php echo $member->firstname . " " . $member->lastname; ?></a></td>
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
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Contributions
                    </h2>  
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="managedonation?mfamily_id=<?php echo $this->myencrypt->encrypt_url($family['mfamily_id']); ?>&add_donation=true" class="btn btn-primary">+ New Donation</a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>DATE</th>
                                    <th>PARTICULAR</th>
                                    <th>AMOUNT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($donations)):
                                    if (count($donations) > 0):
                                        foreach ($donations as $donation) :
                                            ?>
                                            <tr>
                                                <td><?php echo $donation->date; ?></td>
                                                <td><a href="<?php echo base_url() . 'parish/donations?id=' . $this->myencrypt->encrypt_url($donation->ttransaction_id) . '&view=true'; ?>"><?php echo $donation->particular; ?></a></td>
                                                <td><?php echo $donation->cash_debit; ?></td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    else:
                                        ?>
                                        <tr>
                                            <td colspan="3">No records found.</td>
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

    <script>
        function deleteFamily() {
            swal({
                title: "Delete family?",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                window.location.replace("<?php echo base_url() . 'parish/managefamily?id=' . $this->myencrypt->encrypt_url($family['mfamily_id']) . '&delete=true'; ?>");
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
                            <h2>FAMILIES</h2>
                        </div>
                        <div class="col-xs-12 col-sm-6 align-right">
                            <div class="switch panel-switch-btn">
                                <a href="managefamily" class="btn btn-primary waves-effect"><i class="material-icons">add</i><span>NEW</span></a>
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($families)):
                                    $i = 1;
                                    foreach ($families as $family) :
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><a href="<?php echo base_url() . 'parish/families?family_id=' . $this->myencrypt->encrypt_url($family->mfamily_id) . '&view=true'; ?>"><?php echo $family->firstname . " " . $family->lastname; ?></a></td>
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
               