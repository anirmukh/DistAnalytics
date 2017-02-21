<?php
   $m = new Mongo();
   $db = $m->test;
   $collection1 = $db->item_head;
   $collection=$db->invt_lifecycle;
   $collection2=$db->product_qty;
   $collection3=$db->thirdcollection;
   $collection4=$db->sales_cnt_json;
   $collection5=$db->sales_vol;
?>