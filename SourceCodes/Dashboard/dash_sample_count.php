<?php
    include ('json_count.php');
    @ session_start();
    $year=(string)$_SESSION['dash1_year'];
    $month=$_SESSION['dash1_month'];
    if($month<10)
        $month="0".$month;
    else
        $month=(string)$month;
    $items = $collection4->distinct("PRODUCT_HEAD_NAME");
    $key=array("PRODUCT_HEAD_NAME"=>1);
    $initial=array("count"=>0);
    $cursor = $collection4->find();
    $reduce = 'function (obj, prev) { prev["count"] += new NumberInt(obj.SALES_COUNT); }';
    $condition = array('condition' => array("YEAR" => array( '$eq' => $year),"MONTH"=>array('$eq'=>$month)));
    $result = $collection4->group($key,$initial, $reduce,$condition);
    $fin=$result['retval'];
    $i=0;
    foreach ($fin as $value)
    {
        $ct[$i++]=$value['count'];
    }
?>
