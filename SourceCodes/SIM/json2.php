<?php
   $m = new Mongo();
   $db = $m->test;
   $collection1 = $db->item_head;
   $collection=$db->invt_lifecycle;
   $collection2=$db->product_qty;
   $collection3=$db->thirdcollection;
   $collection4=$db->sales_vol;
   $collection5=$db->daily_sales;
   $collection6=$db->cluster;   
?>