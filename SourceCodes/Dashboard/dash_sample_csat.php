<?php
    include ('json_pos.php');
    @ session_start();
    $year=(string)$_SESSION['dash4_year'];
    $month=$_SESSION['dash4_month'];
    if($month<10)
        $month="0".$month;
    else
        $month=(string)$month;
    $key=array("Target"=>1,"Recomendation"=>1);    
    $initial=array("count"=>0);
    $cursor = $collection5->find();
    $reduce = 'function (obj, prev) { prev["count"] += new NumberInt(obj.SALES_COUNT); }';
    $condition = array('condition' => array("Year" => array( '$eq' => $year),"Month"=>array('$eq'=>$month)));
    $result = $collection5->group($key,$initial, $reduce,$condition);
    $fin=$result['retval'];
    $i=0;
    $sum_target=0;
    $sum_rec=0;
    $n=0;
    foreach ($fin as $value)
    {
        $sum_target+=(int)$value['Target'];
        $sum_rec+=(int)$value['Recomendation'];
        $n++;
    }
    $avg_target=round($sum_target/$n);
    $avg_rec=round($sum_rec/$n);    
?>
