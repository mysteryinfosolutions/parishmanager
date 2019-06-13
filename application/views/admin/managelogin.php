<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>MANAGE LOGIN</h2>
            </div>
            <div class="body">
                <?php
                $attributes = array('id' => 'form_advanced_validation',
                    'class' => 'form-horizontal');
                echo form_open('admin/managelogin', $attributes);
                ?>
                <input type="hidden" name="edit_id" value="<?php echo isset($login) ? $this->myencrypt->encrypt_url($login['mlogin_id']) : null; ?>">
                <input type="hidden" name="form_mparish_id" value="<?php echo isset($login)? $this->myencrypt->encrypt_url($login['target_id']):$this->myencrypt->encrypt_url($parishdetails['mparish_id']);?>">
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="login_name">Name</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_name" id="login_name" class="form-control show-tick" value="<?php echo isset($login) ? $login['name'] : null; ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="login_username">Username</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="form_username" id="login_username" class="form-control show-tick" value="<?php echo isset($login) ? $login['username'] : null; ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="login_password">Password</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" name="form_password" id="login_password" class="form-control show-tick" value="<?php echo isset($login) ? $this->encryption->decrypt($login['password']) : null; ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
<!--                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="accessrigths">Access rights</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <select name="form_maccessright_id" id="accessrigths" class="form-control show-tick" required="">
                                    <option value="">Nothing selected</option>
                                    <?php
                                    if (isset($accessrights)):
                                        foreach ($accessrights as $accessright) :
                                            ?>
                                            <option value="<?php echo $this->myencrypt->encrypt_url($accessright->id); ?>" <?php
                                            if (isset($login)) {
                                                if ($login['maccessright_id'] === $accessright->id) {
                                                    ?>selected="true"<?php
                                                        }
                                                    }
                                                    ?>><?php echo $accessright->name; ?></option>
                                                    <?php
                                                endforeach;
                                            endif;
                                            ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>-->
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                        <p class="col-pink">All fields are required</p>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect" name="submit" value="submitted"><?php echo isset($login) ? 'UPDATE' : 'SUBMIT'; ?></button>
                        <?php if (isset($login)) { ?>
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