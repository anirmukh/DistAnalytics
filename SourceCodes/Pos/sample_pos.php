<?php
    include ('../Pos/json_pos.php');//including the database for the POS data
    session_start();
    //retrieving the month and year value as selected in the form
    $year=$_GET['sel_year'];
    $year=(string)$year;
    $month=$_GET['sel_month'];
    if($month<10)
       $month="0".$month;
    else
    $month=(string)$month;
    $items = $collection4->distinct("POS_TYPE"); 
    //grouping on the basis of pos type
    $key=array("POS_TYPE"=>1);
    echo "<br><br>";
    //declaring the various arguments to be used in mongodb fetch query
    $initial=array("count"=>0);
    $cursor = $collection4->find();
    $reduce = 'function (obj, prev) { prev["count"] += new NumberInt(obj.POS_COUNT); }';
    //only retrieving values for the required month and year
    $condition = array('condition' => array("YEAR" => array( '$eq' => $year),"MONTH"=>array('$eq'=>$month)));
    $result = $collection4->group($key,$initial, $reduce,$condition);//Performing the group operation
    $fin=$result['retval'];
    $i=0;
    //Storing the counts after group operation in an array
    foreach ($fin as $value)
    {
        $ct[$i++]=$value['count'];
    }
    //Storing the required variables in view page as session variables
    $_SESSION['items']=$items;
    $_SESSION['vol']=$ct;
    $_SESSION['year']=$year;
    $_SESSION['month']=$month;
    //redirecting to the view page
    header("Location:../Pos/sample_kpi3.php");
?>
