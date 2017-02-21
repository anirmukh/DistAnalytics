<?php
    //the database file for CEX
    include('json_pos.php');
    @  session_start();
    //grouping by region name and centre name
    $key=array("Region_Name"=>1,"Centre_Name"=>1);
    $year=$_GET['idno1'];
    $month=$_GET['idno'];
    $initial=array("targ"=>0,"rec"=>0);
    $cursor = $collection5->find();
    $reduce = 'function (obj, prev) { prev["targ"] += new NumberInt(obj.Target),prev["rec"] += new NumberInt(obj.Recomendation); }';
    $condition = array('condition' => array("Year" => array( '$eq' => $year),"Month"=>array('$eq'=>$month)));
    $result = $collection5->group($key,$initial, $reduce,$condition);
    $fin=$result['retval'];
    $flag=0;
    $flag1=0;
    $reg_name;
    $reg_rec;
    $reg_tar;
    $ii=0;
    foreach($fin as $temp)
    {
        $reg_name[$ii]=$temp['Centre_Name'];
        $reg_rec[$ii]=$temp['rec'];
        $reg_tar[$ii++]=$temp['targ'];
    }
    //declaring session variables to be used in view page
    $_SESSION['fin']=$fin;
    $_SESSION['reg_name']=$reg_name;
    $_SESSION['reg_rec']=$reg_rec;
    $_SESSION['reg_tar']=$reg_tar;
    //passing control to the view page
    header("Location: cex_reg_kpi.php");
?>
