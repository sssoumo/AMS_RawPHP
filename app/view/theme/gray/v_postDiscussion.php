<div class="content">
    <div class="row">
        <div class="col-sm-3 col-lg-2"><a href="?url=discussionController/discussion""
            class="btn btn-info btn-block btn-compose-email">Go To Forum</a>
        </div>

        <div class="col-sm-9 col-lg-10">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div style="max-width: 600px; margin: 0 auto">

                        <form action="<?php echo BASE_URL ?>index.php?url=discussionController/insert"
                              method="POST">

                            <div class="form-group row">
                                <label for="category_title" class="col-sm-4 col-form-label">Category</label>
                                <div class="col-sm-8">
                                    <select name="category_title">
                                        <option value="0">Select Category</option>
                                        <?php if ($data) {

                                            foreach ($data as $key2 => $value2) { ?>
                                                <option value="<?php echo $value2['id']; ?>"><?php echo $value2['category_title']; ?></option>
                                            <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="discussion_title" class="col-sm-4 col-form-label">Title</label>
                                <div class="col-sm-8">

                                    <input type="text" id="discussion_title" name="discussion_title"
                                           class="form-control"
                                           required="">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="discussion_post" class="col-sm-4 col-form-label">Discussion</label>
                                <div class="col-sm-8">
                                        <textarea rows="20" id="discussion_post" name="discussion_post"
                                                  class="form-control"></textarea>
                                </div>
                            </div>


                                <div style="text-align: center">
                                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
