<!DOCTYPE html>
<html lang="en">
<head>
<?php
session_start();
if(!isset($_SESSION['done']))
{
    header("Location:../HW/holt_start.php?idno=1");
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
                        <h1 class="page-header">Forcasting - Holt Winter</h1>
                         <div class="col-lg-20">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                        <?php
                            function check($a,$b)
                            {
                                if(strcmp($a,$b)==0)
                                    return "selected";
                                else
                                    return "";
                            }
                            if(isset($_SESSION['done']))
                            {
                                if(!isset($_SESSION['arr']))
                                {
                                    $items=$_SESSION['items'];
                                    $mindate=$_SESSION['mindate'];
                                    $type=array("DAILY","WEEKLY","MONTHLY");
                                    $sys=date("Y-m-d");
                                    echo"<div class='row'><div class='col-lg-6'>
                                    <form action='../HW/holt_start.php'>";
                                    echo " <div class='form-group'>";
                                    echo "<label>Select Category</label>";
                                    echo "<p><select name='sel_item' class='form-control' required></p>";
                                    foreach($items as $i)
                                    {   
                                        echo "<option value='$i'>$i</option>"; 
                                    }
                                    echo "</select><br>";
                                    echo "<label>Enter a date to do forcasting from :</label>
                                    <p><input type='date' name='from' class='form-control' min=".$mindate." required></p><br>
                                    <label>Forcasting Till Date: </label><p>".$sys."</p><br>";
                                    echo "<label>Forcasting Type: </label><p><select name='type1' class='form-control' required></p>";
                                    $x=0;
                                    foreach($type as $i)
                                    {   
                                        echo "<option value=".$x.">$i</option>"; 
                                        $x++;
                                    }
                                    echo "</select><br><label>Enter Forcasting Period</label>";
                                    echo "<p><input type=number class='form-control' name='period' min=1 required></input></p><br>";
                                    echo "<p><input type='submit' class='form-control' name='sbt'></p></div>
                                    </form></div></div>
                                    ";
                                }
                                if(isset($_SESSION['arr']))
                                {
                                    $items=$_SESSION['items'];
                                    $item=$_SESSION['sel_item'];
                                    $from=$_SESSION['from'];
                                    $type1=$_SESSION['type'];
                                    $period=$_SESSION['period'];
                                    $items=$_SESSION['items'];
                                    $mindate=$_SESSION['mindate'];
                                    $type=array("DAILY","WEEKLY","MONTHLY");
                                    $sys=date("Y-m-d");
                                    echo"<div class='row'><div class='col-lg-6'>
                                    <form action='../HW/holt_start.php'>";
                                    echo " <div class='form-group'>";
                                    echo "<label>Select Category</label>";
                                    echo "<p><select name='sel_item' class='form-control' required></p>";
                                    foreach($items as $i)
                                    {   
                                        echo "<option value='$i' ".check($i,$item).">".$i."</option>"; 
                                    }
                                    echo "</select><br>";
                                    echo "<label>Enter a date to do forcasting from :</label>
                                    <p><input type='date' name='from' value='".$from."'class='form-control' min=".$mindate."  required></p><br>
                                    <label>Forcasting Till Date: </label><p>".$sys."</p><br>";
                                    echo "<label>Forcasting Type: </label><p><select name='type1' class='form-control' required></p>";
                                    $x=0;
                                    foreach($type as $i)
                                    {   
                                        echo "<option value='$x' ".check($x,$type1).">$i</option>"; 
                                        $x++;
                                    }
                                    echo "</select><br><label>Enter Forcasting Period</label>";
                                    echo "<p><input type=number class='form-control' name='period' value='".$period."' min=1 required></input></p><br>";
                                    echo "<p><input type='submit' class='form-control' name='sbt'></p></div>
                                    </form></div></div>
                                    ";    
                                    $arr=$_SESSION['arr'];
                                    $head1=$_SESSION['head1'];
                                    $head2=$_SESSION['head2'];
                                    echo('<img src="forcasting.png" alt="loading" />');   
                                    echo "<script>var disp=".json_encode($arr).';';
                                    echo "var head11=".json_encode($head1).';';
                                    echo "var head21=".json_encode($head2).';';
                                    echo"</script>";
                                    include("../HW/angular_holt.php");
                                    session_destroy();
                                }
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

