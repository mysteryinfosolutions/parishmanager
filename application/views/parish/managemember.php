<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <a onclick="window.history.back()" class="btn btn-default">Back</a>
                <h3 class="align-center">MANAGE MEMBER</h3>
            </div>
            <div class="body">
                <?php
                $attributes = array('id' => 'form_advanced_validation',
                    'class' => 'form-horizontal');
                echo form_open('parish/managemember', $attributes);
                ?>
                <input type="hidden" name="edit_id" value="<?php echo isset($member) ? $this->myencrypt->encrypt_url($member['mmember_id']) : null; ?>">
                <input type="hidden" name="form_mparish_id" value="<?php echo isset($member) ? $this->myencrypt->encrypt_url($member['mparish_id']) : $this->myencrypt->encrypt_url($parishdetails['mparish_id']); ?>">
                 <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="dom">Member Since</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_membersince" id="dom" class="datepicker form-control" data-date-end-date="0d" placeholder="Choose a date..." value="<?php echo isset($member) ? $member['membersince'] : date("Y-m-d"); ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="scc_id">SCC</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <select name="form_mscc_id" id="scc_id" class="form-control show-tick" <?php if (isset($active_member)) { ?> required="" <?php } ?> onchange="getFamilies(this.value)">
                                    <option value="">Nothing selected</option>
                                    <?php
                                    if (isset($sccs)):
                                        foreach ($sccs as $scc) :
                                            ?>
                                            <option value="<?php echo $this->myencrypt->encrypt_url($scc->mscc_id); ?>" <?php
                                            if (isset($selected_scc)) {
                                                if ($selected_scc === $scc->mscc_id) {
                                                    ?> selected="true"<?php
                                                        }
                                                    }
                                                    if (isset($member)) {
                                                        if ($member['mscc_id'] === $scc->mscc_id) {
                                                            ?> selected="true"<?php
                                                        }
                                                    }
                                                    ?>><?php echo $scc->name; ?></option>
                                                    <?php
                                                endforeach;
                                            endif;
                                            ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="family_id">Family *</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <?php
                                if (isset($member) || isset($selected_family)) {
                                    ?>
                                    <select name="form_mfamily_id" id="family_id" <?php if (isset($active_member)) { ?> required="" <?php } ?> class="form-control show-tick">
                                        <?php
                                        if (isset($families)):
                                            foreach ($families as $family) :
                                                ?>
                                                <option value="<?php echo $this->myencrypt->encrypt_url($family->mfamily_id); ?>" <?php
                                                if (isset($selected_family)) {
                                                    if ($selected_family === $scc->mscc_id) {
                                                        ?> selected="true"<?php
                                                            }
                                                        }
                                                        if (isset($member)) {
                                                            if ($member['mfamily_id'] === $family->mfamily_id) {
                                                                ?>selected="true"<?php
                                                            }
                                                        }
                                                        ?>><?php echo ucfirst($family->firstname) . " " . ucfirst($family->lastname); ?></option>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                    </select>
                                <?php } else { ?>
                                    <select name="form_mfamily_id" id="family_id"  <?php if (isset($active_member)) { ?> required="" <?php } ?> class="form-control show-tick">
                                        <option value="">Nothing selected</option>
                                    </select>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="firstname">Name *</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_firstname" placeholder="Firstname" value="<?php echo isset($member) ? $member['firstname'] : null; ?>" class="form-control" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_lastname" placeholder="Lastname" value="<?php echo isset($member) ? $member['lastname'] : null; ?>" class="form-control" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="gender">Gender *</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="gender">
                        <div class="form-group">
                            <input type="radio" name="form_gender" id="male" class="radio-col-indigo with-gap" value="1" 
                            <?php
                            if (isset($member)) {
                                if ($member['mgender_id'] === '1') {
                                    ?>checked="true"<?php
                                       }
                                   }
                                   ?> />
                            <label for="male">Male</label> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <input type="radio" name="form_gender" id="female" class="radio-col-indigo with-gap" value="2" 
                            <?php
                            if (isset($member)) {
                                if ($member['mgender_id'] === '2') {
                                    ?>checked="true"<?php
                                       }
                                   }
                                   ?> /> 
                            <label for="female">Female</label> 
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="dob">Date of birth</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_dateofbirth" id="dob" class="datepicker form-control" data-date-end-date="0d" placeholder="Choose a date..." value="<?php echo isset($member) ? $member['dateofbirth'] : date("Y-m-d"); ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="father">Father</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_father" id="father" value="<?php echo isset($member) ? $member['father'] : null; ?>" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="mother">Mother</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_mother" id="mother" value="<?php echo isset($member) ? $member['mother'] : null; ?>" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="qualification">Qualification</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <select name="form_mqualification_id" id="qualification" class="form-control show-tick">
                                <option value="0">Nothing selected</option>
                                <?php
                                if (isset($qualifications)):
                                    foreach ($qualifications as $qualification) :
                                        ?>
                                        <option value="<?php echo $this->myencrypt->encrypt_url($qualification->id); ?>" <?php
                                        if (isset($member)) {
                                            if ($member['mqualification_id'] === $qualification->id) {
                                                ?> selected="true"<?php
                                                    }
                                                }
                                                ?>><?php echo $qualification->name; ?></option>
                                                <?php
                                            endforeach;
                                        endif;
                                        ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="occupation">Occupation </label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <select name="form_moccupation_id" id="occupation" class="form-control show-tick">
                                <option value="0">Nothing selected</option>
                                <?php
                                if (isset($occupations)):
                                    foreach ($occupations as $occupation) :
                                        ?>
                                        <option value="<?php echo $this->myencrypt->encrypt_url($occupation->id); ?>" <?php
                                        if (isset($member)) {
                                            if ($member['moccupation_id'] === $occupation->id) {
                                                ?> selected="true"<?php
                                                    }
                                                }
                                                ?>><?php echo $occupation->name; ?></option>
                                                <?php
                                            endforeach;
                                        endif;
                                        ?>
                            </select>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="mobile">Mobile</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="tel" name="form_contact1" id="mobile" value="<?php echo isset($member) ? $member['contact1'] : null; ?>" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="res">Res</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="tel" name="form_contact2" id="res" value="<?php echo isset($member) ? $member['contact2'] : null; ?>" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="email">E-mail</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="email" name="form_email1" id="email" value="<?php echo isset($member) ? $member['email1'] : null; ?>" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="address1">Address</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="address1">
                        <div class="form-group">
                            <input type="radio"  value="1" name="adtype" id="house" class="radio-col-indigo with-gap" onclick="getAddress(family_id.value, this.value)"/>
                            <label for="house">Same as house</label> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <input type="radio" value="2" name="adtype" id="other"  class="radio-col-indigo with-gap" onclick="getAddress(family_id.value, this.value)" />
                            <label for="other">Other</label> 
                        </div>
                    </div>
                </div>
                <div id="address">
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                            <label for="addressline1">Addressline 1</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="form_addressline1" id="addressline1" value="<?php echo isset($member) ? $member['addressline1'] : null; ?>" class="form-control"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="addressline2">Addressline 2</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="form_addressline2" id="addressline2" value="<?php echo isset($member) ? $member['addressline2'] : null; ?>" class="form-control"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="city">City </label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="form_city" id="city" value="<?php echo isset($member) ? $member['city'] : null; ?>" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="country_id">Country</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <select name="form_country" id="country_id" class="form-control show-tick" onchange="getStates(this.value)">
                                    <option value="">Nothing selected</option>
                                    <?php
                                    if (isset($countries)):
                                        foreach ($countries as $country) :
                                            ?>
                                            <option value="<?php echo $this->myencrypt->encrypt_url($country->id); ?>" <?php
                                            if (isset($member)) {
                                                if ($member['country_id'] === $country->id) {
                                                    ?>selected="true"<?php
                                                        }
                                                    }
                                                    ?>><?php echo $country->name; ?></option>
                                                    <?php
                                                endforeach;
                                            endif;
                                            ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="state_id">State</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <?php
                                if (isset($member)) {
                                    ?>
                                    <select name="form_mstate_id" id="state_id" class="form-control show-tick">
                                        <?php
                                        if (isset($states)):
                                            foreach ($states as $state) :
                                                ?>
                                                <option value="<?php echo $this->myencrypt->encrypt_url($state->id); ?>" <?php
                                                if ($member['mstate_id'] === $state->id) {
                                                    ?>selected="true"<?php
                                                        }
                                                        ?>><?php echo $state->name; ?></option>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                    </select>
                                <?php } else { ?>
                                    <select name="form_mstate_id" id="state_id"  class="form-control show-tick">
                                        <option value="">Nothing selected</option>
                                    </select>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="pin">PIN</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="form_pincode" id="pincode" value="<?php echo isset($member) ? $member['pincode'] : null; ?>" class="form-control"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="remarks">Remarks</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="4" id="remarks" class="form-control no-resize" name="form_remarks" placeholder="Type your remarks..."><?php echo isset($member) ? $member['remarks'] : null; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <input type="checkbox" name="form_active_member" id="active" class="filled-in chk-col-indigo"
                            <?php
                            if (isset($member)) {
                                if ($member['active'] === '1') {
                                    echo 'checked';
                                }
                            }
                            if (isset($active_member)) {
                                echo'checked';
                            }
                            ?>
                                   >
                            <label for="active">Active Member</labelc
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <p class="col-pink">All fields are required</p>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect" name="submit" value="submitted"><?php echo isset($member) ? 'UPDATE' : 'SUBMIT'; ?></button>
                        <?php if (isset($member)) { ?>
                            <button type="reset" class="btn btn-danger btn-lg m-l-15 waves-effect" onclick="window.history.back()">Cancel</button>
                        <?php } else { ?>
                            <button type="reset" class="btn bg-grey btn-lg m-l-15 waves-effect">RESET</button>
<?php } ?>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>