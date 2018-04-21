<?php
    if ($data) {

        ?><h1><?php echo $data['discussion_title']; ?></h1>
        <p><?php echo $data['discussion_post']; ?></p>

        <?php
    }

?>

    <h3>Comment</h3>


    <form action="<?php echo BASE_URL ?>index.php?url=discussionController/reply"
          method="POST">


        <div class="form-group row">
            <label for="reply_text" class="col-sm-4 col-form-label">Reply</label>
            <div class="col-sm-8">
                                        <textarea rows="5" id="reply_text" name="reply_text"
                                                  class="form-control" value=""></textarea>
            </div>
        </div>

        <div style="display: inline-block">
            <button type="submit" name="submit" class="btn btn-success">Reply</button>
        </div>