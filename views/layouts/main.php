<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= Html::csrfMetaTags() ?>
    <meta charset="utf-8">
    <title>Passport Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Passport Management System.">
    <meta name="author" content="">

    <!-- The styles -->
    <link id="bs-css" href="<?php echo Yii::$app->request->baseurl;?>/theme/css/bootstrap-cerulean.min.css" rel="stylesheet">

    <link href="<?php echo Yii::$app->request->baseurl;?>/theme/css/charisma-app.css" rel="stylesheet">
    <link href='<?php echo Yii::$app->request->baseurl;?>/theme/bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='<?php echo Yii::$app->request->baseurl;?>/theme/bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='<?php echo Yii::$app->request->baseurl;?>/theme/bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='<?php echo Yii::$app->request->baseurl;?>/theme/bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='<?php echo Yii::$app->request->baseurl;?>/theme/bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='<?php echo Yii::$app->request->baseurl;?>/theme/bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='<?php echo Yii::$app->request->baseurl;?>/theme/css/jquery.noty.css' rel='stylesheet'>
    <link href='<?php echo Yii::$app->request->baseurl;?>/theme/css/noty_theme_default.css' rel='stylesheet'>
    <link href='<?php echo Yii::$app->request->baseurl;?>/theme/css/elfinder.min.css' rel='stylesheet'>
    <link href='<?php echo Yii::$app->request->baseurl;?>/theme/css/elfinder.theme.css' rel='stylesheet'>
    <link href='<?php echo Yii::$app->request->baseurl;?>/theme/css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='<?php echo Yii::$app->request->baseurl;?>/theme/css/uploadify.css' rel='stylesheet'>
    <link href='<?php echo Yii::$app->request->baseurl;?>/theme/css/animate.min.css' rel='stylesheet'>

    <!-- jQuery -->
    <script src="<?php echo Yii::$app->request->baseurl;?>/theme/bower_components/jquery/jquery.min.js"></script>
    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseurl;?>/theme/img/favicon.ico">

</head>

<body>
<?php $this->beginBody() ?>
<?php 
    if(Yii::$app->session['logged_in']==true){ ?>
            <!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo Yii::$app->request->baseurl;?>/index.php?r=site/index">
            	<img src="<?php echo Yii::$app->request->baseurl;?>/img/way_to_arfa.png" style="width: 46px; height: 27px;"/>
                <span>PMS</span></a>
  
            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
           <!--- logout button--> 
              
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> 
                    <?php 
                        if (Yii::$app->session['user_name']){
                            echo Yii::$app->session['user_name'];
                        }else{
                            echo "Default";
                        }
                    ?>
                    </span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo Yii::$app->request->baseurl;?>/index.php?r=site/logout">Logout</a></li>
                </ul>
            </div>
            
            <!--index.php?r=-->
            <!-- user dropdown ends -->

            <?php /*?><ul class="collapse navbar-collapse nav navbar-nav top-menu">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-star"></i> Dropdown <span
                            class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
                <li>
                    <form class="navbar-search pull-left">
                        <input placeholder="Search" class="search-query form-control col-md-10" name="query"
                               type="text">
                    </form>
                </li>
            </ul><?php */?>

        </div>
    </div>
    <!-- topbar ends -->
<div class="ch-container">
    <div class="row">
        
        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Main</li>
                        <li><a class="ajax-link" href="<?php echo Yii::$app->request->baseurl;?>/index.php?r=site/index"><i class="glyphicon glyphicon-home"></i><span> Dashboard</span></a>
                        </li>
                        <?php if(Yii::$app->session['user_role'] == 1){ ?>
                            <li><a class="ajax-link" href="<?php echo Yii::$app->request->baseurl;?>/index.php?r=users/index"><i
                                        class="glyphicon glyphicon-user"></i><span> Users</span></a>
                            </li>
                         <?php } ?>   
                         <li><a class="ajax-link" href="<?php echo Yii::$app->request->baseurl;?>/index.php?r=passport/index"><i
                                    class="glyphicon glyphicon-book"></i><span> Passports</span></a>
                        </li>
                        <li><a class="ajax-link" href="<?php echo Yii::$app->request->baseurl;?>/index.php?r=reports/index"><i
                                    class="glyphicon glyphicon-align-justify"></i><span> Reports</span></a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->

        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>
        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
        <?= $content ?>    
    </div>
    <!-- content ends -->
    </div><!--/row-->
    <!--/#content.col-md-0-->


<!--<hr>-->

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Settings</h3>
                </div>
                <div class="modal-body">
                    <p>Here settings can be configured...</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                </div>
            </div>
        </div>
    </div>

<?php } else{ ?>
        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
        <?= $content ?>    
    </div>
<?php } ?>
<?php 
 if(Yii::$app->session['logged_in']==true)
 {

?>

    <footer class="row">
    
        <p class="col-md-9 col-sm-9 col-xs-12 copyright">Copyright &copy; 2017</p>

        <!--<p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a
                href="http://usman.it/free-responsive-admin-template">Passport MAnagement System</a></p>-->
    </footer>
    <?php  } ?>

 </div><!--/.fluid-container-->

<!-- external javascript -->

<script src="<?php echo Yii::$app->request->baseurl;?>/theme/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- library for cookie management -->
<script src="<?php echo Yii::$app->request->baseurl;?>/theme/js/jquery.cookie.js"></script>
<!-- calender plugin -->
<script src='<?php echo Yii::$app->request->baseurl;?>/theme/bower_components/moment/min/moment.min.js'></script>
<script src='<?php echo Yii::$app->request->baseurl;?>/theme/bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='<?php echo Yii::$app->request->baseurl;?>/theme/js/jquery.dataTables.min.js'></script>

<!-- select or dropdown enhancer -->
<script src="<?php echo Yii::$app->request->baseurl;?>/theme/bower_components/chosen/chosen.jquery.min.js"></script>
<!-- plugin for gallery image view -->
<script src="<?php echo Yii::$app->request->baseurl;?>/theme/bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- notification plugin -->
<script src="<?php echo Yii::$app->request->baseurl;?>/theme/js/jquery.noty.js"></script>
<!-- library for making tables responsive -->
<script src="<?php echo Yii::$app->request->baseurl;?>/theme/bower_components/responsive-tables/responsive-tables.js"></script>
<!-- tour plugin -->
<script src="<?php echo Yii::$app->request->baseurl;?>/theme/bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="<?php echo Yii::$app->request->baseurl;?>/theme/js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="<?php echo Yii::$app->request->baseurl;?>/theme/js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="<?php echo Yii::$app->request->baseurl;?>/theme/js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="<?php echo Yii::$app->request->baseurl;?>/theme/js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="<?php echo Yii::$app->request->baseurl;?>/theme/js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="<?php echo Yii::$app->request->baseurl;?>/theme/js/charisma.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
   <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
   <link rel="stylesheet" href="<?php echo Yii::$app->request->baseurl;?>/theme/calendar/jquery.datepicker.css">
   <script src="<?php echo Yii::$app->request->baseurl;?>/theme/calendar/jquery.datepicker.js"></script>

<?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>

