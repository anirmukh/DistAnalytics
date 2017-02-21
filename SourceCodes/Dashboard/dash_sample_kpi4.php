<?php                     
    @ session_start();
    //including the database page for CEX
    include("dash_sample_csat.php");
    //setting the session variables to be used in the view page for CEX
    $_SESSION['dash4_avg_tar']=$avg_target;
    $_SESSION['dash4_avg_rec']=$avg_rec;
    $_SESSION['dash4_done']=1;
    //redirecting to the view page
    header("Location: blank.php");
?>