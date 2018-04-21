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
            if ($data['dailyInformations']) {
                $cnt = 1; // for the serial number
                foreach ($data['dailyInformations'] as $key => $value) {
                    ?>
                    <tr>

                        <td><?php echo $cnt; ?></td>
                        <td><?php echo $value['user_first_name'] . " " . $value['user_last_name']; ?></td>
                        <td><?php echo $value['user_email']; ?></td>
                        <td><?php echo $value['user_phone']; ?></td>
                        <td class="text-red"><?php echo $value['in_time']; ?></td>
                        <td class="text-primary"><?php echo $value['out_time']; ?></td>

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

