<?php
session_start();
include("../SalesCount/json_count.php");//including the database for the Sales Count data
$item=$_GET['idno1'];
$region1=explode(",",(string)$_GET['idno']);
$region=$region1[0];
//grouping on the basis of product head name, area and region
$key=array("REGION"=>1,"PRODUCT_HEAD_NAME"=>1,"AREA"=>1);
//declaring the various arguments to be used in mongodb fetch query
$initial=array("count"=>0);
$cursor = $collection4->find();
$reduce = 'function (obj, prev) { prev.count++; }';
//only retrieving values for the required product head name and region
$condition = array('condition' => array("PRODUCT_HEAD_NAME" => array( '$eq' =>$item),"REGION"=>array('$eq'=>$region)));
$result = $collection4->group($key,$initial, $reduce,$condition);
$arrResult = $result['retval'];
$counter = 1;
//Storing the required data in view page in session
$_SESSION['arr96']=$arrResult;
$_SESSION['ppp']=$item;
//redirecting to the view page
header("Location: ../SalesCount/item_district_kpi.php");
?>