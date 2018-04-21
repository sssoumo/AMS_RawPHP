<div class="col-lg-7">
    <div >
        <div >

            <div class="panel-body" >
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

