<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <a onclick="window.history.back()" class="btn btn-default">Back</a>
                <h3>MANAGE CONVENT</h3>
            </div>
            <div class="body">
                <?php
                $attributes = array('id' => 'form_advanced_validation',
                    'class' => 'form-horizontal');
                echo form_open('parish/manageconvent', $attributes);
                ?>
                <input type="hidden" name="edit_id" value="<?php echo isset($convent) ? $this->myencrypt->encrypt_url($convent['mconvent_id']) : null; ?>">
                <input type="hidden" name="form_mparish_id" value="<?php echo isset($convent) ? $this->myencrypt->encrypt_url($convent['mparish_id']) : $this->myencrypt->encrypt_url($parishdetails['mparish_id']); ?>">
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="name">Name *</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_name" id="name" value="<?php echo isset($convent) ? $convent['name'] : null; ?>" class="form-control" autofocus="" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="congregation_id">Congregation</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <select name="form_mcongregation_id" id="congregation_id" class="form-control show-tick" required="">
                                    <option value="">Nothing selected</option>
                                    <?php
                                    if (isset($congregations)):
                                        foreach ($congregations as $congregation) :
                                            ?>
                                            <option value="<?php echo $this->myencrypt->encrypt_url($congregation->id); ?>" <?php
                                            if (isset($convent)) {
                                                if ($convent['mcongregation_id'] === $congregation->id) {
                                                    ?> selected="true"<?php
                                                        }
                                                    }
                                                    ?>><?php echo $congregation->name; ?></option>
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
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="addressline1">Addressline 1</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_addressline1" id="addressline1" value="<?php echo isset($convent) ? $convent['addressline1'] : null; ?>" class="form-control"/>
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
                                <input type="text" name="form_addressline2" id="addressline2" value="<?php echo isset($convent) ? $convent['addressline2'] : null; ?>" class="form-control"/>
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
                                <input type="text" name="form_city" id="city" value="<?php echo isset($convent) ? $convent['city'] : null; ?>" class="form-control"/>
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
                                            if (isset($convent)) {
                                                if ($convent['country_id'] === $country->id) {
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
                                if (isset($convent)) {
                                    ?>
                                    <select name="form_mstate_id" id="state_id" class="form-control show-tick">
                                        <?php
                                        if (isset($states)):
                                            foreach ($states as $state) :
                                                ?>
                                                <option value="<?php echo $this->myencrypt->encrypt_url($state->id); ?>" <?php
                                                if ($convent['mstate_id'] === $state->id) {
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
                                <input type="text" name="form_pincode" id="pincode" value="<?php echo isset($convent) ? $convent['pincode'] : null; ?>" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="convent_remarks">Remarks</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="4" id="convent_remarks" class="form-control no-resize" name="form_remarks" placeholder="Type your remarks..."><?php echo isset($convent) ? $convent['remarks'] : null; ?></textarea>
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
                        <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect" name="submit" value="submitted"><?php echo isset($convent) ? 'UPDATE' : 'SUBMIT'; ?></button>
                        <?php if (isset($convent)) { ?>
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