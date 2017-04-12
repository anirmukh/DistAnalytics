<?php
@ session_start();
if(!isset($_SESSION['logged_in']))
    //unset($_SESSION['logged_in']);
//else
    redirect("../login/login.php");
//Deriving the system date
//$sys=date("Y-m-d");
//$month=date("m");
//$year=date("Y");
$sys=2017-01-01;
$month=01;
$year=2017;
//KPIs will be displayed with data w.r.t. to the last month
if($month==1)
{
    $year--;
    $month=12;
}
else
    $month--;

//function to check if any headers has already been sent using PHP's header function.
//If yes, then redirect using JS window.location 
function redirect($url)
{
    if (!headers_sent())
    {    
        header('Location: '.$url);
        exit;
    }
    else
    {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; 
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!--declaring the style attributes for the loading image -->
    <style>
        .loader 
        {
	            position: fixed;
	            left: 0px;
                top: 0px;
                width: 100%;
                height: 100%;
                z-index: 9999;
                background: url('loader2.gif') 50% 50% no-repeat rgb(249,249,249);
        }
    </style>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Distribution Analytics</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../Displayfiles/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../Displayfiles/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../Displayfiles/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../Displayfiles/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <!-- JQuery to check whether the loading of the page is complete or not -->
    <script type="text/javascript">
        $(window).load(function() {
	   $(".loader").fadeOut("slow");
        })
</script>
</head>
<div class="loader"></div>
<body>

    <div id="wrapper">
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="../Dashboard/blank.php"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> KPIS<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="../SalesCount/sample_kpi1.php">Sales Count</a>
                                </li>
                                <li>
                                    <a href="../SalesVolume/sample_kpi2.php">Sales Volume</a>
                                </li>
                                <li>
                                    <a href="../Pos/sample_kpi3.php">POS</a>
                                </li>
                                <li>
                                    <a href="../Cex/sample_kpi4.php">Customer Experience(CEX)</a>
                                </li>
                                <li>
                                    <a href="../Activation/sample_kpi5.php">Unit Activation/Recharging Outlet</a>
                                </li>
                                <li>
                                    <a href="../Primary/sample_kpi6.php">Primary/Secondary Recharges</a>
                                </li>
                                <li>
                                    <a href="../MNP/sample_kpi7.php">MNP Number Portability</a>
                                </li>
                                <li>
                                    <a href="../SAF/sample_kpi8.php">SAF</a>
                                </li>
                                 <li>
                                    <a href="../SIM/sample_kpi9.php">SIM Activation</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                           <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Analysis<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="../HW/sample_kpi10.php">Forecasting(HW)</a>
                                </li>
                                <li>
                                    <a href="../Cluster/sample_kpi11.php">Cluster Analysis</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Dashboard</h1>
                        <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Sales Count
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="morris-area-chart">
                            <?php
                            //set the session variables for Sales Count
                            if(!isset($_SESSION['dash1_done']))
                            {
                                $_SESSION['dash1_year']=$year;
                                $_SESSION['dash1_month']=$month;
                                $u="../Dashboard/dash_sample_kpi1.php";
                                //redirect it to the service page for Sales Count
                                redirect($u);
                            }
                            if(isset($_SESSION['dash1_done']))
                            {
                                //Coming back to the view page
                                @ session_start();
                                //declaring JS variables to be used in HighCharts for values
                                echo "<script>";
                                echo 'var namect= ' . json_encode($_SESSION['dash1_items']) . ';';
                                echo 'var name2ct = ' . json_encode($_SESSION['dash1_ct']) . ';';
                                echo 'var name3ct= '.json_encode($_SESSION['dash1_year']).';';
                                echo 'var name4ct= '.json_encode($_SESSION['dash1_month']).';'; 
                                echo "</script>";
                                //including HighCharts for Sales Count
                                include('../Dashboard/dash_high_sale_count.php');
                                //Destroying the particular session variables once the displaying is over
                                unset($_SESSION['dash1_items']);
                                unset($_SESSION['dash1_ct']);
                                unset($_SESSION['dash1_year']);
                                unset($_SESSION['dash1_month']);
                                unset($_SESSION['dash1_done']);
                            }
                            ?>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Sales Volume
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="morris-bar-chart">
                            <?php
                            //set the session variables for Sales Volume
                           if(!isset($_SESSION['dash2_done']))
                            {
                                $_SESSION['dash2_year']=$year;
                                $_SESSION['dash2_month']=$month;
                                //redirect it to the service page for Sales Count
                                $u="../Dashboard/dash_sample_kpi2.php";
                                redirect($u);
                            }
                            if(isset($_SESSION['dash2_done']))
                            {
                                //Coming back to the view page
                                @ session_start();
                                //declaring JS variables to be used in HighCharts for values
                                echo "<script>";
                                echo 'var dashvol= ' . json_encode($_SESSION['dash2_items']) . ';';
                                echo 'var dash2vol = ' . json_encode($_SESSION['dash2_vol']) . ';';
                                echo 'var dash3vol= '.json_encode($_SESSION['dash2_year']).';';
                                echo 'var dash4vol= '.json_encode($_SESSION['dash2_month']).';'; 
                                echo "</script>";
                                //including HighCharts for Sales Volume
                                include("../Dashboard/dash_high_sample_vol.php");
                                //Destroying the particular session variables once the displaying is over
                                unset($_SESSION['dash2_items']);
                                unset($_SESSION['dash2_vol']);
                                unset($_SESSION['dash2_year']);
                                unset($_SESSION['dash2_month']);
                                unset($_SESSION['dash2_done']);
                            }
                            ?>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            POS
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="morris-line-chart">
                            <?php
                            //set the session variables for POS
                            if(!isset($_SESSION['dash3_done']))
                            {
                                $_SESSION['dash3_year']=$year;
                                $_SESSION['dash3_month']=$month;
                                //redirect it to the service page for POS
                                $u="../Dashboard/dash_sample_kpi3.php";
                                redirect($u);
                            }
                            if(isset($_SESSION['dash3_done']))
                            {
                                //Coming back to the view page
                                @ session_start();
                                //declaring JS variables to be used in HighCharts for values
                                echo "<script>";
                                echo 'var dashpos= ' . json_encode($_SESSION['dash3_items']) . ';';
                                echo 'var dash2pos = ' . json_encode($_SESSION['dash3_pos']) . ';';
                                echo 'var dash3pos= '.json_encode($_SESSION['dash3_year']).';';
                                echo 'var dash4pos= '.json_encode($_SESSION['dash3_month']).';'; 
                                echo "</script>";
                                //including HighCharts for POS
                                include("../Dashboard/dash_high_sample_pos.php");
                                //Destroying the particular session variables once the displaying is over
                                unset($_SESSION['dash3_items']);
                                unset($_SESSION['dash3_pos']);
                                unset($_SESSION['dash3_year']);
                                unset($_SESSION['dash3_month']);
                                unset($_SESSION['dash3_done']);
                            }                    
                            ?>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Customer Experience
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="morris-donut-chart">
                            <?php
                            //set the session variables for CEX
                            if(!isset($_SESSION['dash4_done']))
                            {
                                $_SESSION['dash4_year']=$year;
                                $_SESSION['dash4_month']=$month;
                                //redirect it to the service page for CEX
                                $u="../Dashboard/dash_sample_kpi4.php";
                                redirect($u);
                            }
                            if(isset($_SESSION['dash4_done']))
                            {
                                //Coming back to the view page
                                @ session_start();
                                //declaring JS variables to be used in HighCharts for values
                                echo "<script>";
                                echo 'var dash2csat = ' . json_encode($_SESSION['dash4_avg_tar']) . ';';
                                echo 'var dash5csat= '.json_encode($_SESSION['dash4_avg_rec']).';';
                                echo 'var dash3csat= '.json_encode($_SESSION['dash4_year']).';'; 
                                echo 'var dash4csat= '.json_encode($_SESSION['dash4_month']).';'; 
                                echo "</script>";
                                //including HighCharts for CEX
                                include("../Dashboard/dash_high_sale_csat.php");
                                //Destroying the particular session variables once the displaying is over
                                unset($_SESSION['dash4_avg_tar']);
                                unset($_SESSION['dash4_avg_rec']);
                                unset($_SESSION['dash4_year']);
                                unset($_SESSION['dash4_month']);
                                unset($_SESSION['dash4_done']);
                            }                    
                            ?>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../../Displayfiles/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../Displayfiles/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../Displayfiles/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../Displayfiles/dist/js/sb-admin-2.js"></script>

</body>
</html>
