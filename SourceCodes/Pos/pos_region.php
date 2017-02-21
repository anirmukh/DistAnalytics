<?php
@session_start();
include("../Pos/json_pos.php");//including the database for the POS data
$ppp=str_replace("%20"," ",$_GET['idno']);
//grouping on the basis of pos type and region
$key=array("REGION"=>1,"POS_TYPE"=>1,"REGION_ID"=>1);
//declaring the various arguments to be used in mongodb fetch query
$initial=array("count"=>0);
$cursor = $collection4->find();
$reduce = 'function (obj, prev) { prev.count++; }';
//only retrieving values for the required pos type
$condition = array('condition' => array("POS_TYPE" => array( '$eq' => $ppp)));
$result = $collection4->group($key,$initial, $reduce,$condition);//Performing the group operation
$arrResult = $result['retval'];
$counter = 1;
//Storing the required data in view page in session
$_SESSION['arr96']=$arrResult;
$_SESSION['ppp']=$ppp;
//redirecting to the view page
header("Location: ../Pos/pos_region_kpi.php");
?>
