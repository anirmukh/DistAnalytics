<?php
@session_start();
include("../HW/json2.php");
if($_GET['idno']==1)
{
$collection5=$db->daily_sales;
$res=$collection5->find();
$items = $collection1->distinct("ITEM_HEAD_NAME");
$len=sizeof($items);
foreach ($res as $value)
{
    $mindate=$value["SALES_DATE"];
    break;
}
$_SESSION['done']=1;
$_SESSION['items']=$items;
$_SESSION['mindate']=$mindate;
header("Location:../HW/sample_kpi10.php");
}
else if($_GET['idno']!=1)
{


    $item=$_GET['sel_item'];
    $from=$_GET['from'];
    $type=$_GET['type1'];
    $period=$_GET['period'];
    $_SESSION['sel_item']=$item;
    $_SESSION['from']=$from;
    $_SESSION['type']=$type;
    $_SESSION['period']=$period;
    $sys=date("Y-m-d");
    $date1=date_create($from);
    $date2=date_create($sys);
    $diff=date_diff($date1,$date2);
    $diff= $diff->format("%a");
    $flag=1;
    if($type==0)
    {
        if($diff<90)
        {
            $flag=0;
            echo "<script>alert('FORCASTING NOT POSSIBLE. NUMBER OF DAYS < 90')</script>"; 
        }
        
    }
    if($type==1)
    {
        $week=round($diff/7);
        if($week<4)
        {
            $flag=0;
            echo "<script>alert('FORCASTING NOT POSSIBLE. NUMBER OF WEEKS < 4')</script>";
        }
    }
    if($type==2)
    {
        $month=round($diff/30);
        if($month<2)
        {
            $flag=0;
            echo "<script>alert('FORCASTING NOT POSSIBLE. NUMBER OF MONTHS < 2')</script>";
        }
    }
    if($flag==1)
    {
        echo "<br><br>";
    $cursor =$collection5->find(array("ITEM_HEAD_NAME"=>$item));
    $fp = fopen('file.csv', 'a');
    $head=array("ID","DATE","SALES","ITEM NAME");
    fputcsv($fp,$head);
    $final;
    foreach ($cursor as $value)
    {
        $date3=date_create($value['SALES_DATE']);
        $diff1=date_diff($date2,$date3);
        $diff1=$diff1->format("%a");
       // echo $diff1." ".$diff."<br>";
        if($diff1<=$diff)        
        fputcsv($fp, $value);   
    }
    fclose($fp);
    exec("Rscript.exe holt.R $period $type");
   
    $f=fopen("sales.csv","r");
    $c=0;
    $arr;
    $v=0;
       while (($line = fgetcsv($f)) !== false) {
        if($c==0)
        {
            $head1=$line[1];
            $head2=$line[2];
            $c++;
          }
          else
          {
            $arr[$v]["head1"]=(int)$line[1];
            $arr[$v++]["head2"]=round((float)$line[2],2);
          }
        }
        fclose($f);
    $f = fopen("fin.csv", "r");
    $c=0;
    $arr;
    $v=0;
  
         while (($line = fgetcsv($f)) !== false) {
       if($c==0)
       {
            $c++;
       }
       else 
       {
         $s1=explode(" ",$line[0]);
         $arr[$v]["co"]=round((float)$s1[1],2);
         $arr[$v]["l1"]=round((float)$s1[2],2);
         $arr[$v]["h1"]=round((float)$s1[3],2);
         $arr[$v]["l2"]=round((float)$s1[4],2);
         $arr[$v++]["h2"]=round((float)$s1[5],2);
       }
      
    }
     fclose($f);
     $_SESSION['arr']=$arr;
     $_SESSION['head1']=$head1;
     $_SESSION['head2']=$head2;
     header("Location:../HW/sample_kpi10.php");
    }
}

?>