<?php
session_start();
//selecting the json for SAF
include("../SAF/json_pos.php");
//retrieving system date
$date1=date("Y/m/d");
$time=strtotime($date1);
$month=(int)date("m",$time);
$year=(int)date("Y",$time);
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
$regions=$collection6->distinct("REGION");
foreach($regions as $val)
{
    $regtot[$val]=0;
    $regarr[$val]=0;
    $regarr1[$val]=0;
    $regarr2[$val]=0;
}
//grouping on the basis of region,month,year and SAF Collected
$key=array("REGION"=>1,"MONTH"=>1,"YEAR"=>1,"SAF_COLLECTED"=>1);
//declaring the various arguments to be used in mongodb fetch query
$initial=array("count"=>0);
$cursor = $collection6->find(array('$or' => array(
        array(
          'MONTH' => $month,
          'YEAR' => $year
        ),
        array(
          'MONTH' => $month1,
          'YEAR' => $year1
        ),
        array(
          'MONTH' => $month2,
          'YEAR' => $year2
        )
      )
    ));
                                                
$reduce = 'function (obj, prev) { prev["count"] += new NumberInt(obj.SAF_COLLECTED); }';
$total=0;
$total1=0;
$total2=0;
$total3=0;
$result = $collection6->group($key,$initial, $reduce);//Performing the group operation
$fin=$result['retval'];
$count=0;
$color=array("info","warning","success");
$flag1=0;
$arr2;
$v=0;
foreach($fin as $val)
{
    $total+=$val["SAF_COLLECTED"];
    $regtot[$val["REGION"]]+=$val["SAF_COLLECTED"];
    //calculating the amount for the present month
    if(strstr($val["MONTH"],$month)==$month)
    {
        //calculating the amount for present month - region wise
        $regarr[$val["REGION"]]+=$val["SAF_COLLECTED"];
        //calculating the present month total
        $total1+=$val["SAF_COLLECTED"];
    }//calculating the amount for the last month
    else if(strstr($val["MONTH"],$month1)==$month1)
    {
         //calculating the amount for last month - region wise
        $regarr1[$val["REGION"]]+=$val["SAF_COLLECTED"];
        //calculating the last month total
        $total2+=$val["SAF_COLLECTED"];
    }//calculating the amount for the second last month
    else if(strstr($val["MONTH"],$month2)==$month2)
    {
        //calculating the amount for second last month - region wise
        $regarr2[$val["REGION"]]+=$val["SAF_COLLECTED"];
         //calculating the second last month total
        $total3+=$val["SAF_COLLECTED"];
    }
}
foreach($regions as $val1)
{

            $arr2[$v]["REGION"]=$val1;
        $arr2[$v]["MONTH2"]=$regarr2[$val1];
         $arr2[$v]["MONTH1"]=$regarr1[$val1];
          $arr2[$v]["MONTH"]=$regarr[$val1];
          $arr2[$v++]["TOTAL"]=$regtot[$val1];
    
     
}
$arr2[$v]["REGION"]="TOTAL";
$arr2[$v]["MONTH2"]=$total3;
$arr2[$v]["MONTH1"]=$total2;
$arr2[$v]["MONTH"]=$total1;
$arr2[$v]["TOTAL"]=$total;
//session variables are which will be used in the view page
$_SESSION['saf']=$arr2;
$_SESSION['date1']=date("F-Y", $d);
$_SESSION['date2']=date("F-Y", $d1);
$_SESSION['date3']=date("F-Y", $d2);
//passing the control to the view page
header("Location: ../SAF/sample_kpi8.php");
?>
