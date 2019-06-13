<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <a onclick="window.history.back()" class="btn btn-default">Back</a>
                <h3 class="align-center">MANAGE <?php echo isset($massociation_data) ? strtoupper($massociation_data['name']) : null; ?></h3>
            </div>
            <div class="body">
                <?php
                $attributes = array('id' => 'form_advanced_validation',
                    'class' => 'form-horizontal');
                echo form_open('admin/manageassociation', $attributes);
                ?>
                <input type="hidden" name="edit_id" value="<?php echo isset($association) ? $this->myencrypt->encrypt_url($association['tassociation_id']) : null; ?>">
                <input type="hidden" name="form_mparish_id" value="<?php echo isset($association) ? $this->myencrypt->encrypt_url($association['mparish_id']) : $this->myencrypt->encrypt_url($parishdetails['mparish_id']); ?>">
                <input type="hidden" name="form_massociation_id" value="<?php echo isset($association) ? $this->myencrypt->encrypt_url($association['massociation_id']) : $this->myencrypt->encrypt_url($massociation_id) ?>">

                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="yearset">Yearset</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_name" id="yearset" value="<?php echo isset($association) ? $association['name'] : null; ?>" placeholder="Yearset" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="dof">From Date</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_from_date" id="dof" class="datepicker form-control" placeholder="Choose a date..." value="<?php echo isset($association) ? $association['from_date'] : null; ?>" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        <label for="date_to">To Date</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_to_date" id="date_to" value="<?php echo isset($association) ? $association['to_date'] : null; ?>" placeholder="Choose a date..." class="datepicker form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="association_president">President</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="association_president" name="form_president" value="<?php echo isset($association) ? $association['president'] : null; ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="association_vicepresident">Vice president</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="association_vicepresident" name="form_vicepresident" value="<?php echo isset($association) ? $association['vicepresident'] : null; ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="association_secretary">Secretary</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="association_secretary" name="form_secretary" value="<?php echo isset($association) ? $association['secretary'] : null; ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="association_joint_secretary">Joint secretary</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="association_joint_secretary" name="form_jointsecretary" value="<?php echo isset($association) ? $association['jointsecretary'] : null; ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="association_treasurer">Treasurer</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="association_treasurer" name="form_treasurer" value="<?php echo isset($association) ? $association['treasurer'] : null; ?>" class="form-control">
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
                                <textarea rows="4" id="remarks" class="form-control no-resize" name="form_remarks" placeholder="Type your remarks..."><?php echo isset($association) ? $association['remarks'] : null; ?></textarea>
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
                        <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect" name="submit" value="submitted"><?php echo isset($association) ? 'UPDATE' : 'SUBMIT'; ?></button>
                        <?php if (isset($association)) { ?>
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