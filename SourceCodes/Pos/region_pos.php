<?php
include('../Pos/json_pos.php');//including the database for the POS data
session_start();
//Finding out the distinct regions and items in database for POS data
$items=$collection4->distinct("POS_TYPE");
$regions=$collection4->distinct("REGION");
$_SESSION['items']=$items;        
//grouping on the basis of pos type and region
$key=array("POS_TYPE"=>1,"REGION"=>1);
$year=$_GET['idno'];
$month=$_GET['idno1'];
//declaring the various arguments to be used in mongodb fetch query
$initial=array("count"=>0);
$cursor = $collection4->find()->sort(array('REGION'=>1));
//Summing up the POS Count for each category based on group operation
$reduce = 'function (obj, prev) { prev["count"] += new NumberInt(obj.POS_COUNT); }';
//only retrieving values for the required month and year
$condition = array('condition' => array("YEAR" => array( '$eq' => $year),"MONTH"=>array('$eq'=>$month)));
$result = $collection4->group($key,$initial, $reduce,$condition);//Performing the group operation
$fin=$result['retval'];
$i=0;  
$arr;
$arr2;
for($ii=0;$ii<sizeof($regions);$ii++)
{
    for($jj=0;$jj<sizeof($items);$jj++)
    {
        $arr[$regions[$ii]][$items[$jj]]=0;
    }
}
foreach($fin as $res)
{   
    $reg=$res["REGION"];
    $it=$res["POS_TYPE"];
    $arr[$reg][$it]=$res["count"];
}
//Storing the required array in view page in session
$_SESSION['arr']=$arr;
//redirecting to the view page
header("Location:../Pos/region_pos_kpi.php");
?>
