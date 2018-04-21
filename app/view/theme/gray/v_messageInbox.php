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

        <div class="col-sm-9 col-lg-10">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="pull-right">
                        <div class="btn-group mr10">
                            <button class="btn btn-sm btn-white1 tooltips" type="button" data-toggle="tooltip"
                                    title="Archive"><i class="glyphicon glyphicon-hdd"></i></button>
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

                                    $cnt = 1; // for the serial number
                                    foreach ($data as $key => $value) {
                                        ?>

                                        <tr>
                                            <td>
                                                <div class="ckbox ckbox-success">
                                                    <input type="checkbox" id="<?php echo $value['id']; ?>checkbox1">
                                                    <label for="<?php echo $value['id']; ?>checkbox1"></label>
                                                </div>
                                            </td>
                                            <td><a href="" class="star"><i class="glyphicon glyphicon-star"></i></a>
                                            </td>
                                            <td onclick="window.location='?url=messageController/fullMessage/<?php echo $value['id']; ?>';">
                                                <div class="media"><a href="#" class="pull-left"> <img alt=""
                                                                                                       src="images/photos/user3.png"
                                                                                                       class="media-object">
                                                    </a>
                                                    <div class="media-body"><span
                                                                class="media-meta pull-right"><?php echo $value['message_doc']; ?></span>
                                                        <h4 class="text-primary" style="display: inline"><?php echo $value['user_first_name'] . " " . $value['user_last_name']; ?></h4>
                                                        <small class="text-muted"></small>
                                                        <p class="email-summary" style="display: inline">
                                                            <strong><?php echo $value['message_subject']; ?></strong> | <p class="text-muted" style="display: inline-block"><?php echo substr($value['message_detail'],0, 20).'...'; ?></p>
                                                            </p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <?php
                                        $cnt++;
                                    }
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- table-responsive -->
                </div>
            </div>
        </div>
    </div>
</div>



