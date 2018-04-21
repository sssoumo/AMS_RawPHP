<!--Body -->
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php
            $userFirstName = session::get("user_first_name"); ?>
            <h2>Home <span class="pull-right">Welcome! <strong><?php echo $userFirstName?></strong></span></h2>
        </div>
        <div class="panel-body">
            <div class="container-fluid col-lg-6">
                <h4 class=""> <?php
                    $timezone = date_default_timezone_set('Asia/Dhaka');
                    $date = date('m/d/Y h:i:s a', time());
                    echo "The current time is: " . $date;
                    ?></h4></br>
                <h3>In Time</h3>
                <h2 class="">
                    <input type="radio" name="attend" value="present">P

                    <div class=""><button class="btn btn-success" type="submit" name="submit">Submit</button></div>
            </div>

            <div class="container-fluid col-lg-6">
                <h4 class=""> <?php echo date("Y/m/d"); ?></h4></br>
                <h3>Out Time</h3>
                <h2 class="">
                    <input type="radio" name="attend" value="present">P

                    <div class=""><button class="btn btn-success" type="submit" name="submit">Submit</button></div>
            </div>
        </div>
    </div>
</div>