<!--User Profile
<div>
    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-primary  ">
                <div class="panel-body">
                    <div style="max-width: 600px; margin: 0 auto">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->


<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad">

    <?php if ($data) { ?>


    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title" style="text-align: center; font-size: 25px;">
                <strong><?php echo $data['user_first_name'] . " " . $data['user_last_name']; ?></strong></div>
        </div>
        <div class="panel-body">
            <div>
                <td class=" col-md-9 col-lg-9 ">
                    <table class="table table-striped table-bordered">
                        <tbody>
                        <tr>
                            <td>Username:</td>
                            <td><?php echo $data['user_name']; ?></td>
                        </tr>
                        <tr>
                            <td>First Name:</td>
                            <td><?php echo $data['user_first_name']; ?></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><?php echo $data['user_last_name']; ?></td>
                        </tr>


                        <tr>
                            <td>Phone</td>
                            <td><?php echo $data['user_phone']; ?></td>
                        </tr>
                        <tr>
                            <td>Date of Birth</td>
                            <td><?php echo $data['user_dob']; ?></td>
                        </tr>
                        <tr>
                            <td>Sex</td>
                            <td><?php echo $data['user_sex']; ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><?php echo $data['user_address']; ?></td>
                        </tr>
                        <tr>
                            <td>RFID</td>
                            <td><?php echo $data['user_rfid']; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $data['user_email']; ?></td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td>
                                <?php if ($data['ref_user_role_id'] == 1) {
                                    echo "Admin";
                                }
                                else {
                                    if ($data['ref_user_role_id'] == 2) {
                                        echo "Manager";
                                    }
                                    else {
                                        echo "Attendee";
                                    }
                                } ?>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <?php } ?>
            </div>
        </div>
    </div>


</div>

