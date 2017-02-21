<?php      
    @ session_start();
    //including the database page for Sales Volume
    include("dash_sample_vol.php");
    //setting the session variables to be used in the view page for Sales Volume
    $_SESSION['dash2_items']=$items;
    $_SESSION['dash2_vol']=$vol;
    $_SESSION['dash2_done']=1;
    //redirecting to the view page
    header("Location: blank.php");
?>