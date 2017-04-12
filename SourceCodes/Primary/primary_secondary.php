<?php
@ session_start();
//selecting the json for recharges
include("../Primary/json_pos.php");
//retrieving system date
//$date1=date("Y/m/d");
//$time=strtotime($date1);
//$Month=(int)date("m",$time);
//$Year=(int)date("Y",$time);
$date1=2017/01/01;
$time=strtotime($date1);
$Month=1;
$Year=2017;
$Year1=$Year;
$Year2=$Year;
//finding out the previous two months
$Month1=$Month-1;
$Month2=$Month1-1;
//adjusting the value of month and year based on if the present month is January or else February
if($Month1==0)
{
    $Month1=12;
    $Month2=11;
    $Year1=$Year-1;
    $Year2=$Year-1;
}
else if($Month2==0)
{
       $Month2=12;
       $Year2=$Year-1;
}
$Year=(string)$Year;
$Year1=(string)$Year1;
$Year2=(string)$Year2;
$Month=(string)$Month;
$Month1=(string)$Month1;
$Month2=(string)$Month2;

if($Month1<10)
$Month1=('0'.$Month1);    
if($Month2<10)
$Month2=('0'.$Month2);
//making date objects for present and last two months
$d=mktime(10,25,15,$Month,10,$Year);
$d1=mktime(10,25,15,$Month1,10,$Year1);
$d2=mktime(10,25,15,$Month2,10,$Year2);
//finding out the distinct regions
$regions=$collection8->distinct("region");
foreach($regions as $val)
{
    $regtot[$val]=0;
    $regarr[$val]=0;
    $regarr1[$val]=0;
    $regarr2[$val]=0;
}
//grouping based on region, month, year and amount
$key=array("region"=>1,"Month"=>1,"Year"=>1,"Amount"=>1);
$initial=array("count"=>0);
$condition=array('condition'=>array('$or' => array(
        array(
          'Month' => $Month,
          'Year' => $Year
        ),
        array(
          'Month' => $Month1,
          'Year' => $Year1
        ),
        array(
          'Month' => $Month2,
          'Year' => $Year2
        )
      )
    ));
                                                
$reduce = 'function (obj, prev) { prev["count"] += new NumberInt(obj.Amount); }';
$total=0;
$total1=0;
$total2=0;
$total3=0;
$result = $collection8->group($key,$initial, $reduce,$condition);
$fin=$result['retval'];
$count=0;
//different classes for different table row color
$color=array("info","warning","success");
$flag1=0;
foreach($fin as $val)
{
    //calculating the amount for the present month
    if(strstr($val["Month"],$Month)==$Month)
    {
        //calculating the amount for present month - region wise
        $regarr[$val["region"]]+=$val["Amount"];
        //calculating the present month total
        $total1+=$val["Amount"];
    }//calculating the amount for the last month
    else if(strstr($val["Month"],$Month1)==$Month1)
    {
        //calculating the amount for last month - region wise
        $regarr1[$val["region"]]+=$val["Amount"];
        //calculating the last month total
        $total2+=$val["Amount"];
    }//calculating the amount for the second last month
    else if(strstr($val["Month"],$Month2)==$Month2)
    {
        //calculating the amount for second last month - region wise
        $regarr2[$val["region"]]+=$val["Amount"];
        //calculating the second last month total
        $total3+=$val["Amount"];
    }
}
$v=0;
$arr1;
$arr2;
foreach($regions as $val1)
{
    $arr1[$v]["REGION"]=$val1;
    $arr1[$v]["MONTH2"]=$regarr2[$val1];
    $arr1[$v]["MONTH1"]=$regarr1[$val1];
    $arr1[$v++]["MONTH"]=$regarr[$val1];
}
$arr1[$v]["REGION"]="TOTAL";
$arr1[$v]["MONTH2"]=$total3;
$arr1[$v]["MONTH1"]=$total2;
$arr1[$v]["MONTH"]=$total1;
/*
    SIMILAR PROCEDURE IS OPTED FOR SECONDARY RECHARGES       
*/
$regions1=$collection9->distinct("Region");
foreach($regions1 as $val)
{
    $regarr1[$val]=0;
    $regarr11[$val]=0;
    $regarr21[$val]=0;
}
$key1=array("Region"=>1,"Month"=>1,"Year"=>1);
$initial1=array("Amount"=>0);                                      
$reduce1='function (obj, prev) { prev["Amount"] += new NumberInt(obj.Amount); }';
$total11=0;
$total21=0;
$total31=0; 
$condition=array('condition'=>array('$or' => array(
        array(
          'Month' => $Month,
          'Year' => $Year
        ),
        array(
          'Month' => $Month1,
          'Year' => $Year1
        ),
        array(
          'Month' => $Month2,
          'Year' => $Year2
        )
      )
    ));
$result1= $collection9->group($key1,$initial1,$reduce1,$condition);
$fin1=$result1['retval'];
$count=0;
$flag1=0;
$l=0;
foreach($fin1 as $val)
{   
    $l++;
    if(strstr($val["Month"],$Month)==$Month)
    {
        $regarr1[$val["Region"]]+=$val["Amount"];
        $total11+=$val["Amount"];
    }
    else if(strstr($val["Month"],$Month1)==$Month1)
    {
        $regarr11[$val["Region"]]+=$val["Amount"];
        $total21+=$val["Amount"];
    }
    else if(strstr($val["Month"],$Month2)==$Month2)
    {
        $regarr21[$val["Region"]]+=$val["Amount"];
        $total31+=$val["Amount"];
    }
}
$v=0;
foreach($regions as $val1)
{
    $arr2[$v]["REGION"]=$val1;
    $arr2[$v]["MONTH2"]=$regarr21[$val1];
    $arr2[$v]["MONTH1"]=$regarr11[$val1];
    $arr2[$v++]["MONTH"]=$regarr1[$val1];
}
$arr2[$v]["REGION"]="TOTAL";
$arr2[$v]["MONTH2"]=$total31;
$arr2[$v]["MONTH1"]=$total21;
$arr2[$v]["MONTH"]=$total11;
//session variables are which will be used in the view page
$_SESSION['primary']=$arr1;
$_SESSION['secondary']=$arr2;
$_SESSION['date1']=date("F-Y", $d);
$_SESSION['date2']=date("F-Y", $d1);
$_SESSION['date3']=date("F-Y", $d2);
//passing the control to the view page
header("Location: ../Primary/sample_kpi6.php");
?>
