<?php
if (isset($table)):
    ?>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a onclick="window.history.back()" class="btn btn-default">Back</a>
                    <h3 class="align-center"><?php echo $table; ?></h3>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="managedata?table=<?php echo $table; ?>&id=<?php echo $row_data['id']; ?>&edit=true" class="btn btn-primary">Edit</a>
                            <?php if (empty($row_data['status'])) { ?>
                                <a onclick="restoreScc('<?php echo $this->myencrypt->encrypt_url($row_data['id']) ?>')" class="btn btn-success">Restore</a>
                            <?php } else { ?>
                                <a onclick="deleteScc('<?php echo $this->myencrypt->encrypt_url($row_data['id']) ?>')" class="btn btn-danger">Delete</a>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="body table-responsive">
                        <table class="table table-bordered" data-page-length="50">
                            <tbody>
                                <?php
                                if (isset($fields)):
                                    $i = 1;
                                    foreach ($fields as $field) :
                                        ?>
                                        <tr>
                                            <th><?php echo strtoupper($field->name); ?></th>
                                            <td><?php echo $row_data[$field->name]; ?></td>
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
<?php endif; ?>