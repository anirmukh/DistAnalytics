<?php                   
    @ session_start();
    //including the database page for Sales Count
    include("dash_sample_count.php");
    //setting the session variables to be used in the view page for Sales Count
    $_SESSION['dash1_items']=$items;
    $_SESSION['dash1_ct']=$ct;
    $_SESSION['dash1_done']=1;
    //redirecting to the view page
    header("Location: blank.php");
?>