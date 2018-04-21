<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8">
    <title><?php echo Document::$title;?></title>

    <meta name="description" content="<?php echo Document::$title;?>" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" type="text/css" href="app/view/vendor/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="app/view/vendor/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="app/view/vendor/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->
    <?php if(isset(Document::$css) && !empty(Document::$css)) foreach (Document::$css as $key => $file) echo '<link rel="stylesheet" href="'.$file.'"/>'."\r\n"; ?>

    <!-- default style for all pages -->
    <link rel="stylesheet" href="app/view/theme/gray/css/login.css" type="text/css">
    <link rel="stylesheet" href="app/view/theme/gray/css/media.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>


<div class="login-box">
    <h2><a href="<?php echo BASE_URL ?>"><b>RF</b>Attendance</a></h2>
    <div class="login-body">
        <p class="text-center">Sign in to start your session</p>

        <form action="<?php echo BASE_URL ?>index.php?url=userController/loginAuth" method="POST">
            <div class="form-group has-feedback">
                <input type="text" id="login_username" name="login_username" class="form-control">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" id="login_password" name="login_password" class="form-control">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-linkedin"></i> Sign up using
                Linkedin</a>
            <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                Google+</a>
        </div>
        <!-- /.social-auth-links -->

        <a href="<?php echo BASE_URL ?>index.php?url=userController/forgotPassword">I forgot my password</a><br>
        <a href="#" onclick="alert('This will goes to a page where a company send their name and address to contact.')" class="text-center">Request a new Account</a>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->



<script src="app/view/vendor/js/jquery-1.12.1.min.js"></script>
<script src="app/view/vendor/js/bootstrap.min.js"></script>
<script src="app/view/vendor/js/toggles.min.js"></script>

<!-- Auto Expanding Text Area -->
<script src="app/view/vendor/js/jquery.autogrow.js"></script>

<script src="app/view/vendor/js/collapse.js"></script>

<script src="app/view/vendor/js/custom.js"></script>

<!-- Page specific Javascript-->
<?php if(isset(Document::$js) && !empty(Document::$js)) foreach (Document::$js as $key => $file) echo '<script src="'.$file.'"></script>'."\r\n";?>

<!-- Custom JS goes here -->

</body>
</html>