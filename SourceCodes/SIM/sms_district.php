<?php
@ session_start();
include("../SIM/json_pos.php");//including the database for the SIM Activations
$reg=$_GET['idno'];
//grouping on the basis of area,msisdn and region
$key=array("REGION"=>1,"AREA"=>1,"MSISDN"=>1);
$regions=$collection10->distinct("AREA");//Finding distinct areas in SIM Activations database
foreach($regions as $val)
    $arr[$val]=0;
//declaring the various arguments to be used in mongodb fetch query
$initial=array("count"=>0);
$reduce = 'function (obj, prev) { prev.count++; }';
//only retrieving values for the required region
$condition = array('condition' => array("REGION" => array( '$eq' => $reg)));
$result = $collection10->group($key,$initial, $reduce,$condition);//Performing the group operation
$arrResult = $result['retval'];
$counter = 1;
$iiii=0;
foreach($arrResult as $value)
{
    $arr[$value["AREA"]]+=$value['count'];
}
$f=0;
$x=0;
$v=0;
$arr6;
foreach($regions as $val)
{
    if($arr[$val]!=0)
    { 
        $i[$f++]=$arr[$val];
        $finalreg[$x++]=$val;
        $arr6[$v]['REGION']=$val;
        $arr6[$v++]['COUNT']=$arr[$val];
    }
}
//Storing the required data in view page in session
$_SESSION['arr6']=$arr6;
$_SESSION['i']=$i;
$_SESSION['regions']=$finalreg;
//redirecting to the view page
header("Location: ../SIM/sms_district_kpi.php");   
?>
