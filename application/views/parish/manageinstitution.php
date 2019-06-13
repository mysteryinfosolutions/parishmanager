<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <a onclick="window.history.back()" class="btn btn-default">Back</a>
                <h3>MANAGE INSTITUTION</h3>
            </div>
            <div class="body">
                <?php
                $attributes = array('id' => 'form_advanced_validation',
                    'class' => 'form-horizontal');
                echo form_open('parish/manageinstitution', $attributes);
                ?>
                <input type="hidden" name="edit_id" value="<?php echo isset($institution) ? $this->myencrypt->encrypt_url($institution['tinstitution_id']) : null; ?>">
                <input type="hidden" name="form_mparish_id" value="<?php echo isset($institution) ? $this->myencrypt->encrypt_url($institution['mparish_id']) : $this->myencrypt->encrypt_url($parishdetails['mparish_id']); ?>">
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="name">Name *</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_name" id="name" value="<?php echo isset($institution) ? $institution['name'] : null; ?>" class="form-control" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="minstitution_id">Institution type</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <select name="form_minstitution_id" id="minstitution_id" class="form-control show-tick" required="">
                                    <option value="">Nothing selected</option>
                                    <?php
                                    if (isset($minstitutions)):
                                        foreach ($minstitutions as $minstitution) :
                                            ?>
                                            <option value="<?php echo $this->myencrypt->encrypt_url($minstitution->id); ?>" <?php
                                                    if (isset($institution)) {
                                                        if ($institution['minstitution_id'] === $minstitution->id) {
                                                            ?> selected="true"<?php
                                                        }
                                                    }
                                                    ?>><?php echo $minstitution->name; ?></option>
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
                        <label for="incharge">Incharge *</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_incharge" id="incharge" value="<?php echo isset($institution) ? $institution['incharge'] : null; ?>" class="form-control" required/>
                            </div>
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
                                <input type="tel" name="form_contact1" id="mobile" value="<?php echo isset($institution) ? $institution['contact1'] : null; ?>" class="form-control"/>
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
                                <input type="tel" name="form_contact2" id="res" value="<?php echo isset($institution) ? $institution['contact2'] : null; ?>" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="email1">E-mail 1</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="email" name="form_email1" id="email1" value="<?php echo isset($institution) ? $institution['email1'] : null; ?>" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="email2">E-mail 2</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="email" name="form_email2" id="email2" value="<?php echo isset($institution) ? $institution['email2'] : null; ?>" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="website">Website</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="url" name="form_website" id="website" value="<?php echo isset($institution) ? $institution['website'] : null; ?>" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="addressline1">Addressline 1</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_addressline1" id="addressline1" value="<?php echo isset($institution) ? $institution['addressline1'] : null; ?>" class="form-control"/>
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
                                <input type="text" name="form_addressline2" id="addressline2" value="<?php echo isset($institution) ? $institution['addressline2'] : null; ?>" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="city">City</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_city" id="city" value="<?php echo isset($institution) ? $institution['city'] : null; ?>" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="country_name">Country</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <select name="form_country" id="country_name" class="form-control show-tick" onchange="getStates(this.value)">
                                    <option value="">Nothing selected</option>
                                    <?php
                                    if (isset($countries)):
                                        foreach ($countries as $country) :
                                            ?>
                                            <option value="<?php echo $this->myencrypt->encrypt_url($country->id); ?>" <?php
                                            if (isset($institution)) {
                                                if ($institution['country_id'] === $country->id) {
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
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="state_id">State</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <?php
                                if (isset($institution)) {
                                    ?>
                                    <select name="form_mstate_id" id="state_id" class="form-control show-tick">
                                        <?php
                                        if (isset($states)):
                                            foreach ($states as $state) :
                                                ?>
                                                <option value="<?php echo $this->myencrypt->encrypt_url($state->id); ?>" <?php
                                                if ($institution['mstate_id'] === $state->id) {
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
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="pincode">Pincode</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_pincode" id="pincode" value="<?php echo isset($institution) ? $institution['pincode'] : null; ?>" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="institution_remarks">Remarks</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="4" id="institution_remarks" class="form-control no-resize" name="form_remarks" placeholder="Type your remarks..."><?php echo isset($institution) ? $institution['remarks'] : null; ?></textarea>
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
                        <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect" name="submit" value="submitted"><?php echo isset($institution) ? 'UPDATE' : 'SUBMIT'; ?></button>
                        <?php if (isset($institution)) { ?>
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