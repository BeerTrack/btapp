
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BeerTrack | Dashboard</title>

        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../../assets/css/btapp-custom-styles.css" rel="stylesheet" type="text/css" />
        <link href="../../../assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="../../../assets/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

        <!-- Start Copy Footer -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>
        <!-- FLOT CHARTS -->
        <script src="../../../assets/js/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
        <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
        <script src="../../../assets/js/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
        <!-- morris JS was here, moved to footer by Phil...-->
        <!-- Sparkline -->
        <script src="../../../assets/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="../../../assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="../../../assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="../../../assets/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="../../../assets/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- daterange picker -->
        <link href="../../../assets/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- datepicker -->
        <script src="../../../assets/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->    
        <script src="../../../assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="../../../assets/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- DataTables JS was here, moved to footer by Phil -->
        <!-- Admin LTE theme JS was here, moved to footer by Phil-->


        <!-- End Copy Footer -->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="/" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->

                <img src="../../../LogoBW.png" alt="BeerTrack Logo" style="margin-top:6px">

            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle dropdown-notification-toggle" style="line-height: 20px" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>

<?php
$queryNotifications = "SELECT COUNT(*) FROM notifications WHERE status = 1"; 
$count = beerTrackDBQuery($queryNotifications);
$count1 = mysqli_fetch_array($count);
?>
                                <span class="label label-warning"><?php echo $count1[0]; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have <?php echo $count1[0]; ?> notifications</li>
                                <li>

                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
<?php
$queryNotifications = "SELECT * FROM notifications WHERE status = 1"; 
$listOfNotifications = beerTrackDBQuery($queryNotifications);

$counter = 0;
while($listOfNotifications1 = mysqli_fetch_array($listOfNotifications)){
    echo ($listOfNotifications1['subject']);
    if ($listOfNotifications1['subject'] === "New Store Added")
?>
                                        <li>
                                            <a href="http://localhost:8888/app/global/dashboard/?viewName=notifications">
                                                <i class="ion ion-ios7-people info"></i>New Store Added
                                            </a>
                                        </li>
                                        <li>
<?php   
if ($listOfNotifications1['subject'] === "New Beer Added") 
?>   
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-cart success"></i>New Beer Added
                                            </a>
                                        </li>
                                        <li>                      
<?php
}
?>
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-people info"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning danger"></i> Very long description here that may not fit into the page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users warning"></i> 5 new members joined
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-cart success"></i> 25 sales made
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-person danger"></i> You changed your username
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="http://localhost:8888/app/global/dashboard/?viewName=notifications">View all</a></li>
                            </ul>
                        </li>
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $loggedInPersonName; ?> <i class="caret"></i></span>
                            </a>
<ul class="dropdown-menu" role="menu">
                  <li><a href="/?requestedAction=logout">Sign Out</a></li>
                  
                  <li class="divider"></li>
                  <li><a href="#">Provide Feedback</a></li>
                  <li><a href="#">About Beertrack</a></li>

                </ul>
                        </li>
                    </ul>

                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">