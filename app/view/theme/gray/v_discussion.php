<!-- BEGIN :: CONTENT -->
<div class="content">
    <div class="row">
        <div class="col-sm-3 col-lg-2"><a href="?url=discussionController/post_discussion""
            class="btn btn-info btn-block btn-compose-email">Post A Discussion</a>


        </div>

        <div class="col-sm-9 col-lg-10">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="discussion">

                        <?php
                            if ($data) {

                            $cnt = 1; // for the serial number
                            foreach ($data as $key => $value) {
                        ?>
                        <div class="media">
                            <div class="media-left"
                            <h4><strong><?php echo $value['discussion_title']; ?></strong></h4>
                            <div class="media-body">
                                <p><?php echo $value['discussion_post']; ?></p>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6"><em>-<strong><?php echo $value['user_first_name'] ?></strong></em></div>
                            <div class="col-sm-6"><span class="pull-right">
                                                    <a href="#">32 Comments</a> |
                                                    <a href="#demo_<?php echo $value['id']; ?>" data-toggle="collapse">Reply</a></span>
                            </div>
                        </div>

                        <div class="panel-collapse collapse" id="demo_<?php echo $value['id']; ?>">

                            <div class="reply">
                                <form action="<?php echo BASE_URL ?>index.php?url=discussionController/reply/<?php echo $value['id']; ?>"
                                      method="POST">
                                                <textarea class="form-control" name="reply_text"
                                                          rows="3"></textarea><br>
                                    <button type="submit" class="btn btn-success pull-right">Submit</button>
                                </form>
                            </div>
                            <h3>Comments</h3>
                            <?php foreach ($value['reply'] as $key2 => $value2) { ?>
                                <div class="media">
                                    <div class="media-left">
                                        <div class="comments_wrapper">
                                            <div class="comment">

                                                <p class="comments"><?php echo $value2['reply_text']; ?></p>
                                                <p class="comment_author">
                                                    -<strong><?php echo $value2['user_first_name']; ?></strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } // foreach reply ?>

                        </div>
                    </div>
                    <?php
                        $cnt++;
                        } // foreach discussion  ?><?php
                        } // if discussion ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
