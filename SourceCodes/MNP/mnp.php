<?php
//selecting the json for MNP
include("../MNP/json_pos.php");
@ session_start();
//retrieving system date
//$date1=date("Y/m/d");
//$time=strtotime($date1);
//$month=(int)date("m",$time);
//$year=(int)date("Y",$time);
$date1=2017/01/01;
$time=strtotime($date1);
$month=01;
$year=2017;
$year1=$year;
$year2=$year;
//finding out the previous two months
$month1=$month-1;
$month2=$month1-1;
//adjusting the value of month and year based on if the present month is January or else February
if($month1==0)
{
    $month1=12;
    $month2=11;
    $year1=$year-1;
    $year2=$year-1;
}
else if($month2==0)
{
       $month2=12;
       $year2=$year-1;
}
$year=(string)$year;
$year1=(string)$year1;
$year2=(string)$year2;
$month=(string)$month;
$month1=(string)$month1;
$month2=(string)$month2;
if($month1<10)
$month1=('0'.$month1);    
if($month2<10)
$month2=('0'.$month2);
$d=mktime(10,25,15,$month,10,$year);
$d1=mktime(10,25,15,$month1,10,$year1);
$d2=mktime(10,25,15,$month2,10,$year2);
$regions=$collection7->distinct("Region");
foreach($regions as $val)
{
    $regarrin[$val]=0;
    $regarrin1[$val]=0;
    $regarrin2[$val]=0;
    $regarrout[$val]=0;
    $regarrout1[$val]=0;
    $regarrout2[$val]=0;
    $tot[$val]=0;
}
//grouping on the basis of region,month,year and MNP Flag
$key=array("Region"=>1,"Month"=>1,"Year"=>1,"MNP_Flag"=>1);
//declaring the various arguments to be used in mongodb fetch query
$initial=array("count"=>0);
$cursor = $collection7->find(array('$or' => array(
        array(
          'Month' => $month,
          'Year' => $year
        ),
        array(
          'Month' => $month1,
          'Year' => $year1
        ),
        array(
          'Month' => $month2,
          'Year' => $year2
        )
      )
    ));
                                                
$reduce = 'function (obj, prev) { prev.count++; }';
$total=0;
$total1=0;
$total2=0;
$total3=0;
$result = $collection7->group($key,$initial, $reduce);//Performing the group operation
$fin=$result['retval'];
$count=0;
foreach($fin as $val)
{
    //calculating the amount for the present month
    if(strstr($val["Month"],$month)==$month)
    {
        //Checking Port In and Port Out
        if((int)$val["MNP_Flag"]==1)
        {
         $regarrin[$val["Region"]]+=$val['count'];//calculating the count for present month - region wise
         }
         else
          $regarrout[$val["Region"]]+=$val['count'];//calculating the count for present month - region wise
    }//calculating the amount for the last month
    else if(strstr($val["Month"],$month1)==$month1)
    {
         //Checking Port In and Port Out
         if((int)$val["MNP_Flag"]==1)
         $regarrin1[$val["Region"]]+=$val['count'];//calculating the count for present month - region wise
         else
          $regarrout1[$val["Region"]]+=$val['count'];//calculating the count for present month - region wise
    }//calculating the amount for the second last month
    else if(strstr($val["Month"],$month2)==$month2)
    {
         //Checking Port In and Port Out
        if((int)$val["MNP_Flag"]==1)
            $regarrin2[$val["Region"]]+=$val['count'];//calculating the count for present month - region wise
         else
          $regarrout2[$val["Region"]]+=$val['count'];//calculating the count for present month - region wise
    }
}
$arr;
$v=0;
foreach($regions as $val1)
{
     $arr[$v]['region']=$val1;
     $arr[$v]['p1']=$regarrin2[$val1];
     $arr[$v]['p2']=$regarrout2[$val1];
    $arr[$v]['p3']=$regarrin1[$val1];
     $arr[$v]['p4']=$regarrout1[$val1];
     $arr[$v]['p5']=$regarrin[$val1];
     $arr[$v++]['p6']=$regarrout[$val1];
}
//session variables are which will be used in the view page
$_SESSION['mnp']=$arr;
$_SESSION['date1']=date("F-Y", $d);
$_SESSION['date2']=date("F-Y", $d1);
$_SESSION['date3']=date("F-Y", $d2);
header("Location: ../MNP/sample_kpi7.php");
//passing the control to the view page
?>
