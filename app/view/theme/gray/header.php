<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8">

    <?php if( $_SERVER['QUERY_STRING'] == 'url=AttendanceController/attendanceTodayReport'){ ?>
    <meta http-equiv="refresh" content="2" />
    <?php }?>

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
    <link rel="stylesheet" href="app/view/theme/gray/css/style.css" type="text/css">
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

<!-- BEGIN :: LEFT PANEL -->
<div class="leftpanel">

    <!--sidemenu-->
    <div class="nav-side-menu">

        <nav class="navbar navbar-inverse">
            <a class="navbar-brand" href="?url=userController/dashboard"><?php echo APP_TITLE;?></a>
        </nav>

        <div class="menu-list">

            <h6 class="menu-header">MAIN NAVIGATION</h6>

            <ul id="menu-content" class="menu-content">

                <li><a class="active" href="?url=userController/dashboard"><i class="fa fa-dashboard fa-lg"></i><span>Dashboard</span></a></li>

                <li data-toggle="collapse" data-target="#message">

                    <a href="#">
                        <i class="fa fa-desktop fa-lg"></i>
                        <span>Message</span>
                        <span class="pull-right"><i class="fa fa-plus-square"></i></span>
                    </a>

                    <ul class="sub-menu collapse" id="message">
                        <li><a href="?url=messageController/inbox"><i class="fa fa-caret-right"></i>Inbox</a></li>
                        <li><a href="?url=messageController/message"><i class="fa fa-caret-right"></i>Compose</a></li>
                    </ul>
                </li>

                <li data-toggle="collapse" data-target="#users">
                    <a href="#"><i class="fa fa-columns fa-lg"></i><span>Users</span><span class="pull-right"><i
                                class="fa fa-plus-square"></i></span></a>
                    <ul class="sub-menu collapse" id="users">
                        <li><a href="?url=userController/users"><i class="fa fa-caret-right"></i>User Management</a></li>

                    </ul>
                </li>

                <li data-toggle="collapse" data-target="#attendance">
                    <a href="#"><i class="fa fa-columns fa-lg"></i><span>Attendance Report</span><span class="pull-right"><i
                                class="fa fa-plus-square"></i></span></a>
                    <ul class="sub-menu collapse" id="attendance">
                        <li><a href="?url=AttendanceController/attendanceTodayReport"><i class="fa fa-caret-right"></i>Today</a></li>
                        <li><a href="?url=AttendanceController/attendanceYearlyReport"><i class="fa fa-caret-right"></i>Yearly</a></li>
                        <li><a href="?url=AttendanceController/attendanceReportByUser"><i class="fa fa-caret-right"></i>By User</a></li>
                    </ul>
                </li>

                <li data-toggle="collapse" data-target="#discussion">

                    <a href="#"><i class="fa fa-edit fa-lg"></i><span>Discussion</span><span class="pull-right"><i
                                    class="fa fa-plus-square"></i></span></a>

                    <ul class="sub-menu collapse" id="discussion">
                        <li><a href="?url=discussionController/discussion"><i class="fa fa-caret-right"></i>Discussion List</a></li>
                        <li><a href="?url=discussionController/post_discussion"><i class="fa fa-caret-right"></i>Post Topic</a></li>
                    </ul>

                </li>

            </ul>

        </div>

        <div>
            <h6 class="menu-header">UTILITY</h6>
            <ul class="menu-content">
                <li><a href="?url=home/theme/default"><i class="fa fa-adjust text-success"></i>Default</a></li>
                <li><a href="?url=home/theme/gray"><i class="fa fa-adjust text-danger"></i>Gray</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- End Left Panel -->


<!-- BEGIN :: MAIN PANEL -->
<div class="mainpanel">

    <!-- BENGIN :: TOP NAVBAR -->
    <nav class="navbar navbar-default">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="menutoggle"><i class="fa fa-bars"></i></a>
            <a class="navbar-brand-img" href="?url=userController/dashboard">
                <img height="30" src="app/view/theme/gray/images/logo.png" alt="http://rfsoftlab.com"/>
                <span class="visible-sm-inline visible-xs-inline"><?php echo APP_TITLE;?></span>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <form class="navbar-form navbar-left">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="q">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a class="dropdown-toggle tp-icon" data-toggle="dropdown">
                        <i class="fa fa-user"></i><span class="badge">2</span>
                        <span class="visible-xs pull-right">All Your Messages</span>
                    </a>


                    <ul class="dropdown-menu">

                        <li class="title">2 Newly Registered Users</li>
                        <li>
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <div class="pull-left"><img src="app/view/theme/gray/images/photos/profile-01.jpeg" class="img-circle" alt=""/></div>
                                        <h4>John Doe
                                            <small><i class="fa fa-clock-o"></i> 2 mins</small>
                                        </h4>
                                        <p>This is an awesome theme, isn't it?</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="pull-left"><img src="app/view/theme/gray/images/photos/profile-02.jpeg" class="img-circle" alt=""/></div>
                                        <h4>Paul Rick
                                            <small><i class="fa fa-clock-o"></i> 5 hours</small>
                                        </h4>
                                        <p>This is an awesome theme, isn't it?</p>
                                    </a>
                                <li>
                                    <a href="#">
                                        <div class="pull-left"><img src="app/view/theme/gray/images/photos/profile-03.jpeg" class="img-circle" alt=""/></div>
                                        <h4>Danial Ding
                                            <small><i class="fa fa-clock-o"></i> Today</small>
                                        </h4>
                                        <p>This is an awesome theme, isn't it?</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="pull-left"><img src="app/view/theme/gray/images/photos/profile-04.jpeg" class="img-circle" alt=""/></div>
                                        <h4>Richman Due
                                            <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                        </h4>
                                        <p>This is an awesome theme, isn't it?</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="pull-left"><img src="app/view/theme/gray/images/photos/profile-05.jpeg" class="img-circle" alt=""/></div>
                                        <h4>Eric Hadson
                                            <small><i class="fa fa-clock-o"></i> 3 Days</small>
                                        </h4>
                                        <p>This is an awesome theme, isn't it?</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="footer"><a href="#">See All Users</a></li>
                    </ul>
                </li>

                <li>
                    <a class="dropdown-toggle tp-icon" data-toggle="dropdown">
                        <i class="fa fa-envelope"></i><span class="badge">10</span>
                        <span class="visible-xs pull-right">Your Current Notification</span>
                    </a>
                    <ul class="dropdown-menu">

                        <li class="title">10 Notification found</li>
                        <li>
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user text-warning"></i> 100 New visitor today.
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-key text-danger"></i> Admin password changed.
                                    </a>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-shopping-cart text-success"></i> 10 new sales today.
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-gear text-info"></i> Settings has been changed.
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-calendar text-primary"></i> Your calendar updated.
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-envelope-o"></i> 5 mail received.
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="footer"><a href="#">See All Message</a></li>
                    </ul>
                </li>

                <li>
                    <a class="dropdown-toggle tp-icon" data-toggle="dropdown">
                        <i class="fa fa-globe"></i><span class="badge">2</span>
                        <span class="visible-xs pull-right">Tasks to be completed</span>
                    </a>

                    <ul class="dropdown-menu">

                        <li class="title">10 Notification found</li>
                        <li>
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <h5>New theme started
                                            <small class="pull-right">40%</small>
                                        </h5>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-success" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">40% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <h5>Sidebar all menu
                                            <small class="pull-right">70%</small>
                                        </h5>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-danger" style="width: 70%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">40% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                <li>
                                    <a href="#">
                                        <h5>Theme modification completed
                                            <small class="pull-right">80%</small>
                                        </h5>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-warning" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">40% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <h5>Update client info
                                            <small class="pull-right">20%</small>
                                        </h5>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-info" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">40% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <h5>Form modification
                                            <small class="pull-right">40%</small>
                                        </h5>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-striped" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">40% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <h5>Finalize the project
                                            <small class="pull-right">40%</small>
                                        </h5>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-danger" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">40% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="footer"><a href="#">See All Notification</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="app/view/theme/gray/images/photos/index.png" alt=""><?php echo Session::get("user_first_name")?>;<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-usermenu">
                        <li><a href="features-profile.html"><i class="fa fa-user"></i> My Profile</a></li>
                        <li><a href="#"><i class="fa fa-cog"></i> Account Settings</a></li>
                        <li><a href="#"><i class="fa fa-question-circle-o"></i> Help</a></li>
                        <li><a href="?url=userController/logout"><i class="fa fa-sign-out"></i> Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
    <!-- End Top Navbar -->

    <!-- starting breadcrumb with header-->
    <section class="pageheader">
        <h2><i class=" fa fa-home"></i> <?php echo Document::$headertitle;?></h2>
        <div class="breadcrumb-wrapper hidden-xs">
            <span class="label label-info">YOU ARE HERE</span>
            <ol class="breadcrumb">
                <li><a href="index.html"><?php echo APP_TITLE;?></a></li>
                <li class="active"><?php echo Document::$title;?></li>
            </ol>
        </div>
    </section>
    <!-- ending breadcrumb-->

