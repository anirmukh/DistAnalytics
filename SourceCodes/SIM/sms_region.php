<?php
include("../SIM/json_pos.php");//including the database for the SIM Activations
session_start();
//grouping on the basis of msisdn and region
$key=array("REGION"=>1,"MSISDN"=>1);
echo "<br><br>";
$regions=$collection10->distinct("REGION");//Finding distinct regions in SIM Activations database
foreach($regions as $val)
$arr[$val]=0;
//declaring the various arguments to be used in mongodb fetch query
$initial=array("count"=>0);
$reduce = 'function (obj, prev) { prev.count++; }';
$result = $collection10->group($key,$initial, $reduce);//Performing the group operation
$arrResult = $result['retval'];
$counter = 1;
$iiii=0;
$v=0;
foreach($arrResult as $value)
{
    $arr[$value["REGION"]]+=$value['count'];
}
$f=0;
foreach($regions as $val)
{
    $i[$f++]=$arr[$val];
    $arr6[$v]['REGION']=$val;
    $arr6[$v++]['COUNT']=$arr[$val];
}
//Storing the required data in view page in session
$_SESSION['arr6']=$arr6;
$_SESSION['i']=$i;
$_SESSION['regions']=$regions;
//redirecting to the view page
header("Location:../SIM/sample_kpi9.php");
?>
