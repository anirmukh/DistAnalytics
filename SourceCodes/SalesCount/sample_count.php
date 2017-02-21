<?php
    include ('json_count.php');//including the database for the POS data
    session_start();
    //retrieving the month and year value as selected in the form
    $year=$_GET['sel_year'];
    $year=(string)$year;
    $month=$_GET['sel_month'];
    if($month<10)
        $month="0".$month;
     else
        $month=(string)$month;
    $items = $collection4->distinct("PRODUCT_HEAD_NAME");
     //grouping on the basis of product head name
    $key=array("PRODUCT_HEAD_NAME"=>1);
    echo "<br><br>";
     //declaring the various arguments to be used in mongodb fetch query
    $initial=array("count"=>0);
    $cursor = $collection4->find();
    $reduce = 'function (obj, prev) { prev["count"] += new NumberInt(obj.SALES_COUNT); }';
    //only retrieving values for the required month and year
    $condition = array('condition' => array("YEAR" => array( '$eq' => $year),"MONTH"=>array('$eq'=>$month)));
    $result = $collection4->group($key,$initial, $reduce,$condition);
    $fin=$result['retval'];
    $i=0;
    //Storing the counts after group operation in an array
    foreach ($fin as $value)
    {
        $ct[$i++]=$value['count'];
    }
    //Storing the required variables in view page as session variables
    $_SESSION['items']=$items;
    $_SESSION['ct']=$ct;
    $_SESSION['year']=$year;
    $_SESSION['month']=$month;
    //redirecting to the view page
    header("Location:sample_kpi1.php");
?>
