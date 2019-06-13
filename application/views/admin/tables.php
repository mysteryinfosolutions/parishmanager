<?php
if (isset($table)):
    ?>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a onclick="window.history.back()" class="btn btn-default">Back</a>
                    <h3 class="align-center"><?php echo $table; ?></h3>
                </div>
                <div class="body">
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable" data-page-length="50">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <?php
                                    if (isset($fields)) {
                                        foreach ($fields as $field) {
                                            ?>
                                            <th><?php echo $field ?></th>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($rows)):
                                    $i = 1;
                                    foreach ($rows as $row) :
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <?php foreach ($fields as $field) { ?>
                                                <td><a href="<?php echo base_url() . 'admin/viewdata?table='.$table.'&id=' . $row->id . '&view=true'; ?>"><?php echo $row->$field; ?></a></td>
                                            <?php } ?>
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
        function deleteScc(id) {
            swal({
                title: "Delete table?",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                window.location.replace("<?php echo base_url() . 'admin/managetable?delete=true'; ?>" + "&id=" + id);
            });
        }
        function restoreScc(id) {
            swal({
                title: "Restore table?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                window.location.replace("<?php echo base_url() . 'admin/managetable?restore=true'; ?>" + "&id=" + id);
            });
        }
    </script>      
<?php else:
    ?>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h2>TABLES</h2>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable" data-page-length="50">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($tables)):
                                    $i = 1;
                                    foreach ($tables as $table) :
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><a href="<?php echo base_url() . 'admin/tables?table=' . $table . '&view=true'; ?>"><?php echo strtoupper($table); ?></a></td>
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
        function deleteScc(id) {
            swal({
                title: "Delete table?",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                window.location.replace("<?php echo base_url() . 'admin/managetable?delete=true'; ?>" + "&id=" + id);
            });
        }
        function restoreScc(id) {
            swal({
                title: "Restore table?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                window.location.replace("<?php echo base_url() . 'admin/managetable?restore=true'; ?>" + "&id=" + id);
            });
        }
    </script>  
<?php
endif;
?>
               