<?php
if (isset($institution)):
    $id = $this->myencrypt->encrypt_url($institution['minstitution_id']);
    ?>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a onclick="window.history.back()" class="btn btn-default">Back</a>
                    <h3 class="align-center"><?php echo $institution['name']; ?></h3>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="manageinstitution?id=<?php echo $this->myencrypt->encrypt_url($institution['tinstitution_id']); ?>&edit=true" class="btn btn-primary">Edit</a>
                            <a onclick="deleteInstitution()" class="btn btn-danger">Delete</a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="row">ID</th>
                                    <td>:  <?php echo $institution['tinstitution_id']; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Incharge</th>
                                    <td>: <?php echo $institution['incharge']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Type of institution</th>
                                    <td>: <?php echo $institution['institution_type_name']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Mobile</th>
                                    <td>: <?php echo $institution['contact1']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Res</th>
                                    <td>: <?php echo $institution['contact2']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Email 1</th>
                                    <td>: <?php echo $institution['email1']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Email 2</th>
                                    <td>: <?php echo $institution['email2']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Website</th>
                                    <td>: <?php echo $institution['website']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Address</th>
                                    <td>: <?php
                                        if (!empty($institution['addressline1'])) {
                                            echo $institution['addressline1'] . "<br>";
                                        }
                                        if (!empty($institution['addressline2'])) {
                                            echo $institution['addressline2'] . "<br>";
                                        }
                                        if (!empty($institution['city'])) {
                                            echo $institution['city'] . ", ";
                                        }
                                        if (!empty($institution['state_name'])) {
                                            echo $institution['state_name'] . "<br>";
                                        }
                                        if (!empty($institution['country_name'])) {
                                            echo $institution['country_name'];
                                        }
                                        if (!empty($institution['pincode'])) {
                                            echo " Pin:-" . $institution['pincode'];
                                        }
                                        ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Remarks</th>
                                    <td>: <?php echo $institution['remarks']; ?></td>
                                </tr>
<!--                                <tr>
                                    <th scope="row">Created at</th>
                                    <td>: <?php echo $institution['created_at']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Updated at</th>
                                    <td>: <?php echo $institution['updated_at']; ?></td>
                                </tr>-->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function deleteInstitution() {
            swal({
                title: "Delete institution?",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                window.location.replace("<?php echo base_url() . 'parish/manageinstitution?id=' . $this->myencrypt->encrypt_url($institution['tinstitution_id']) . '&delete=true'; ?>");
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
                            <h2>INSTITUTIONS</h2>
                        </div>
                        <div class="col-xs-12 col-sm-6 align-right">
                            <div class="switch panel-switch-btn">
                                <a href="manageinstitution" class="btn btn-primary waves-effect"><i class="material-icons">add</i><span>NEW</span></a>
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
                                if (isset($institutions)):
                                    $i = 1;
                                    foreach ($institutions as $institution) :
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><a href="<?php echo base_url() . 'parish/institutions?institution_id=' . $this->myencrypt->encrypt_url($institution->tinstitution_id) . '&view=true'; ?>"><?php echo $institution->name; ?></a></td>
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
               