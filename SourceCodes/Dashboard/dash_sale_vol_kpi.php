<?php
                        
              @ session_start();    
  
   
   if(isset($_SESSION['year11']))
    {
          echo '<script>';
    echo 'var name= ' . json_encode($_SESSION['items11']) . ';';
    echo 'var name2 = ' . json_encode($_SESSION['vol11']) . ';';
    echo 'var name3= '.json_encode($_SESSION['year11']).';';
   echo 'var name4= '.json_encode($_SESSION['month11']).';';
    echo '</script>';
    include('high_sample_volume.php');
    $_SESSION['done2']=1;
   //session_destroy();
    }
?>
                    