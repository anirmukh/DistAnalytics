<?php
                        
              @ session_start();    
  
   
   if(isset($_SESSION['year']))
    {
        
        include('high_sample_count.php');
          echo '<script>';
    echo 'var name= ' . json_encode($_SESSION['items']) . ';';
    echo 'var name2 = ' . json_encode($_SESSION['ct']) . ';';
    echo 'var name3= '.json_encode($_SESSION['year']).';';
   echo 'var name4= '.json_encode($_SESSION['month']).';';
    echo '</script>';
    $_SESSION['done1']=1;
  //session_destroy();
    }
?>
                    