<script>
    $(document).ready(function () {

        $(".add").click(function () {
            var html = $(".copy").html();
            $(".before-this").before(html);
        });

        $("body").on("click", ".remove", function () {
            $(this).parents(".add-this").remove();
        });

    });
</script>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="text-transform: uppercase" >
                    Manage <?php echo $massociation_data['abbreviation']; ?> MEMBERS
                </h2>
            </div>
            <div class="body">
                <?php
                $attributes = array('id' => 'form_advanced_validation',
                    'class' => 'form-horizontal');
                echo form_open('parish/manageassociationmembers', $attributes);
                ?>
                <input type="hidden" name="form_tassociation_id" value="<?php
                if (isset($tassociation_id)) {
                    echo $this->myencrypt->encrypt_url($tassociation_id);
                }
                ?>">
                <input type="hidden" name="form_massociation_id" value="<?php
                if (isset($massociation_id)) {
                    echo $this->myencrypt->encrypt_url($massociation_id);
                }
                ?>"/>
                <!--<input type="hidden" name="form_mparish_id" value="<?php echo isset($tassociation) ? $this->myencrypt->encrypt_url($tassociation['mparish_id']) : $this->myencrypt->encrypt_url($parishdetails['mparish_id']); ?>">-->
                <div class="row clearfix">
                    <div class="col-md-3">
                        <p><u>Enter member details</u><p>
                    </div>
                </div>
                <?php
                if (!empty($association_members)) {
                    foreach ($association_members as $association_member) {
                        ?>
                        <div class="add-this">
                            <div class="row clearfix">
                                <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2 form-control-label" >
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="hidden" name="form_tmember_id[]" value='<?php echo $association_member->tassociationmember_id; ?>'/>
                                            <input type="text" name="form_tmember_name[]" value="<?php echo $association_member->name; ?>" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-2 col-xs-4">
                                    <input type="button" value="Delete" class="remove btn btn-danger"/>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="add-this">
                        <div class="row clearfix">
                            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2 form-control-label" >
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="form_tmember_name[]" value="" class="form-control" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-4">
                                <input type="button" value="Delete" class="remove btn btn-danger"/>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="before-this">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" >
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                            <input type="button" value="+ New Member" class="add btn btn-success"/>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect" name="submit" value="submitted"><?php echo isset($tassociation) ? 'UPDATE' : 'SUBMIT'; ?></button>
                            <?php if (isset($tassociation)) { ?>
                                <button type="reset" class="btn btn-danger btn-lg m-l-15 waves-effect" onclick="window.history.back()">Cancel</button>
                            <?php } else { ?>
                                <button type="reset" class="btn bg-grey btn-lg m-l-15 waves-effect">RESET</button>
                            <?php } ?>
                    </div>
                </div>
                </form>
                <div class="copy" style="display: none">
                    <div class="add-this">
                        <div class="row clearfix">
                            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2 form-control-label" >
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="form_tmember_name[]" class="form-control" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-4">
                                <input type="button" value="Remove" class="remove btn btn-danger"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>