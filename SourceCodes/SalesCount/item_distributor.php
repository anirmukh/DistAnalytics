<?php
session_start();
include("../SalesCount/json_count.php");//including the database for the Sales Count data
$item=$_GET['idno1'];
$area1=explode(",",(string)$_GET['idno']);
$area=$area1[0];
//grouping on the basis of product head name, distributor name and area
$key=array("AREA"=>1,"PRODUCT_HEAD_NAME"=>1,"DISTRIBUTOR_NAME"=>1);
//declaring the various arguments to be used in mongodb fetch query
$initial=array("count"=>0);
$cursor = $collection4->find();
$reduce = 'function (obj, prev) { prev.count++; }';
//only retrieving values for the required product head name and area
$condition = array('condition' => array("PRODUCT_HEAD_NAME" => array( '$eq' =>$item),"AREA"=>array('$eq'=>$area)));
$result = $collection4->group($key,$initial, $reduce,$condition);//Performing the group operation
$arrResult = $result['retval'];
$counter = 1;
//Storing the required data in view page in session
$_SESSION['arr96']=$arrResult;
$_SESSION['ppp']=$item;
header("Location: ../SalesCount/item_distributor_kpi.php"); //redirecting to the view page
?>