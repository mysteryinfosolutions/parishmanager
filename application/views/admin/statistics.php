<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php
        if (isset($statistics)) {
            ?>

            <div class="card">
                <div class="header">
                    <h2>Statistics<?php
                        if (!empty($year)) {
                            echo ' for the year ' . $year;
                        }
                        ?><h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered" data-page-length="100">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Particulars</th>
                                                <th></th>
                                                <th>Count</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="3">23</td>
                                                <td rowspan="3">Baptisms</td>
                                                <td>Upto 1 year old</td>
                                                <td><?php echo $statistics['baptism<1']['nos']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>From 1 to 7 years old</td>
                                                <td><?php echo $statistics['baptism1to7']['nos']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Over 7 years old</td>
                                                <td><?php echo $statistics['baptism>7']['nos']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>24</td>
                                                <td>Confirmations</td>
                                                <td></td>
                                                <td><?php echo $statistics['confirmations']['nos']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>25</td>
                                                <td>First Communions</td>
                                                <td></td>
                                                <td><?php echo $statistics['communions']['nos']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>26</td>
                                                <td>Marriages</td>
                                                <td></td>
                                                <td><?php echo $statistics['marriages']['nos']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>27</td>
                                                <td>Deaths</td>
                                                <td></td>
                                                <td><?php echo $statistics['deaths']['nos']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>Catechists</td>
                                                <td></td>
                                                <td><?php echo $statistics['catechists']['nos']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <th colspan="2">TOTAL CATHOLIC POPULATION</th>
                                                <th><?php echo $statistics['members']['nos']; ?></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
<?php } else { ?>
                            <div class="card">
                                <div class="header">
                                    <h2>STATISTICS</h2>
                                </div>
                                <div class="body">
                                    <?php
                                    $attributes = array('id' => 'form_advanced_validation',
                                        'class' => 'form-horizontal');
                                    echo form_open('admin/statistics', $attributes);
                                    ?>
                                    <input type="hidden" name="generate-report" value="true"/>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="year">Select Year</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select name="form_year" id="year" class="form-control show-tick" required="">
                                                        <?php
                                                        for ($year = date('Y'); $year >= 2018; $year--) {
                                                            ?>
                                                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                                            <p class="col-pink">* - Mandatory fields</p>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect" name="submit" value="submitted">SUBMIT</button>
                                            <button type="reset" class="btn bg-grey btn-lg m-l-15 waves-effect">RESET</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
<?php } ?>
                        </div>
                        </div>