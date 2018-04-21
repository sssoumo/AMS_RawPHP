    <!--User Registration -->
    <div class="container">

        <div class="col-lg-5">
            <div class="panel">
                <div class="panel-primary  ">
                    <div class="panel-heading">
                        <h2>Start A New Discussion</h2>
                    </div>
                    <div class="panel-body">
                        <div style="max-width: 600px; margin: 0 auto">

                            <form action="<?php echo BASE_URL ?>index.php?url=discussionController/insert"
                                  method="POST">


                                <div class="form-group row">
                                    <label for="discussion_title" class="col-sm-4 col-form-label">Title</label>
                                    <div class="col-sm-8">

                                        <input type="text" id="discussion_title" name="discussion_title"
                                               class="form-control"
                                               required="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="category_title" class="col-sm-4 col-form-label">Category</label>
                                    <div class="col-sm-8">
                                        <select name="category_title">
                                            <option value="0">Select Category</option>
                                            <?php if ($data['category']) {

                                                foreach ($data['category'] as $key2 => $value2) { ?>
                                                    <option value="<?php echo $value2['id']; ?>"><?php echo $value2['category_title']; ?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="discussion_post" class="col-sm-4 col-form-label">Discussion</label>
                                    <div class="col-sm-8">
                                        <textarea rows="5" id="discussion_post" name="discussion_post"
                                                  class="form-control"></textarea>
                                    </div>
                                </div>

                                <div style="text-align: center">
                                    <div style="display: inline-block">
                                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
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
                        <h2>Discussions <span class="pull-right"></h2>
                    </div>
                    <div class="panel-body">


                        <div class="discussion">
                            <?php
                                if ($data['discussion']) {

                                    $cnt = 1; // for the serial number
                                    foreach ($data['discussion'] as $key => $value) {
                                        ?>
                                        <h4><?php echo $value['discussion_title']; ?></h4>
                                        <p><?php echo $value['discussion_post']; ?></p>

                                        <div class="row">
                                            <div class="col-sm-6"><em>- <?php echo $value['user_first_name'] ?></em></div>
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
                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                </form>
                                            </div>

                                            <?php foreach ($value['reply'] as $key2 => $value2) { ?>

                                                <div class="comments_wrapper">
                                                    <div class="comment">
                                                        <p class="comments"><?php echo $value2['reply_text']; ?></p>
                                                        <p class="comment_author">
                                                            -<?php echo $value2['user_first_name']; ?></p>
                                                    </div>
                                                </div>

                                            <?php } // foreach reply ?>

                                        </div>

                                        <?php
                                        $cnt++;
                                    } // foreach discussion  ?> <?php
                                } // if discussion ?>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    </div>