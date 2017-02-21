<?php   
    @ session_start();
    //including the database page for POS
    include("dash_sample_pos.php");
    //setting the session variables to be used in the view page for POS
    $_SESSION['dash3_items']=$items;
    $_SESSION['dash3_pos']=$pos;
    $_SESSION['dash3_done']=1;
    //redirecting to the view page
    header("Location: blank.php");
?>