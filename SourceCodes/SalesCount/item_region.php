<?php
@session_start();
include("../SalesCount/json_count.php");//including the database for the Sales Count data
$ppp=str_replace("%20"," ",$_GET['idno']);
//grouping on the basis of product head name and region
$key=array("REGION"=>1,"PRODUCT_HEAD_NAME"=>1,"REGION_ID"=>1);
//declaring the various arguments to be used in mongodb fetch query
$initial=array("count"=>0);
$cursor = $collection4->find();
$reduce = 'function (obj, prev) { prev.count++; }';
//only retrieving values for the required product head name
$condition = array('condition' => array("PRODUCT_HEAD_NAME" => array( '$eq' => $ppp)));
$result = $collection4->group($key,$initial, $reduce,$condition);//Performing the group operation
$arrResult = $result['retval'];
$counter = 1;
//Storing the required data in view page in session
$_SESSION['arr96']=$arrResult;
$_SESSION['ppp']=$ppp;
//redirecting to the view page
header("Location: ../SalesCount/item_region_kpi.php");
?>
