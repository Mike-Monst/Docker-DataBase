<?php

// under construction
// scenarios: up/downgrades without bt action / with bt action and state chges
// reorder when state < 9
// ...

if ($vc_state<9)
  {
  $vc_state=22;
  }

//echo("$vc_state");
//if ($vc_state>10)
//  {
  echo("<h4>CUSTOMER DATA HAS BEEN MODIFIED.</h4><br>");
//  $vc_state=; 

// rules definition  

// if ($vp_portres<$vp_portordered) $vp_portres=$vp_portordered;
//  if ($vpbw_id<$vpbwordered_id) $vpbw_id=$vpbwordered_id;
  $vc_statechangedate=time();
  MYSQL_QUERY("update dslprov_vc set userbw_id='$userbw_id',usercr_id='$usercr_id',vc_vci='$vc_vci',ip='$ip',vc_cbuk='$vc_cbuk',userrealm_id='$userrealm_id',btproduct_id='$btproduct_id',vc_state='$vc_state' where vc_id='$vc_id'");
  add_vchistory($vc_id);  
//  }
//else
//  {
//  echo("<h4>ERROR: NO MODIFICATION POSSIBLE</h4><br>");
//  }
?>
