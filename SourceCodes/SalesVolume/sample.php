  <?php
    include ('../SalesVolume/json_count.php');
    session_start();
     $year=$_GET['sel_year'];
     $year=(string)$year;
     $month=$_GET['sel_month'];
     if($month<10)
        $month="0".$month;
     else
        $month=(string)$month;
     $items = $collection5->distinct("PRODUCT_HEAD_NAME");
    $key=array("PRODUCT_HEAD_NAME"=>1);
    echo "<br><br>";
    $initial=array("count"=>0);
    $cursor = $collection5->find();
    $reduce = 'function (obj, prev) { prev["count"] += new NumberInt(obj.SALES_VOLUME); }';
    $condition = array('condition' => array("YEAR" => array( '$eq' => $year),"MONTH"=>array('$eq'=>$month)));
    $result = $collection5->group($key,$initial, $reduce,$condition);
    $fin=$result['retval'];
    $i=0;
    foreach ($fin as $value)
    {
        $ct[$i++]=$value['count'];
    }
   $_SESSION['items']=$items;
   $_SESSION['vol']=$ct;
   $_SESSION['year']=$year;
   $_SESSION['month']=$month;
   header("Location:../SalesVolume/sample_kpi2.php");
?>
