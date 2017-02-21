<!DOCTYPE html>
<html lang="en">

<head>
<script src="../../Displayfiles/angular.js"></script>

<?php
//include("angular_region_count.php");
if(isset($_GET['idno']))
{
$year=$_GET['idno'];
$mnt=$_GET['idno1'];
header('Location: ../SalesVolume/region2.php?idno='.$year."&idno1=".$mnt);
}
?>
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
                        <h1 class="page-header">Sales Volume</h1>
                        <?php
                            @ session_start();
                            if(isset($_SESSION['items']))
                            {
                                $items=$_SESSION['items'];                          
                                $color=array("info","warning","success");
                                $flag1=0;
                                $arr1=array("SIM KIT","DATA CARD","SERVICE KIT","HANDSET");
                                $arr=$_SESSION['arr'];
                                $count=sizeof($arr);
                                $keys= array_keys($arr);
                                $v=0;
                                $flag=0;
                                $i=0;
                                $j=0;
                                foreach($arr as $temp)
                                {    
                                    if($keys[$i]=="null")
                                        continue;  
                                    $arr3=array_keys($temp);
                                    foreach($arr3 as $star)
                                    {
                                        for($v=0;$v<sizeof($arr1);$v++)
                                        {
                                            if(strstr((string)$arr1[$v],(string)$star))
                                            {
                                                $flag=1;
                                                break;
                                            }   
                                        }
                                        if($flag==1)
                                        {
                                            $arr4[$j]['region']=$keys[$i];
                                            $arr4[$j][str_replace(" ","_",$star)]=$arr[$keys[$i]][$star];
                                        }
                                        $flag=0;
                                    }
                                    $j++;
                                    if($flag1==3)
                                        $flag1=0;
                                    $i++;
                                }
                                echo "<script>var disp=".json_encode($arr4).";</script>";
                                $color=array("success","info","warning");
                                include("../SalesVolume/angular_region2.php");
                                @  session_destroy();
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