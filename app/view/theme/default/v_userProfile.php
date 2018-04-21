<!--User Profile -->
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div style="max-width: 600px; margin: 0 auto">
                <?php

                    if ($data) {
                        //print_r($data);
                        ?>
                        <table id="data_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <div class="form-group row">
                                <label for="user_name" class="col-sm-4 col-form-label">Username</label>
                                <div class="col-sm-8"><?php echo $data['user_name']; ?>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_first_name" class="col-sm-4 col-form-label">First Name</label>
                                <div class="col-sm-8"><?php echo $data['user_first_name']; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_last_name" class="col-sm-4 col-form-label">Last Name</label>
                                <div class="col-sm-8"><?php echo $data['user_last_name']; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_phone" class="col-sm-4 col-form-label">Phone</label>
                                <div class="col-sm-8"><?php echo $data['user_phone']; ?>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="user_dob" class="col-sm-4 col-form-label">Date of Birth</label>
                                <div class="col-sm-8"><?php echo $data['user_dob']; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_sex" class="col-sm-4 col-form-label">Sex</label>
                                <div class="col-sm-8"><?php echo $data['user_sex']; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_address" class="col-sm-4 col-form-label">Address</label>
                                <div class="col-sm-8"><?php echo $data['user_address']; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_rfid" class="col-sm-4 col-form-label">RFID</label>
                                <div class="col-sm-8"><?php echo $data['user_rfid']; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_email" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8"><?php echo $data['user_email']; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ref_user_role_id" class="col-sm-4 col-form-label">Role</label>
                                <div class="col-sm-8">
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
                                </div>
                            </div>

                        </table>
                    <?php } ?>
            </div>
        </div>

    </div>
</div>


