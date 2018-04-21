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


<?php if ($data){?>
<div class="login-box">
    <h2><a href="<?php echo BASE_URL ?>"><b>RF</b>Attendance</a></h2>
    <div>
        <p class="text-center alert alert-success">A confirmation Mail has been sent!!!</p>
        <p><?php echo $data; ?></p>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php }else{?>
<div class="login-box">
    <h2><a href="<?php echo BASE_URL ?>"><b>RF</b>Attendance</a></h2>
    <div>
        <p class="text-center alert alert-danger">No Such Email Found in Database</p>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php }?>




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