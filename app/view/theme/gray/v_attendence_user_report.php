<div class="panel panel-default">
    <div class="panel-heading">

        <div class="row">
            <div class="col-sm-12">
                <form method="POST"
                      action="<?php echo BASE_URL ?>index.php?url=AttendanceController/attendanceReportByUser">
                    <!--                <div class="row">-->
                    <div class="col-sm-3">
                        <div class="input-group">
                            <label>Select User</label>
                            <select class="form-control" name="user_id">
                                <option value="0">Select User</option>
                                <?php if ($data['users']) {
                                    foreach ($data['users'] as $user) { ?>

                                        <option value="<?php echo $user['id'] ?>"><?php echo $user['user_first_name'] . ' ' . $user['user_last_name'] ?></option>
                                    <?php }
                                } ?>
                            </select>
                        </div>

                    </div>
                    <div class="col-sm-3">
                        <label>From Dte</label>
                        <div class="input-group datepicker">
                            <input type="text" name="from_date" class="form-control datepicker" placeholder="mm/dd/yyyy"
                                   id="datepicker">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <label>From Dte</label>
                        <div class="input-group ">
                            <input type="text" name="to_date" class="form-control datepicker" placeholder="mm/dd/yyyy"
                                   id="datepickerTo">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <label>&nbsp;</label>
                        <div class="input-group ">
                            <button class="btn btn-success">Search</button>
                        </div>
                    </div>
                    <!--                </div>-->
                </form>
            </div>
        </div>

    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-btns"><a class="minimize"><i class="fa fa-minus"></i></a> <a class="panel-close"><i
                        class="fa fa-times"></i></a></div>
        <table id="data_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Date Name</th>
                <th>In time</th>
                <th>Out time</th>
            </tr>
            </thead>
            <!--        <tfoot>
              <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
              </tr>
          </tfoot>-->
            <tbody>
            <?php
            if ( isset( $data['userAttentInformations'] ) ) {
                $cnt = 1; // for the serial number
                foreach ($data['userAttentInformations'] as $key => $value) {
                    ?>
                    <tr>
                        <td><?php echo $cnt; ?></td>
                        <td><?php echo $value['present_date']; ?></td>
                        <td><?php echo $value['in_time']; ?></td>
                        <td><?php echo $value['out_time']; ?></td>
                    </tr>
                    <?php
                    $cnt++;
                }
            }
            ?>

            </tbody>


        </table>
    </div>
</div>

