<?php
  echo("<h4>CUSTOMER HAS BEEN PREPARED FOR CEASE.</h4><br>");
  $vc_state=31; 
  $vc_statechangedate=time();
  MYSQL_QUERY("update dslprov_vc set vc_state='$vc_state',vc_statechangedate='$vc_statechangedate' where vc_id='$vc_id'");
  add_vchistory($vc_id); 
?>
