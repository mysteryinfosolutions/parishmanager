<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <a onclick="window.history.back()" class="btn btn-default">Back</a>
                <h3>MANAGE SCC</h3>
            </div>
            <div class="body">
                <?php
                $attributes = array('id' => 'form_advanced_validation',
                    'class' => 'form-horizontal');
                echo form_open('parish/managescc', $attributes);
                ?>
                <input type="hidden" name="edit_id" value="<?php echo isset($scc) ? $this->myencrypt->encrypt_url($scc['mscc_id']) : null; ?>">
                <input type="hidden" name="form_mparish_id" value="<?php echo isset($scc)? $this->myencrypt->encrypt_url($scc['mparish_id']):$this->myencrypt->encrypt_url($parishdetails['mparish_id']);?>">
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="scc_name">Scc Name</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_name" id="scc_name" class="form-control show-tick" value="<?php echo isset($scc) ? $scc['name'] : null; ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="scc_sakha">Sakha</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="scc_sakha" name="form_sakha" value="<?php echo isset($scc) ? $scc['sakha'] : null; ?>" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="scc_president">President</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="scc_president" name="form_president" value="<?php echo isset($scc) ? $scc['president'] : null; ?>" placeholder="Name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="tel" id="scc_president" name="form_president_contact" value="<?php echo isset($scc) ? $scc['president_contact'] : null; ?>" placeholder="Contact" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="scc_secretary">Secretary</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="scc_secretary" name="form_secretary" value="<?php echo isset($scc) ? $scc['secretary'] : null; ?>" placeholder="Name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="tel" id="scc_secretary" name="form_secretary_contact" value="<?php echo isset($scc) ? $scc['secretary_contact'] : null; ?>" placeholder="Contact" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="scc_treasurer">Treasurer</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="scc_treasurer" name="form_treasurer" value="<?php echo isset($scc) ? $scc['treasurer'] : null; ?>" placeholder="Name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="tel" id="scc_treasurer" name="form_treasurer_contact" value="<?php echo isset($scc) ? $scc['treasurer_contact'] : null; ?>" placeholder="Contact" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="scc_remarks">Remarks</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="4" id="scc_remarks" class="form-control no-resize" name="form_remarks" placeholder="Type your remarks..."><?php echo isset($scc) ? $scc['remarks'] : null; ?></textarea>
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
                        <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect" name="submit" value="submitted"><?php echo isset($scc) ? 'UPDATE' : 'SUBMIT'; ?></button>
                        <?php if (isset($scc)) { ?>
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