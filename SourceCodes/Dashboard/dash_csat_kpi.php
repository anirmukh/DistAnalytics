<?php
@ session_start();
if(isset($_SESSION['year2']))
    {
    $avg_target=$_SESSION['avg_target'];
    $avg_rec=$_SESSION['avg_rec'];
    $month=$_SESSION['month'];
    $year=$_SESSION['year2'];
     echo '<script>';
    echo 'var ss= ' . json_encode($avg_target) . ';';
    echo 'var name2 = ' . json_encode($avg_rec) . ';';
    echo 'var mnt= ' . json_encode($month) . ';';
    echo 'var yar = ' . json_encode($year) . ';';
    echo '</script>';
    include("high_sample_cex.php");
    $_SESSION['done3']=1;
                           }
?>