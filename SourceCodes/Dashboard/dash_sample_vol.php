<?php
    include ('json_count.php');
    @ session_start();
    $year=(string)$_SESSION['dash2_year'];
    $month=$_SESSION['dash2_month'];
    if($month<10)
        $month="0".$month;
    else
        $month=(string)$month;
    $items = $collection5->distinct("PRODUCT_HEAD_NAME");
    $key=array("PRODUCT_HEAD_NAME"=>1);
    $initial=array("count"=>0);
    $cursor = $collection5->find();
    $reduce = 'function (obj, prev) { prev["count"] += new NumberInt(obj.SALES_VOLUME); }';
    $condition = array('condition' => array("YEAR" => array( '$eq' => $year),"MONTH"=>array('$eq'=>$month)));
    $result = $collection5->group($key,$initial, $reduce,$condition);
    $fin=$result['retval'];
    $i=0;
    foreach ($fin as $value)
    {
        $vol[$i++]=$value['count'];
    }
?>
