<?php
    include ('json_pos.php');
    @ session_start();
    $year=(string)$_SESSION['dash3_year'];
    $month=$_SESSION['dash3_month'];
    if($month<10)
        $month="0".$month;
    else
        $month=(string)$month;
    $items = $collection4->distinct("POS_TYPE");
    $key=array("POS_TYPE"=>1);
    $initial=array("count"=>0);
    $cursor = $collection4->find();
    $reduce = 'function (obj, prev) { prev["count"] += new NumberInt(obj.POS_COUNT); }';
    $condition = array('condition' => array("YEAR" => array( '$eq' => $year),"MONTH"=>array('$eq'=>$month)));
    $result = $collection4->group($key,$initial, $reduce,$condition);
    $fin=$result['retval'];
    $i=0;
    foreach ($fin as $value)
    {
        $pos[$i++]=$value['count'];
    }
?>
