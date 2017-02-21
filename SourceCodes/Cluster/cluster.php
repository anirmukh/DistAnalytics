<?php
include("../Cluster/json2.php");
$items = $collection6->distinct("ITEM_HEAD");
$regions=$collection6->distinct("REGION");
$len=sizeof($items);
$sys=date("Y-m-d");
echo" <div class='row'><div class='col-lg-6'>
<form>";
echo " <div class='form-group'>";
echo "<label>Select Category </label>";
echo "<p><select name='sel_item' class='form-control' required></p>";
foreach($items as $i)
{   
   echo "<option value='$i'>$i</option>"; 
}
echo "</select><br>";
echo "<label>Enter a date to do analysis from :</label>
<p><input type='date' class='form-control' name='from' required/></p><br>
<label>Analysis Till Date:</label><br><p><input type='date' class='form-control' name='to'required></p>" ."<br>";
echo "<label>Select REGION</label><br>";
echo "<p><select name='sel_reg' class='form-control' required></p>";
echo "<option value=ALL>ALL REGIONS</option>";
foreach($regions as $i)
{   
    if($i!='null')
   echo "<option value='$i'>$i</option>"; 
}
echo "</select><br><br>";
echo "<label><input type='submit' class='form-control' name='sbt'></label></div>
</form></div></div>
";
if(isset($_GET['sbt']))
{
    $from=$_GET['from'];
    $sys=$_GET['to'];
    $item=$_GET['sel_item'];
    $region=$_GET['sel_reg'];
    $date1=date_create($from);
    $date2=date_create($sys);
    $diff=date_diff($date1,$date2);
    $diff= $diff->format("%a");
    if($region!='ALL')
    $cursor =$collection6->find(array("ITEM_HEAD"=>$item,"REGION"=>$region));
    else
    $cursor =$collection6->find(array("ITEM_HEAD"=>$item));
    $v=0;
   $arr;
    $fp = fopen('file_cluster.csv', 'a');
    $head=array("ACT","DISTRIBUTOR_CODE","SSO","ITEM_HEAD","REGION");
    fputcsv($fp,$head);
    $v=0;
    $x=0;
    foreach($cursor as $value)
    {
        $arr[$x]["ACT"]=(int)$value["ACT_CNT"];
        $arr[$x]["DISTRIBUTOR_CODE"]=$value["DISTRIBUTOR_CODE"];
        $arr[$x]["SSO"]=(int)$value["SSO_CNT"];
        $arr[$x]["ITEM_HEAD"]=$value["ITEM_HEAD"];
        $arr[$x++]["REGION"]=$value["REGION"];
        $date3[$v++]=$value['DATE'];
        
    }
    $v=0;
    foreach($arr as $val)
    {
        $d=date_create($date3[$v++]);
        $diff1=date_diff($date2,$d);
        $diff1=$diff1->format("%a");
        if($diff1<=$diff)  {
        fputcsv($fp,$val);
    }
}
fclose($fp);
exec("Rscript.exe cluster.R");
echo('<img src="cluster.png" alt="loading" />');   
echo '<div class="row"><div class="col-lg-6"><form action="../Cluster/downloadFile.php" method="post">
<input type="submit" class="form-control" name="submit" value="Download Clustering Data" />
</form></div></div>';
}
?>