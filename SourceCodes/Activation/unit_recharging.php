<?php
@ session_start();
//including ths json required for the data
include("../Activation/json_pos.php");
//retrieving the system date
$date1=date("Y/m/d");
$time=strtotime($date1);
$Month=(int)date("m",$time);
$Year=(int)date("Y",$time);
//finding the date for last two months
$Year1=$Year;
$Year2=$Year;
$Month1=$Month-1;
$Month2=$Month1-1;
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
if($Month<10)
    $Month=('0'.$Month);
if($Month1<10)
    $Month1=('0'.$Month1);    
if($Month2<10)
    $Month2=('0'.$Month2);
//declaring date objects for present and previos two months
$d=mktime(10,25,15,$Month,10,$Year);
$d1=mktime(10,25,15,$Month1,10,$Year1);
$d2=mktime(10,25,15,$Month2,10,$Year2);
//finding out distinct regions
$regions=$collection4->distinct("REGION");
foreach($regions as $val)
{
    $regtot[$val]=0;
    $regarr[$val]=0;
    $regarr1[$val]=0;
    $regarr2[$val]=0;
}
//doing a group by based on region, month, year and pos_type
$key=array("REGION"=>1,"MONTH"=>1,"YEAR"=>1,"POS_TYPE"=>1);
$initial=array("count"=>0);                                                
$reduce = 'function (obj, prev) { prev["count"] += new NumberInt(obj.POS_COUNT); }';
$condition=array('condition'=>array('$or' => array(
        array(
          'MONTH' => $Month,
          'YEAR' => $Year
        ),
        array(
          'MONTH' => $Month1,
          'YEAR' => $Year1
        ),
        array(
          'MONTH' => $Month2,
          'YEAR' => $Year2
        )
      )
    ));
$total=0;
$total1=0;
$total2=0;
$total3=0;
$result = $collection4->group($key,$initial, $reduce,$condition);
$fin=$result['retval'];
$count=0;
$resl;
$v=0;
$ii=0;
$arr1;
foreach($fin as $val)
{
    //calculating values for TELCO - month wise(present and last two months)
    if(strstr($val["POS_TYPE"],"TELCO")=="TELCO")
    {
        //for present month
        if(strstr($val["MONTH"],$Month)==$Month)
        {
            $regarr[$val["REGION"]]+=$val["count"];
            $total1+=$val["count"];
        }
        else if(strstr($val["MONTH"],$Month1)==$Month1)
        {
            //for last month
            $regarr1[$val["REGION"]]+=$val["count"];
            $total2+=$val["count"];
        }
        else if(strstr($val["MONTH"],$Month2)==$Month2)
        {
            //for second last month
            $regarr2[$val["REGION"]]+=$val["count"];
            $total3+=$val["count"];
        }
    }
}
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
foreach($regions as $val)
{
    $regtot[$val]=0;
    $regarr[$val]=0;
    $regarr1[$val]=0;
    $regarr2[$val]=0;
}
/*
        SIMILARLY CALCULATING VALUES FOR ERS
*/
foreach($fin as $val)
{
    if(strstr($val["POS_TYPE"],"ERS")=="ERS")
    {
        if(strstr($val["MONTH"],$Month)==$Month)
        {
            $regarr[$val["REGION"]]+=$val["count"];
            $total1+=$val["count"];
        }
        else if(strstr($val["MONTH"],$Month1)==$Month1)
        {
            $regarr1[$val["REGION"]]+=$val["count"];
            $total2+=$val["count"];
        }
        else if(strstr($val["MONTH"],$Month2)==$Month2)
        {
            $regarr2[$val["REGION"]]+=$val["count"];
            $total3+=$val["count"];
        }
    }
}
$v=0;
foreach($regions as $val1)
{
    $arr2[$v]["REGION"]=$val1;
    $arr2[$v]["MONTH2"]=$regarr2[$val1];
    $arr2[$v]["MONTH1"]=$regarr1[$val1];
    $arr2[$v++]["MONTH"]=$regarr[$val1]; 
}
$arr2[$v]["REGION"]="TOTAL";
$arr2[$v]["MONTH2"]=$total3;
$arr2[$v]["MONTH1"]=$total2;
$arr2[$v]["MONTH"]=$total1;
//stroing the result in sesson variables
$_SESSION['activation']=$arr1;
$_SESSION['recharging']=$arr2;
$_SESSION['date1']=date("F-Y", $d);
$_SESSION['date2']=date("F-Y", $d1);
$_SESSION['date3']=date("F-Y", $d2);
//passing the control to the view page
header("Location: ../Activation/sample_kpi5.php");
?>
