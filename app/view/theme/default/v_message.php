<!--User Registration -->
<div class="container">

    <div class="col-lg-5">
        <div class="panel">
            <div class="panel-primary  ">
                <div class="panel-heading">
                    <h2>Compose Message</h2>
                </div>
                <div class="panel-body">
                    <div style="max-width: 600px; margin: 0 auto">

                        <form action="<?php echo BASE_URL ?>index.php?url=messageController/insert"
                              method="POST">
                            <div class="form-group row">

                                <label for="ref_to_user_id" class="col-sm-4 col-form-label">To</label>
                                <div class="col-sm-8">
                                    <select name="ref_to_user_id">
                                        <option value="0">Select User</option>

                                        <?php
                                            if ($data['user_list']){
                                                foreach ($data['user_list'] as $key2 => $value2) { ?>
                                                    <option value="<?php echo $value2['ref_user_id']; ?>"><?php echo $value2['user_first_name'] . " " . $value2['user_last_name']; ?></option>
                                                <?php }
                                            } ?>

                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="message_subject" class="col-sm-4 col-form-label">Subject</label>
                                <div class="col-sm-8">
                                    <input type="text" id="message_subject" name="message_subject"
                                           class="form-control" required="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="message_detail" class="col-sm-4 col-form-label">Message</label>
                                <div class="col-sm-8">
                                        <textarea rows="5" id="message_detail" name="message_detail"
                                                  class="form-control" value=""></textarea>
                                </div>
                            </div>

                            <div style="text-align: center">
                                <div style="display: inline-block">
                                    <button type="submit" name="register" class="btn btn-success">Send</button>
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
                    <h2>Inbox <span class="pull-right"></h2>
                </div>
                <div class="panel-body" style="padding-left: 1px">
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>From</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th width="100px">Action</th>
                        </tr>

                        <?php
                            if ($data['message']) {

                                $cnt = 1; // for the serial number
                                foreach ($data['message'] as $key => $value) {
                                    ?>
                                    <tr>

                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $value['message_doc']; ?></td>
                                        <td><?php echo $value['user_first_name'] . " " . $value['user_last_name']; ?></td>
                                        <td><?php echo $value['message_subject']; ?></td>
                                        <td><?php echo $value['message_detail']; ?></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a href="<?php echo BASE_URL ?>index.php?url=messageController/messageDelete/<?php echo $value['id']; ?>"><i
                                                                class="fa fa-times" aria-hidden="true"></i></a>
                                                    <div class="col-sm-6">
                                                        <a href=""><i
                                                                    class="fa fa-reply" aria-hidden="true"></i></a>
                                                    </div>
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