    <!--User Registration -->
    <div class="container">

        <div class="col-lg-5">
            <div class="panel">
                <div class="panel-primary  ">
                    <div class="panel-heading">
                        <h2>User <?php if ($_GET['url'] == 'userController/users') {
                                echo "Registration";
                            }
                            else {
                                echo "Profile Update";
                            } ?></h2>
                    </div>
                    <div class="panel-body">
                        <div style="max-width: 600px; margin: 0 auto">

                            <form action="<?php echo BASE_URL ?>index.php?url=userController/put" method="POST"/>

                            <input type="hidden" name="pid" value="<?php echo $data['id'] ?>"/>

                            <div class="form-group row">
                                <label for="user_name" class="col-sm-4 col-form-label">Username</label>
                                <div class="col-sm-8">
                                    <input type="text" id="user_name" name="user_name" class="form-control"
                                           value="<?php echo $data['user_name'] ?>" required="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_first_name" class="col-sm-4 col-form-label">First Name</label>
                                <div class="col-sm-8">
                                    <input type="text" id="user_first_name" name="user_first_name"
                                           class="form-control" value="<?php echo $data['user_first_name'] ?>"
                                           required="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_last_name" class="col-sm-4 col-form-label">Last Name</label>
                                <div class="col-sm-8">
                                    <input type="text" id="user_last_name" name="user_last_name"
                                           class="form-control" value="<?php echo $data['user_last_name'] ?>"
                                           required="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_phone" class="col-sm-4 col-form-label">Phone</label>
                                <div class="col-sm-8">
                                    <input type="text" id="user_phone" name="user_phone" class="form-control"
                                           value="<?php echo $data['user_phone'] ?>" required="">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="user_dob" class="col-sm-4 col-form-label">Date of Birth</label>
                                <div class="col-sm-8">
                                    <input type="date" id="user_dob" name="user_dob" class="form-control"
                                           value="<?php echo $data['user_dob'] ?>" required="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_sex" class="col-sm-4 col-form-label">Sex</label>
                                <div class="col-sm-8">
                                    <label class="radio-inline">
                                        <input type="radio" name="user_sex" value="male" > Male
                                    </label>
                                    <label class="radio-inline">
                                    <input type="radio" name="user_sex" value="female"> Female<br>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_address" class="col-sm-4 col-form-label">Address</label>
                                <div class="col-sm-8">
                                    <textarea rows="5" id="user_address" name="user_address" class="form-control"
                                           value="<?php echo $data['user_address'] ?>" required=""></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_rfid" class="col-sm-4 col-form-label">RFID</label>
                                <div class="col-sm-8">
                                    <input type="text" id="user_rfid" name="user_rfid" class="form-control"
                                           value="<?php echo $data['user_rfid'] ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_email" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" id="user_email" name="user_email" class="form-control"
                                           value="<?php echo $data['user_email'] ?>" required="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ref_user_role_id" class="col-sm-4 col-form-label">Role ID</label>
                                <div class="col-sm-8">
                                    <label class="radio-inline">
                                    <input type="radio" name="ref_user_role_id" value="1"
                                           <?php if ($data['ref_user_role_id'] == 1) { ?>checked <?php } ?>>Admin</label>
                                    <label class="radio-inline">
                                    <input type="radio" name="ref_user_role_id" value="2"
                                           <?php if ($data['ref_user_role_id'] == 2) { ?>checked <?php } ?>>Manager</label>
                                    <label class="radio-inline">
                                    <input type="radio" name="ref_user_role_id" value="3"
                                           <?php if ($data['ref_user_role_id'] == 3) { ?>checked <?php } ?>>Attendee</label>
                                        </label>
                                </div>
                            </div>


                            <div style="text-align: center">
                                <div style="display: inline-block">
                                    <button type="submit" name="register"
                                            class="btn btn-success"><?php echo $data['btn_action'] ?></button>
                                </div>
                                <div style="display: inline-block">
                                    <button type="" name="" class="btn btn-danger">Cancel</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="col-lg-7">
            <div class="panel">
                <div class="panel-primary">
                    <div class="panel-heading">
                        <h2>User List <span class="pull-right"></h2>
                    </div>
                    <div class="panel-body" style="padding-left: 1px">
                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th width="100px">Action</th>
                            </tr>

                            <?php
                                if ($data['users']) {
                                    $cnt = 1; // for the serial number
                                    foreach ($data['users'] as $key => $value) {
                                        ?>
                                        <tr>

                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo $value['user_name']; ?></td>
                                            <td><?php echo $value['user_first_name'] . " " . $value['user_last_name']; ?></td>
                                            <td><?php echo $value['user_email']; ?></td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <a href="<?php echo BASE_URL ?>index.php?url=userController/userProfile/<?php echo $value['id']; ?>"><i
                                                                    class="fa fa-eye" aria-hidden="true"></i></a>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <a href="<?php echo BASE_URL ?>index.php?url=userController/users/<?php echo $value['id']; ?>"><i
                                                                    class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <a href="<?php echo BASE_URL ?>index.php?url=userController/userDelete/<?php echo $value['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i
                                                                    class="fa fa-times" aria-hidden="true"></i></a>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        $cnt++;
                                    }
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>