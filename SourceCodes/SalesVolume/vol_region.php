<?php
    @ session_start();
    include("../SalesVolume/json2.php");
    $ppp=str_replace("%20"," ",$_GET['idno']);
    $key=array("REGION"=>1,"PRODUCT_HEAD_NAME"=>1,"REGION_ID"=>1);
    echo "<br><br>";
    $initial=array("count"=>0);
    $cursor = $collection4->find();
    $reduce = 'function (obj, prev) { prev.count++; }';
    $condition = array('condition' => array("PRODUCT_HEAD_NAME" => array( '$eq' => $ppp)));
    $result = $collection4->group($key,$initial, $reduce,$condition);
	$arrResult = $result['retval'];
	$counter = 1;
    $_SESSION['arr96']=$arrResult;
    $_SESSION['ppp']=$ppp;
    header("Location: ../SalesVolume/vol_region_kpi.php");
?>
