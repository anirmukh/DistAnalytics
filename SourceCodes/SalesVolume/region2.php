
<?php
    include('../SalesVolume/json2.php');
    session_start();
    $items=$collection4->distinct("PRODUCT_HEAD_NAME");
    $regions=$collection4->distinct("REGION");
    $_SESSION['items']=$items;
    $key=array("PRODUCT_HEAD_NAME"=>1,"REGION"=>1);
    $year=$_GET['idno'];
    $month=$_GET['idno1'];
    $initial=array("count"=>0);
    $cursor = $collection4->find()->sort(array('REGION'=>1));
    $reduce = 'function (obj, prev) { prev["count"] += new NumberInt(obj.SALES_VOLUME); }';
    $condition = array('condition' => array("YEAR" => array( '$eq' => $year),"MONTH"=>array('$eq'=>$month)));
    $result = $collection4->group($key,$initial, $reduce,$condition);
    $fin=$result['retval'];
    $i=0;  
    $arr;
    $arr2;
    for($ii=0;$ii<sizeof($regions);$ii++)
    {
        for($jj=0;$jj<sizeof($items);$jj++)
        {
            $arr[$regions[$ii]][$items[$jj]]=0;
        }
    }    
    foreach($fin as $res)
    {   
        $reg=$res["REGION"];
        $it=$res["PRODUCT_HEAD_NAME"];        
        $arr[$reg][$it]=$res["count"];
    }
    $_SESSION['arr']=$arr;
    header("Location:../SalesVolume/region2_kpi.php");
?>
