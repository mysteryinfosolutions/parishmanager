<?php
if (isset($member)):
    $id = $this->myencrypt->encrypt_url($member['mmember_id']);
    ?>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a onclick="window.history.back()" class="btn btn-default">Back</a>
                    <h3 class="align-center"><?php echo $member['firstname'] . " " . $member['lastname']; ?><?php
                        if (!empty($member['death_flag'])) {
                            echo " (Late)";
                        }
                        ?></h3>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="managemember?id=<?php echo $this->myencrypt->encrypt_url($member['mmember_id']); ?>&edit=true" class="btn btn-primary">Edit</a>
                            <?php if (empty($member['status'])) { ?>
                                <a onclick="restoreMember('<?php echo $this->myencrypt->encrypt_url($member['mmember_id']); ?>')" class="btn btn-success">Restore</a>
                            <?php } else { ?>
                                <a onclick="deleteMember('<?php echo $this->myencrypt->encrypt_url($member['mmember_id']); ?>')" class="btn btn-danger">Delete</a>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="row">ID</th>
                                    <td>:  <?php echo $member['mmember_id']; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Gender</th>
                                    <td>: <?php echo $member['gender']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Date of Birth</th>
                                    <td>: <?php echo $member['dateofbirth']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Father</th>
                                    <td>: <?php echo $member['father']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Mother</th>
                                    <td>: <?php echo $member['mother']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Qualification</th>
                                    <td>: <?php echo $member['qualification']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Occupation</th>
                                    <td>: <?php echo $member['occupation']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Mobile</th>
                                    <td>: <?php echo $member['contact1']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Res</th>
                                    <td>: <?php echo $member['contact2']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Email</th>
                                    <td>: <?php echo $member['email1']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Address</th>
                                    <td>: <?php
                                        if (!empty($member['addressline1'])) {
                                            echo $member['addressline1'] . "<br>";
                                        }
                                        if (!empty($member['addressline2'])) {
                                            echo $member['addressline2'] . "<br>";
                                        }
                                        if (!empty($member['city'])) {
                                            echo $member['city'] . ", ";
                                        }
                                        if (!empty($member['state_name'])) {
                                            echo $member['state_name'] . "<br>";
                                        }
                                        if (!empty($member['country_name'])) {
                                            echo $member['country_name'];
                                        }
                                        if (!empty($member['pincode'])) {
                                            echo " Pin:-" . $member['pincode'];
                                        }
                                        ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Family</th>
                                    <td>: <a href="families?family_id=<?php echo $this->myencrypt->encrypt_url($member['mfamily_id']) ?>&view=true"><?php echo $member['family_firstname'] . " " . $member['family_lastname']; ?></a></td>
                                </tr>
                                <tr>
                                    <th scope="row">SCC</th>
                                    <td>: <a href="sccs?scc_id=<?php echo $this->myencrypt->encrypt_url($member['mscc_id']) ?>&view=true"><?php echo $member['scc_name']; ?></a></td>
                                </tr>
                                <tr>
                                    <th scope="row">Remarks</th>
                                    <td>: <?php echo $member['remarks']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Created at</th>
                                    <td>: <?php echo $member['created_at']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Updated at</th>
                                    <td>: <?php echo $member['updated_at']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($baptism_details)) {
        ?>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Baptism details
                        </h2> 
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="manageregister?tevent_id=<?php echo $this->myencrypt->encrypt_url($baptism_details['tevent_id']); ?>&mevent_id=<?php echo $this->myencrypt->encrypt_url($baptism_details['mevent_id']); ?>&edit=true" class="btn btn-primary">Edit</a>
                                <a href="printcertificate?tevent_id=<?php echo $this->myencrypt->encrypt_url($baptism_details['tevent_id']); ?>&mevent_id=<?php echo $this->myencrypt->encrypt_url($baptism_details['mevent_id']); ?>&print=true" class="btn btn-warning">Print</a>
                                <a onclick="deleteRegister('<?php echo $this->myencrypt->encrypt_url($baptism_details['tevent_id']); ?>', 'baptism', '<?php echo $this->myencrypt->encrypt_url($baptism_details['mevent_id']); ?>')" class="btn btn-danger">Delete</a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="row">Reg. No.</th>
                                        <td>:  <?php echo $baptism_details['register_no']; ?></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Baptismal name</th>
                                        <td>: <?php echo $baptism_details['baptismal_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Date</th>
                                        <td>: <?php echo $baptism_details['date']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Godfather</th>
                                        <td>: <?php echo $baptism_details['godfather']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Godmother</th>
                                        <td>: <?php echo $baptism_details['godmother']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Minister</th>
                                        <td>: <?php echo $baptism_details['minister']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Place</th>
                                        <td>: <?php echo $baptism_details['place']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Parish</th>
                                        <td>: <?php echo $baptism_details['venueparish_name'] . ', ' . $baptism_details['venueparish_city']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Remarks</th>
                                        <td>: <?php echo $baptism_details['remarks']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Baptism details
                        </h2>  
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="manageregister?mevent_id=<?php echo $this->myencrypt->encrypt_url('1'); ?>&mid=<?php echo $this->myencrypt->encrypt_url($member['mmember_id']); ?>&add_register=true" class="btn btn-primary">Add</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    if (isset($communion_details)) {
        ?>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Communion details
                        </h2> 
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="manageregister?tevent_id=<?php echo $this->myencrypt->encrypt_url($communion_details['tevent_id']); ?>&mevent_id=<?php echo $this->myencrypt->encrypt_url($communion_details['mevent_id']); ?>&edit=true" class="btn btn-primary">Edit</a>
                                <a href="printcertificate?tevent_id=<?php echo $this->myencrypt->encrypt_url($communion_details['tevent_id']); ?>&mevent_id=<?php echo $this->myencrypt->encrypt_url($communion_details['mevent_id']); ?>&print=true" class="btn btn-warning">Print</a>
                                <a onclick="deleteRegister('<?php echo $this->myencrypt->encrypt_url($communion_details['tevent_id']); ?>', 'communion', '<?php echo $this->myencrypt->encrypt_url($communion_details['mevent_id']); ?>')" class="btn btn-danger">Delete</a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="row">Reg. No.</th>
                                        <td>:  <?php echo $communion_details['register_no']; ?></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Date</th>
                                        <td>: <?php echo $communion_details['date']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Minister</th>
                                        <td>: <?php echo $communion_details['minister']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Place</th>
                                        <td>: <?php echo $communion_details['place']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Parish</th>
                                        <td>: <?php echo $communion_details['venueparish_name'] . ', ' . $communion_details['venueparish_city']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Remarks</th>
                                        <td>: <?php echo $communion_details['remarks']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Communion details
                        </h2>  
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="manageregister?mevent_id=<?php echo $this->myencrypt->encrypt_url('2'); ?>&mid=<?php echo $this->myencrypt->encrypt_url($member['mmember_id']); ?>&add_register=true" class="btn btn-primary">Add</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    if (isset($confirmation_details)) {
        ?>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Confirmation details
                        </h2> 
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="manageregister?tevent_id=<?php echo $this->myencrypt->encrypt_url($confirmation_details['tevent_id']); ?>&mevent_id=<?php echo $this->myencrypt->encrypt_url($confirmation_details['mevent_id']); ?>&edit=true" class="btn btn-primary">Edit</a>
                                <a href="printcertificate?tevent_id=<?php echo $this->myencrypt->encrypt_url($confirmation_details['tevent_id']); ?>&mevent_id=<?php echo $this->myencrypt->encrypt_url($confirmation_details['mevent_id']); ?>&print=true" class="btn btn-warning">Print</a>
                                <a onclick="deleteRegister('<?php echo $this->myencrypt->encrypt_url($confirmation_details['tevent_id']); ?>', 'confirmation', '<?php echo $this->myencrypt->encrypt_url($confirmation_details['mevent_id']); ?>')" class="btn btn-danger">Delete</a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="row">Reg. No.</th>
                                        <td>:  <?php echo $confirmation_details['register_no']; ?></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Date</th>
                                        <td>: <?php echo $confirmation_details['date']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Godfather</th>
                                        <td>: <?php echo $confirmation_details['godfather']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Godmother</th>
                                        <td>: <?php echo $confirmation_details['godmother']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Minister</th>
                                        <td>: <?php echo $confirmation_details['minister']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Place</th>
                                        <td>: <?php echo $confirmation_details['place']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Parish</th>
                                        <td>: <?php echo $confirmation_details['venueparish_name'] . ', ' . $confirmation_details['venueparish_city']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Remarks</th>
                                        <td>: <?php echo $confirmation_details['remarks']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Confirmation details
                        </h2>  
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="manageregister?mevent_id=<?php echo $this->myencrypt->encrypt_url('3'); ?>&mid=<?php echo $this->myencrypt->encrypt_url($member['mmember_id']); ?>&add_register=true" class="btn btn-primary">Add</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    if (empty($member['vocation_flag'])) {
        if (isset($marriage_details)) {
            ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Marriage details
                            </h2> 
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="manageregister?tevent_id=<?php echo $this->myencrypt->encrypt_url($marriage_details['tevent_id']); ?>&mevent_id=<?php echo $this->myencrypt->encrypt_url($marriage_details['mevent_id']); ?>&edit=true" class="btn btn-primary">Edit</a>
                                    <a href="printcertificate?tevent_id=<?php echo $this->myencrypt->encrypt_url($marriage_details['tevent_id']); ?>&mevent_id=<?php echo $this->myencrypt->encrypt_url($marriage_details['mevent_id']); ?>&print=true" class="btn btn-warning">Print</a>
                                    <a onclick="deleteRegister('<?php echo $this->myencrypt->encrypt_url($marriage_details['tevent_id']); ?>', 'marriage', '<?php echo $this->myencrypt->encrypt_url($marriage_details['mevent_id']); ?>')" class="btn btn-danger">Delete</a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="body table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="row">Reg. No.</th>
                                            <td>:  <?php echo $marriage_details['register_no']; ?></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Date</th>
                                            <td>: <?php echo $marriage_details['date']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Spouse</th>
                                            <td>: <?php
                                                if ($member['mgender_id'] === '1') {
                                                    $spouse_name = ucfirst($marriage_details['bride_firstname']) . ' ' . ucfirst($marriage_details['bride_lastname']);
                                                    $spouse_id = ucfirst($marriage_details['mbride_id']);
                                                } else if ($member['mgender_id'] === '2') {
                                                    $spouse_name = ucfirst($marriage_details['groom_firstname']) . ' ' . ucfirst($marriage_details['groom_lastname']);
                                                    $spouse_id = ucfirst($marriage_details['mgroom_id']);
                                                }
                                                ?>
                                                <a href="members?member_id=<?php echo $this->myencrypt->encrypt_url($spouse_id); ?>&view=true"><?php echo $spouse_name; ?></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Witness 1</th>
                                            <td>: <?php echo $marriage_details['witness1']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Witness 2</th>
                                            <td>: <?php echo $marriage_details['witness2']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Minister</th>
                                            <td>: <?php echo $marriage_details['minister']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Place</th>
                                            <td>: <?php echo $marriage_details['place']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Parish</th>
                                            <td>: <?php echo $marriage_details['venueparish_name'] . ', ' . $marriage_details['venueparish_city']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Remarks</th>
                                            <td>: <?php echo $marriage_details['remarks']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Marriage details
                            </h2>  
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="manageregister?mevent_id=<?php echo $this->myencrypt->encrypt_url('4'); ?>&mid=<?php echo $this->myencrypt->encrypt_url($member['mmember_id']); ?>&add_register=true" class="btn btn-primary">Add</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
    }
    if (empty($member['marriage_flag'])) {
        if (isset($vocation_details)) {
            ?>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Vocation details
                            </h2> 
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="manageregister?tevent_id=<?php echo $this->myencrypt->encrypt_url($vocation_details['tevent_id']); ?>&mevent_id=<?php echo $this->myencrypt->encrypt_url($vocation_details['mevent_id']); ?>&edit=true" class="btn btn-primary">Edit</a>
                                    <a href="printcertificate?tevent_id=<?php echo $this->myencrypt->encrypt_url($vocation_details['tevent_id']); ?>&mevent_id=<?php echo $this->myencrypt->encrypt_url($vocation_details['mevent_id']); ?>&print=true" class="btn btn-warning">Print</a>
                                    <a onclick="deleteRegister('<?php echo $this->myencrypt->encrypt_url($vocation_details['tevent_id']); ?>', 'vocation', '<?php echo $this->myencrypt->encrypt_url($vocation_details['mevent_id']); ?>')" class="btn btn-danger">Delete</a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="body table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="row">Reg. No.</th>
                                            <td>:  <?php echo $vocation_details['register_no']; ?></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Date</th>
                                            <td>: <?php echo $vocation_details['date']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Minister</th>
                                            <td>: <?php echo $vocation_details['minister']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Place</th>
                                            <td>: <?php echo $vocation_details['place']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Parish</th>
                                            <td>: <?php echo $vocation_details['venueparish_name'] . ', ' . $vocation_details['venueparish_city']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Remarks</th>
                                            <td>: <?php echo $vocation_details['remarks']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Vocation details
                            </h2>  
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="manageregister?mevent_id=<?php echo $this->myencrypt->encrypt_url('5'); ?>&mid=<?php echo $this->myencrypt->encrypt_url($member['mmember_id']); ?>&add_register=true" class="btn btn-primary">Add</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
    }
    if (isset($death_details)) {
        ?>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Death details
                        </h2> 
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="manageregister?tevent_id=<?php echo $this->myencrypt->encrypt_url($death_details['tevent_id']); ?>&mevent_id=<?php echo $this->myencrypt->encrypt_url($death_details['mevent_id']); ?>&edit=true" class="btn btn-primary">Edit</a>
                                <a href="printcertificate?tevent_id=<?php echo $this->myencrypt->encrypt_url($death_details['tevent_id']); ?>&mevent_id=<?php echo $this->myencrypt->encrypt_url($death_details['mevent_id']); ?>&print=true" class="btn btn-warning">Print</a>
                                <a onclick="deleteRegister('<?php echo $this->myencrypt->encrypt_url($death_details['tevent_id']); ?>', 'death', '<?php echo $this->myencrypt->encrypt_url($death_details['mevent_id']); ?>')" class="btn btn-danger">Delete</a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="row">Reg. No.</th>
                                        <td>:  <?php echo $death_details['register_no']; ?></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Date</th>
                                        <td>: <?php echo $death_details['date']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Funeral Date</th>
                                        <td>: <?php echo $death_details['funeral_date']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Minister</th>
                                        <td>: <?php echo $death_details['minister']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Place</th>
                                        <td>: <?php echo $death_details['place']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Parish</th>
                                        <td>: <?php echo $death_details['venueparish_name'] . ', ' . $death_details['venueparish_city']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Remarks</th>
                                        <td>: <?php echo $death_details['remarks']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Death details
                        </h2>  
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="manageregister?mevent_id=<?php echo $this->myencrypt->encrypt_url('6'); ?>&mid=<?php echo $this->myencrypt->encrypt_url($member['mmember_id']); ?>&add_register=true" class="btn btn-primary">Add</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
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
                window.location.replace("<?php echo base_url() . 'admin/manageregister?tevent_id='; ?>" + id + "<?php echo '&mevent_id='; ?>" + mevent_id + "&delete=true");
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
                                if (isset($temporary)) {
                                    echo strtoupper('temporary ');
                                }
                                ?>MEMBERS</h2>
                        </div>
                        <div class="col-xs-12 col-sm-6 align-right">
                            <div class="switch panel-switch-btn">
                                <a href="managemember<?php
                                if (!isset($temporary)) {
                                    echo '?active=true';
                                }
                                ?>" class="btn btn-primary waves-effect"><i class="material-icons">add</i><span>NEW</span></a>
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
                                    <th>Status</th>
                                    <th>Action</th>
                            <status>
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
                                                <td><a href="<?php echo base_url() . 'admin/members?member_id=' . $this->myencrypt->encrypt_url($member->mmember_id) . '&view=true'; ?>"><?php echo $member->firstname . " " . $member->lastname; ?><?php
                                                        if (!empty($member->death_flag)) {
                                                            echo " (Late)";
                                                        }
                                                        ?></a></td>
                                                <td><?php if (empty($member->status)) { ?>
                                                        <span class="label label-danger">Inactive</span>
                                                    <?php } else { ?>
                                                        <span class="label label-success">Active</span>
                                                    <?php } ?>
                                                </td>
                                                <td><?php if (empty($member->status)) { ?>
                                                        <a onclick="restoreMember('<?php echo $this->myencrypt->encrypt_url($member->mmember_id) ?>')" class="btn btn-success">Restore</a>
                                                    <?php } else { ?>
                                                        <a onclick="deleteMember('<?php echo $this->myencrypt->encrypt_url($member->mmember_id) ?>')" class="btn btn-danger">Delete</a>
                                                    <?php } ?>
                                                </td>
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
<script>
    function deleteMember(id) {
        swal({
            title: "Delete member?",
            type: "error",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            closeOnConfirm: false
        }, function () {
            window.location.replace("<?php echo base_url() . 'admin/managemember?delete=true'; ?>" + "&id=" + id);
        });
    }
    function restoreMember(id) {
        swal({
            title: "Restore member?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            closeOnConfirm: false
        }, function () {
            window.location.replace("<?php echo base_url() . 'admin/managemember?restore=true'; ?>" + "&id=" + id);
        });
    }
</script>            