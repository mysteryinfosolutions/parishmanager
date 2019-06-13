<?php
if (isset($scc)):
    $id = $this->myencrypt->encrypt_url($scc['mscc_id']);
    ?>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a onclick="window.history.back()" class="btn btn-default">Back</a>
                    <h3 class="align-center"><?php echo $scc['name']; ?></h3>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="managescc?id=<?php echo $this->myencrypt->encrypt_url($scc['mscc_id']); ?>&edit=true" class="btn btn-primary">Edit</a>
                            <a onclick="deleteScc()" class="btn btn-danger">Delete</a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="header">
                        <h2>
                            SCC Details
                        </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="row">ID</th>
                                    <td>: <?php echo $scc['mscc_id']; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Sakha</th>
                                    <td>: <?php echo $scc['sakha']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">No. of families</th>
                                    <td>: <?php echo isset($families) ? count($families) : 0; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Remarks</th>
                                    <td>: <?php echo $scc['remarks']; ?></td>
                                </tr>
<!--                                <tr>
                                    <th scope="row">Created at</th>
                                    <td>: <?php echo $scc['created_at']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Updated at</th>
                                    <td>: <?php echo $scc['updated_at']; ?></td>
                                </tr>-->
                            </tbody>
                        </table>
                    </div>
                    <div class="header">
                        <h2>
                            SCC Leaders
                        </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>NAME</th>
                                    <th>CONTACT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">PRESIDENT</th>
                                    <td><?php echo $scc['president']; ?></td>
                                    <td><?php echo $scc['president_contact']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">SECRETARY</th>
                                    <td><?php echo $scc['secretary']; ?></td>
                                    <td><?php echo $scc['secretary_contact']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">TREASURER</th>
                                    <td><?php echo $scc['treasurer']; ?></td>
                                    <td><?php echo $scc['treasurer_contact']; ?></td>
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
                        Families
                    </h2>  
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="managefamily?scc_id=<?php echo $this->myencrypt->encrypt_url($scc['mscc_id']); ?>&add_family=true" class="btn btn-primary">Add Family</a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NAME</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($families)):
                                    if (count($families) > 0):
                                        $i = 1;
                                        foreach ($families as $family) :
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><a href="<?php echo base_url() . 'parish/families?family_id=' . $this->myencrypt->encrypt_url($family->mfamily_id) . '&view=true'; ?>"><?php echo $family->firstname . " " . $family->lastname; ?></a></td>
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
                            <a href="managedonation?mscc_id=<?php echo $this->myencrypt->encrypt_url($scc['mscc_id']); ?>&add_donation=true" class="btn btn-primary">+ New Donation</a>
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
        function deleteScc() {
            swal({
                title: "Delete scc?",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                window.location.replace("<?php echo base_url() . 'parish/managescc?id=' . $this->myencrypt->encrypt_url($scc['mscc_id']) . '&delete=true'; ?>");
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
                            <h2>SCCS</h2>
                        </div>
                        <div class="col-xs-12 col-sm-6 align-right">
                            <div class="switch panel-switch-btn">
                                <a href="managescc" class="btn btn-primary waves-effect"><i class="material-icons">add</i><span>NEW</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable" data-page-length="50">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($sccs)):
                                    $i = 1;
                                    foreach ($sccs as $scc) :
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><a href="<?php echo base_url() . 'parish/sccs?scc_id=' . $this->myencrypt->encrypt_url($scc->mscc_id) . '&view=true'; ?>"><?php echo $scc->name; ?></a></td>
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
               