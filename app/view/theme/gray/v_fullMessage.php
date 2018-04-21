<!-- BEGIN :: CONTENT -->
<div class="content">
    <div class="row">
        <div class="col-sm-3 col-lg-2"><a href="?url=messageController/message"
                                          class="btn btn-danger btn-block btn-compose-email">Compose Email</a>
            <ul class="nav nav-pills nav-stacked nav-email">
                <li class="active"><a href="?url=messageController/inbox"> <span class="badge pull-right"></span> <i
                                class="glyphicon glyphicon-inbox"></i> Inbox </a></li>
                <li><a href="#"><i class="glyphicon glyphicon-star"></i> Starred</a></li>
                <li><a href="?url=messageController/sentMessage"><i class="glyphicon glyphicon-send"></i> Sent Mail</a>
                </li>
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

        <div class="col-sm-9 col-lg-10">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="pull-right">
                        <div class="btn-group mr10">
                            <button class="btn btn-sm btn-white1 tooltips" type="button" data-toggle="collapse" data-target="#demo"
                                    title="Reply"><i class="fa fa-reply"></i></button>
                            <button class="btn btn-sm btn-white1 tooltips" type="button" data-toggle="tooltip"
                                    title="Report Spam"><i class="glyphicon glyphicon-exclamation-sign"></i></button>
                            <button class="btn btn-sm btn-white1 tooltips" type="button" data-toggle="tooltip"
                                    title="Delete"><i class="glyphicon glyphicon-trash"></i></button>
                        </div>
                        <div class="btn-group mr10">
                            <div class="btn-group nomargin">
                                <button data-toggle="dropdown" class="btn btn-sm btn-white1  tooltips"
                                        title="Move to Folder"><i class="glyphicon glyphicon-folder-close mr5"></i>
                                    <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="glyphicon glyphicon-folder-open mr5"></i> Conference</a>
                                    </li>
                                    <li><a href="#"><i class="glyphicon glyphicon-folder-open mr5"></i> Newsletter</a>
                                    </li>
                                    <li><a href="#"><i class="glyphicon glyphicon-folder-open mr5"></i> Invitations</a>
                                    </li>
                                    <li><a href="#"><i class="glyphicon glyphicon-folder-open mr5"></i> Promotions</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="btn-group nomargin">
                                <button data-toggle="dropdown" class="btn btn-sm btn-white1 dropdown-toggle tooltips"
                                        type="button" title="Label"><i class="glyphicon glyphicon-tag mr5"></i> <span
                                            class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="glyphicon glyphicon-tag mr5"></i> Web</a></li>
                                    <li><a href="#"><i class="glyphicon glyphicon-tag mr5"></i> Photo</a></li>
                                    <li><a href="#"><i class="glyphicon glyphicon-tag mr5"></i> Video</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-white1" type="button"><i
                                        class="glyphicon glyphicon-chevron-left"></i></button>
                            <button class="btn btn-sm btn-white1" type="button"><i
                                        class="glyphicon glyphicon-chevron-right"></i></button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-email">

                            <?php
                                if ($data) {
                                foreach ($data as $key => $value) { ?>

                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="pull-right">
                                        <?php echo $value['message_doc']; ?>
                                    </div>
                                    <h4><?php echo $value['message_subject']; ?></h4>

                                    <hr>
                                    <strong><?php echo $value['user_first_name'] . " " . $value['user_last_name']; ?></strong></br>

                                </div>

                                <div class="panel-body">
                                    <?php echo nl2br($value['message_detail']); ?>
                                </div>
                            </div>

                            <div class="collapse" id="demo">
                                <form action="<?php echo BASE_URL ?>index.php?url=messageController/replyMessage/<?php echo $value['id']; ?>" method="POST">
                                    <input type="hidden" name="message_subject" value="<?php echo $value['message_subject'] ?>"/>
                                    <input type="hidden" name="ref_to_user_id" value="<?php echo $value['ref_from_user_id'] ?>"/>
                                    <div class="form-group">
                                        <label for="message_detail">Reply:</label>
                                        <textarea id="message_detail" name="message_detail" placeholder="Your message here..."
                                                  class="form-control" rows="2"></textarea>
                                    </div>
                                    <button type="submit" name="register" class="btn btn-success">Send</button>
                                </form>
                            </div>

                        </table>
                    </div>

                    <?php
                        }
                        }
                    ?>


                </div>
            </div>
        </div>
    </div>
</div>




