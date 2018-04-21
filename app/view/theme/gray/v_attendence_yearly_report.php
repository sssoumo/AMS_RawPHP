<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-btns"> <a class="minimize"><i class="fa fa-minus"></i></a> <a class="panel-close"><i class="fa fa-times"></i></a> </div>
        <table id="data_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Number of Present Days</th>
                <th>Number of Leave Days</th>
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
            if ($data['yearlyInformations']) {
                $cnt = 1; // for the serial number
                foreach ($data['yearlyInformations'] as $key => $value) {
                    ?>
                    <tr>

                        <td><?php echo $cnt; ?></td>
                        <td><?php echo $value['user_first_name'] . " " . $value['user_last_name']; ?></td>
                        <td><?php echo $value['user_email']; ?></td>
                        <td><?php echo $value['user_phone']; ?></td>
                        <td><?php echo $value['attendance_total']; ?></td>
                        <td><?php echo $value['leave_total']; ?></td>

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

