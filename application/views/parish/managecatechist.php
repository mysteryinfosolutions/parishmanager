<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <a onclick="window.history.back()" class="btn btn-default">Back</a>
                <h3>MANAGE CATECHIST</h3>
            </div>
            <div class="body">
                <?php
                $attributes = array('id' => 'form_advanced_validation',
                    'class' => 'form-horizontal');
                echo form_open('parish/managecatechist', $attributes);
                ?>
                <input type="hidden" name="form_mparish_id" value="<?php echo isset($catechist) ? $this->myencrypt->encrypt_url($catechist['mparish_id']) : $this->myencrypt->encrypt_url($parishdetails['mparish_id']); ?>">
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="catechist">CATECHIST</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <select name="form_mmember_id" id="catechist" class="form-control show-tick" required="">
                                    <option value="">Nothing selected</option>
                                    <?php
                                    if (isset($members)):
                                        foreach ($members as $member) :
                                            ?>
                                            <option value="<?php echo $this->myencrypt->encrypt_url($member->mmember_id); ?>">
                                                <?php echo $member->firstname . " " . $member->lastname; ?></option>
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
                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect" name="submit" value="submitted"><?php echo isset($catechist) ? 'UPDATE' : 'SUBMIT'; ?></button>
                        <?php if (isset($catechist)) { ?>
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