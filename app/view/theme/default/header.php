<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo Document::$title;?></title>

    <link rel="stylesheet" href="app/view/vendor/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="app/view/vendor/font-awesome/4.7.0/css/font-awesome.min.css">

    <?php if(isset(Document::$css) && !empty(Document::$css)) foreach (Document::$css as $key => $file) echo '<link rel="stylesheet" href="'.$file.'"/>'."\r\n"; ?>

    <link rel="stylesheet" href="app/view/default/css/style.css"/>

</head>

<body>
<!--header -->
<div class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="?url=userController/login"><?php echo APP_TITLE;?></a>
            </div>
            <ul class="nav navbar-nav pull-right">
                <?php
                $userlogin = Session::get("login");
                if ($userlogin) {
                    ?>
                    <li><a href="?url=messageController/message">Message</a></li>
                    <li><a href="?url=userController/users">User Management</a></li>
                    <li><a href="?url=discussionController/discussion">Discussion</a></li>
                    <li><a href="?url=userController/logOut">Log Out</a></li>
                <?php } else { ?>
                    <li><a href="?url=userController/login">Login</a></li>
                <?php } ?>
                <li><a href="#">Change Theme</a>
                    <ul>
                        <li><a href="?url=home/theme/default">Default</a></li>
                        <li><a href="?url=home/theme/gray">Gray</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>
