<?php
   $m = new Mongo();
   $db = $m->test;
   $collection1 = $db->item_head;
   $collection=$db->invt_lifecycle;
   $collection2=$db->product_qty;
   $collection3=$db->thirdcollection;
   $collection4=$db->pos_cnt;
   $collection5=$db->cex_json;
   $collection6=$db->saf_json;
   $collection7=$db->mnp_json;
   $collection8=$db->primary_recharge;
   $collection9=$db->secondary_recharge;
   $collection10=$db->sms_json;
?>