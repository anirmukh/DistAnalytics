<?php
    session_start();
    include("../SalesVolume/json2.php");
    $item=$_GET['idno1'];
    $area1=explode(",",(string)$_GET['idno']);
    $area=$area1[0];
    $key=array("AREA"=>1,"PRODUCT_HEAD_NAME"=>1,"DISTRIBUTOR_NAME"=>1);
    echo "<br><br>";
    $initial=array("count"=>0);
    $cursor = $collection4->find();
    $reduce = 'function (obj, prev) { prev.count++; }';
    $condition = array('condition' => array("PRODUCT_HEAD_NAME" => array( '$eq' =>$item),"AREA"=>array('$eq'=>$area)));
    $result = $collection4->group($key,$initial, $reduce,$condition);
	$arrResult = $result['retval'];
	$counter = 1;
    $_SESSION['arr96']=$arrResult;
    $_SESSION['ppp']=$item;
    header("Location: ../SalesVolume/vol_distributor_kpi.php");
?>