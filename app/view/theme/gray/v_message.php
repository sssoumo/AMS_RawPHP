<!-- BEGIN :: CONTENT -->
<div class="content">
    <div class="row">
        <div class="col-sm-3 col-lg-2"><a href="?url=messageController/message"
                                          class="btn btn-danger btn-block btn-compose-email">Compose Email</a>
            <ul class="nav nav-pills nav-stacked nav-email">
                <li class="active"><a href="?url=messageController/inbox"> <span class="badge pull-right"></span> <i
                                class="glyphicon glyphicon-inbox"></i> Inbox </a></li>
                <li><a href="#"><i class="glyphicon glyphicon-star"></i> Starred</a></li>
                <li><a href="?url=messageController/sentMessage"><i class="glyphicon glyphicon-send"></i> Sent Mail</a></li>
                <li><a href="#"> <span class="badge pull-right">3</span> <i class="glyphicon glyphicon-pencil"></i>
                        Draft </a></li>
                <li><a href="#"><i class="glyphicon glyphicon-trash"></i> Trash</a></li>
            </ul>
            <div class="mb30"></div>
            <h4>Folders</h4>
            <ul class="nav nav-pills nav-stacked nav-email mb20">
                <li><a href="email-inbox.html"> <span class="badge pull-right">2</span> <i
                                class="glyphicon glyphicon-folder-open"></i> Conference </a></li>
                <li><a href="#"><i class="glyphicon glyphicon-folder-open"></i> Newsletter</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-folder-open"></i> Invitations</a></li>
                <li><a href="#"> <i class="glyphicon glyphicon-folder-open"></i> Promotions </a></li>
            </ul>
        </div>

        <!-- col-sm-3 -->

        <!-- BEGIN :: CONTENT -->


        <div class="col-sm-9 col-lg-10">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="<?php echo BASE_URL ?>index.php?url=messageController/insert"
                          method="POST">
                        <div class="form-group mb5">
                            <h5>Enter Recipients</h5>
                            <select name="ref_to_user_id">
                                <option value="0">Select User</option>

                                <?php
                                    if ($data) {
                                        foreach ($data as $key2 => $value2) { ?>
                                            <option value="<?php echo $value2['ref_user_id']; ?>"><?php echo $value2['user_first_name'] . " " . $value2['user_last_name']; ?></option>
                                        <?php }
                                    } ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" name="message_subject" placeholder="Subject" class="form-control"/>
                        </div>
                        <textarea id="message_detail" name="message_detail" placeholder="Your message here..."
                                  class="form-control" rows="20"></textarea>

                        <!-- panel-body -->
                        <div class="panel-footer">
                            <button type="submit" name="register" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
                <!-- panel -->
            </div>
        </div>
    </div>
</div>

