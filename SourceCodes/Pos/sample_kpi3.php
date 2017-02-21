<!DOCTYPE html>
<html lang="en">

<head>
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

</head>

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

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">POS Count</h1>
                         <div class="col-lg-20">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                             <div class="row">
                                <div class="col-lg-6">
                         <?php
                         function check($a,$b) //Function to check the equality of two strings
                        {
                            if(strcmp($a,$b)==0)
                                return "selected";
                            else
                                return "";
                        }
                        @ session_start();
                        if(!isset($_SESSION['year']))//If form has not been filled
                        {
                            //Displaying the default form with no 'selected' tag in the option values
                            echo "<form action='../Pos/sample_pos.php'>";
                            echo " <div class='form-group'>";
                            echo "<label>Year:</label> ";
                            echo "<p><select name='sel_year' class='form-control'></p>";
                            echo "<option value=2015>2015</option>";
                            echo "<option value=2016>2016</option>";
                            echo "<option value=2017>2017</option>";
                            echo "</select><br>";
                            $month=array("JANUARY","FEBRUARY","MARCH","APRIL","MAY","JUNE","JULY","AUGUST","SEPTEMBER","OCTOBER","NOVEMBER","DECEMBER");
                            echo "<label>Month:</label>";
                            echo "<p><select name='sel_month' class='form-control'></p>";
                            $v=1;
                            foreach ($month as $x)
                            {
                                echo "<option value='$v'>".$x."</option>";
                                $v++;
                            }
                            echo "</select><br><br>";
                            echo "<input type='submit' class='form-control' name='sbt' value='SUBMIT'></input>";
                            echo "</div></form></div></div>";
                       }
                       if(isset($_SESSION['year']))//If form has been filled once
                       {
                            //returning from service page
                            $month=$_SESSION['month'];
                            $year=$_SESSION['year'];
                            //associative array to derive the month name based on month number
                            $m_arr=array("01"=>"JANUARY","02"=>"FEBRUARY","03"=>"MARCH","04"=>"APRIL","05"=>"MAY","06"=>"JUNE","07"=>"JULY",
                                 "08"=>"AUGUST","09"=>"SEPTEMBER","10"=>"OCTOBER","11"=>"NOVEMBER","12"=>"DECEMBER");
                            echo "<form action='sample_pos.php'>";
                            echo " <div class='form-group'>";
                            echo "<label>Year:</label> ";
                            echo "<p><select name='sel_year' class='form-control'></p>";
                            //inserting 'selected' tag inside the selected option
                            echo "<option value=2015 ".check($year,"2015").">2015</option>";
                            echo "<option value=2016 ".check($year,"2016").">2016</option>";
                            echo "<option value=2017 ".check($year,"2017").">2017</option>";
                            echo "</select><br>";
                            $month1=array("JANUARY","FEBRUARY","MARCH","APRIL","MAY","JUNE","JULY","AUGUST","SEPTEMBER","OCTOBER","NOVEMBER","DECEMBER");
                            echo "<label>Month:</label>";
                            echo "<p><select name='sel_month' class='form-control'></p>";
                            $v=1;
                            foreach ($month1 as $x)
                            {
                                echo "<option value='$v' ".check($x,$m_arr[$month]).">".$x."</option>";
                                $v++;
                            }
                            echo "</select><br><br>";
                            echo "<input type='submit' class='form-control' name='sbt' value='SUBMIT'></input>";
                            echo "</div></form></div></div>";
                            $items=$_SESSION['items'];
                            $vol=$_SESSION['vol'];
                            //declaring the script variables to be used in the highcharts file for displaying
                            echo '<script>';
                            echo 'var name= ' . json_encode($items) . ';';
                            echo 'var name2 = ' . json_encode($vol) . ';';
                            echo 'var name3= '.json_encode($_SESSION['year']).';';
                            echo 'var name4= '.json_encode($_SESSION['month']).';';
                            echo '</script>';
                            //including the highcharts file of the POS
                            include('../Pos/high_sample_pos.php');
                            session_destroy();//Destroying the session and thereby all its variables
                        }
                        ?>
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
