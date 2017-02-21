<?php
@ session_start();
include("../SIM/json_pos.php");//including the database for the SIM Activations
$dis1=$_GET['idno'];
$dis=str_replace("%20"," ",$dis1);
//grouping on the basis of area,msisdn and distributor name
$key=array("AREA"=>1,"DH_NAME"=>1,"MSISDN"=>1);
echo "<br><br>";
$regions=$collection10->distinct("DH_NAME");//Finding distinct distributors in SIM Activations database
foreach($regions as $val)
    $arr[$val]=0;
//declaring the various arguments to be used in mongodb fetch query
$initial=array("count"=>0);
$reduce = 'function (obj, prev) { prev.count++; }';
//only retrieving values for the required area
$condition = array('condition' => array("AREA" => array( '$eq' => $dis)));
$result = $collection10->group($key,$initial, $reduce,$condition);//Performing the group operation
$arrResult = $result['retval'];
$counter = 1;
$iiii=0;
foreach($arrResult as $value)
{
    $arr[$value["DH_NAME"]]+=$value['count'];
}
$f=0;
$x=0;
$v=0;
foreach($regions as $val)
{
    if($arr[$val]!=0)
    {
        $i[$f++]=$arr[$val];
        $arr6[$v]['REGION']=$val;
        $arr6[$v++]['COUNT']=$arr[$val];
        $finalreg[$x++]=$val;
    }
}
//Storing the required data in view page in session
$_SESSION['arr6']=$arr6;
$_SESSION['i']=$i;
$_SESSION['regions']=$finalreg;
//redirecting to the view page
header("Location: ../SIM/sms_distributor_kpi.php");  
?>
