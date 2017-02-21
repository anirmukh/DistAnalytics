<?php
session_start();
include("../Pos/json_pos.php");//including the database for the POS data
$item=$_GET['idno1'];
$area1=explode(",",(string)$_GET['idno']);
$area=$area1[0];
//grouping on the basis of pos type and area
$key=array("AREA"=>1,"POS_TYPE"=>1,"DIST_NAME"=>1);
echo "<br><br>";
//declaring the various arguments to be used in mongodb fetch query
$initial=array("count"=>0);
$cursor = $collection4->find();
$reduce = 'function (obj, prev) { prev.count++; }';
//only retrieving values for the required pos type and area
$condition = array('condition' => array("POS_TYPE" => array( '$eq' =>$item),"AREA"=>array('$eq'=>$area)));
$result = $collection4->group($key,$initial, $reduce,$condition);//Performing the group operation
$arrResult = $result['retval'];
$counter = 1;
//Storing the required data in view page in session
$_SESSION['arr96']=$arrResult;
$_SESSION['ppp']=$item;
//redirecting to the view page
header("Location: ../Pos/pos_distributer_kpi.php"); 
?>