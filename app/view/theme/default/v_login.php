<!--Body -->
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>User Login</h2>
        </div>
        <div class="panel-body">
            <div style="max-width: 600px; margin: 0 auto">

                <form action="<?php echo BASE_URL ?>index.php?url=userController/loginAuth" method="POST">
                    <div class="form-group">
                        <label for="login_username">Username</label>
                        <input type="text" id="login_username" name="login_username" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="login_password">Password</label>
                        <input type="password" id="login_password" name="login_password" class="form-control">
                    </div>
                    <button type="submit" name="login" class="btn btn-success">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
