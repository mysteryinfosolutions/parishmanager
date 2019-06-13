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
                        <?php
                        $attributes = array('id' => 'form_advanced_validation',
                            'class' => 'form-horizontal');
                        echo form_open('admin/managedata', $attributes);
                        ?>
                        <input type="hidden" name="table" value="<?php echo $table; ?>">
                        <table class="table" data-page-length="50">
                            <tbody>
                                <?php
                                if (isset($fields)):
                                    $i = 1;
                                    foreach ($fields as $field) :
                                        ?>
                                        <tr>
                                            <th><?php echo strtoupper($field->name); ?></th>
                                            <?php if ($field->type === 'text') {
                                                ?>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <textarea name="form_<?php echo $field->name; ?>" class="form-control no-resize"><?php echo $row_data[$field->name]; ?></textarea>
                                                        </div>
                                                    </div>
                                                </td>
                                                <?php
                                            } else {
                                                ?>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" name="form_<?php echo $field->name; ?>" value="<?php echo isset($row_data[$field->name]) ? $row_data[$field->name] : null; ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </td>
                                                <?php
                                            }
                                            ?>
                                        </tr>
                                        <?php
                                    endforeach;
                                endif;
                                ?>
                            </tbody>
                        </table>
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
    </div>    
<?php endif; ?>