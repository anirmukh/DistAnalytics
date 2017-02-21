 <?php
    //including the database for the CEX data
    include ('../Cex/json_pos.php');
    session_start();
    //retrieving the month and year value
    $year=$_GET['sel_year'];
    $year=(string)$year;
    $month=$_GET['sel_month'];
    if($month<10)
        $month="0".$month;
    else
        $month=(string)$month;
    //grouping on the basis of target and recommendation
    $key=array("Target"=>1,"Recomendation"=>1);
    echo "<br><br>";
    //declaring the various arguments to be used in mongodb fetch query
    $initial=array("count"=>0);
    $cursor = $collection5->find();
    $reduce = 'function (obj, prev) { prev["count"] += new NumberInt(obj.SALES_COUNT); }';
    //only retrieving values for the given month and year
    $condition = array('condition' => array("Year" => array( '$eq' => $year),"Month"=>array('$eq'=>$month)));
    $result = $collection5->group($key,$initial, $reduce,$condition);
    $fin=$result['retval'];
    $i=0;
    $sum_target=0;
    $sum_rec=0;
    $n=0;
    //summing up the total value
    foreach ($fin as $value)
    {
        $sum_target+=(int)$value['Target'];
        $sum_rec+=(int)$value['Recomendation'];
        $n++;
    }
    //finding the average
    $avg_target=round($sum_target/$n);
    $avg_rec=round($sum_rec/$n);
    //storing the values in session to be used in view page
    $_SESSION['avg_target']=$avg_target;
    $_SESSION['avg_rec']=$avg_rec;
    $_SESSION['month']=$month;
    $_SESSION['year']=$year;
    //redirecting to the view page
    header("Location: ../Cex/sample_kpi4.php");
?>
