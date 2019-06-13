<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-6">
                        <h2>CATECHISTS</h2>
                    </div>
                    <div class="col-xs-12 col-sm-6 align-right">
                        <div class="switch panel-switch-btn">
                            <a href="managecatechist" class="btn btn-primary waves-effect"><i class="material-icons">add</i><span>NEW</span></a>
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
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($catechists)):
                                $i = 1;
                                foreach ($catechists as $catechist) :
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><a href="<?php echo base_url() . 'parish/members?member_id=' . $this->myencrypt->encrypt_url($catechist->mmember_id) . '&view=true'; ?>"><?php echo $catechist->firstname . " " . $catechist->lastname; ?></a></td>
                                        <td><a onclick="deleteCatechist('<?php echo $this->myencrypt->encrypt_url($catechist->mcatechist_id); ?>')" class="btn btn-danger">Delete</a></td>
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
<script>
    function deleteCatechist(id) {
        swal({
            title: "Delete catechist?",
            type: "error",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            closeOnConfirm: false
        }, function () {
            window.location.replace("<?php echo base_url() . 'parish/managecatechist?delete=true'; ?>" + "&id=" + id);
        });
    }
</script>  