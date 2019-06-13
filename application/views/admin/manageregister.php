<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <a onclick="window.history.back()" class="btn btn-default">Back</a>
                <h3 class="align-center">MANAGE <?php echo isset($mevent_data) ? strtoupper($mevent_data['name']) : null; ?> REGISTER</h3>
            </div>
            <div class="body">
                <?php
                $attributes = array('id' => 'form_advanced_validation',
                    'class' => 'form-horizontal');
                echo form_open('admin/manageregister', $attributes);
                ?>
                <input type="hidden" name="edit_id" value="<?php echo isset($register) ? $this->myencrypt->encrypt_url($register['tevent_id']) : null; ?>">
                <input type="hidden" name="form_mparish_id" value="<?php echo isset($register) ? $this->myencrypt->encrypt_url($register['mparish_id']) : $this->myencrypt->encrypt_url($parishdetails['mparish_id']); ?>">
                <input type="hidden" name="form_mevent_id" value="<?php echo isset($register) ? $this->myencrypt->encrypt_url($register['mevent_id']) : $this->myencrypt->encrypt_url($mevent_id) ?>">

                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="regno">Reg. No.</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_register_no" id="regno" value="<?php echo isset($register) ? $register['register_no'] : null; ?>" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($mevent_data['name'] === 'Baptism') { ?>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                            <label for="baptismalname">Baptismal Name </label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="form_baptismal_name" id="baptismalname" value="<?php echo isset($register) ? $register['baptismal_name'] : null; ?>"  class="form-control"/>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="doe">Date <?php echo isset($mevent_data) ? 'of ' . $mevent_data['name'] : null; ?></label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_date" id="doe" class="datepicker form-control" placeholder="Choose a date..." value="<?php echo isset($register) ? $register['date'] : null; ?>" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($mevent_data['name'] === 'Death') { ?>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                            <label for="dateoffuneral">Date of funeral</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="form_funeral_date" id="dateoffuneral" value="<?php echo isset($register) ? $register['funeral_date'] : null; ?>" placeholder="Choose a date..." class="datepicker form-control"/>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($mevent_data['name'] === 'Marriage') { ?>
                    <div class="row clearfix"> 
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                            <label>Select Groom *</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select name="form_mgroom_id" id="groom_list" class="form-control show-tick" required>
                                        <option value="">Nothing selected</option>
                                        <?php
                                        if (isset($grooms)):
                                            foreach ($grooms as $groom) :
                                                ?>
                                                <option value="<?php echo $this->myencrypt->encrypt_url($groom->mmember_id); ?>" <?php
                                                if (isset($selected_member)) {
                                                    if ($selected_member === $groom->mmember_id) {
                                                        ?> selected="true"<?php
                                                            }
                                                        }
                                                        if (isset($register)) {
                                                            if ($register['mgroom_id'] === $groom->mmember_id) {
                                                                ?> selected="true"<?php
                                                            }
                                                        }
                                                        ?>><?php echo $groom->firstname . " " . $groom->lastname; ?></option>
                                                        <?php
                                                    endforeach;
                                                else:
                                                    ?>
                                            <option value="">Groom records not availiable</option>
                                        <?php
                                        endif;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix"> 
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                            <label>Select Bride *</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select name="form_mbride_id" id="bride_list" class="form-control show-tick" required>
                                        <option value="">Nothing selected</option>
                                        <?php
                                        if (isset($brides)):
                                            foreach ($brides as $bride) :
                                                ?>
                                                <option value="<?php echo $this->myencrypt->encrypt_url($bride->mmember_id); ?>" <?php
                                                if (isset($selected_member)) {
                                                    if ($selected_member === $bride->mmember_id) {
                                                        ?> selected="true"<?php
                                                            }
                                                        }
                                                        if (isset($register)) {
                                                            if ($register['mbride_id'] === $bride->mmember_id) {
                                                                ?> selected="true"<?php
                                                            }
                                                        }
                                                        ?>><?php echo $bride->firstname . " " . $bride->lastname; ?></option>
                                                        <?php
                                                    endforeach;
                                                else:
                                                    ?>
                                            <option value="">Bride records not availiable</option>
                                        <?php
                                        endif;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="witness1">Witness 1</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea rows="4" id="witness1" class="form-control no-resize" name="form_witness1" placeholder="Name and address"><?php echo isset($register) ? $register['witness1'] : null; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="witness2">Witness 2</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea rows="4" id="witness2" class="form-control no-resize" name="form_witness2" placeholder="Name and address"><?php echo isset($register) ? $register['witness2'] : null; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="member_id">Member</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select name="form_mmember_id" id="member_id" class="form-control show-tick" required="">
                                        <option value="">Nothing selected</option>
                                        <?php
                                        if (isset($members)):
                                            foreach ($members as $member) :
                                                ?>
                                                <option value="<?php echo $this->myencrypt->encrypt_url($member->mmember_id); ?>" <?php
                                                if (isset($selected_member)) {
                                                    if ($selected_member === $member->mmember_id) {
                                                        ?> selected="true"<?php
                                                            }
                                                        }
                                                        if (isset($register)) {
                                                            if ($register['mmember_id'] === $member->mmember_id) {
                                                                ?> selected="true"<?php
                                                            }
                                                        }
                                                        ?>><?php echo $member->firstname . " " . $member->lastname; ?></option>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($mevent_data['name'] === 'Baptism' || $mevent_data['name'] === 'Confirmation') { ?>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                            <label for="father">God-Father</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="form_godfather" id="father" value="<?php echo isset($register) ? $register['godfather'] : null; ?>"  class="form-control"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                            <label for="mother">God-Mother</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="form_godmother" id="mother" value="<?php echo isset($register) ? $register['godmother'] : null; ?>"  class="form-control"/>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="minister">Minister</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_minister" id="minister" placeholder="Fr." value="<?php echo isset($register) ? $register['minister'] : null; ?>"  class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="place">Place</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_place" id="place" value="<?php echo isset($register) ? $register['place'] : null; ?>"  class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="parish">Venue Parish</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <select id="parish" name="form_venue_mparish_id" class="form-control show-tick">
                                <option value="">Nothing selected</option>
                                <?php
                                if (isset($parishes)):
                                    foreach ($parishes as $parish) :
                                        ?>
                                        <option value="<?php echo $this->myencrypt->encrypt_url($parish->mparish_id); ?>" <?php
                                        if (isset($register)) {
                                            if ($register['venue_mparish_id'] === $parish->mparish_id) {
                                                ?> selected="true"<?php
                                                    }
                                                } else {
                                                    if ($parishdetails['mparish_id'] === $parish->mparish_id) {
                                                        ?> selected="true"<?php
                                                    }
                                                }
                                                ?>><?php echo ucfirst($parish->name) . ", " . ucfirst($parish->city); ?></option>
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
                        <label for="remarks">Remarks</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="4" id="remarks" class="form-control no-resize" name="form_remarks" placeholder="Type your remarks..."><?php echo isset($register) ? $register['remarks'] : null; ?></textarea>
                            </div>
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
                        <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect" name="submit" value="submitted"><?php echo isset($register) ? 'UPDATE' : 'SUBMIT'; ?></button>
                        <?php if (isset($register)) { ?>
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