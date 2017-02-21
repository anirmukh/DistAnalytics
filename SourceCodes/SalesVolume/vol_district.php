<?php
    session_start();
    include("json2.php");
    $item=$_GET['idno1'];
    $region1=explode(",",(string)$_GET['idno']);
    $region=$region1[0];
    $key=array("REGION"=>1,"PRODUCT_HEAD_NAME"=>1,"AREA"=>1);
    echo "<br><br>";
    $initial=array("count"=>0);
    $cursor = $collection4->find();
    $reduce = 'function (obj, prev) { prev.count++; }';
    $condition = array('condition' => array("PRODUCT_HEAD_NAME" => array( '$eq' =>$item),"REGION"=>array('$eq'=>$region)));
    $result = $collection4->group($key,$initial, $reduce,$condition);
	$arrResult = $result['retval'];
	$counter = 1;
    $_SESSION['arr96']=$arrResult;
    $_SESSION['ppp']=$item;
    header("Location: vol_district_kpi.php");
?>