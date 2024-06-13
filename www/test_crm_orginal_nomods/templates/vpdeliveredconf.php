<?
if (($vp_state>10)&&($vp_orderedstate==1))
  {
  echo("<h4>EXCHANGE CAPACITY HAS BEEN ENTERED AS DELIVERED</h4><br>");
// vp state change
  $vp_state=25; 
  $vp_statechangedate=time();
  $vp_orderedstate=0;
  $vp_orderedstatechangedate=time();
  if ($vp_portres<$vp_portordered) $vp_portres=$vp_portordered;
  if ($vpbw_id<$vpbwordered_id) $vpbw_id=$vpbwordered_id;
  MYSQL_QUERY("update dslprov_vp set vpbw_id='$vpbw_id',vp_portres='$vp_portres',vp_productiondate='$vp_productiondate',vp_vpi='$vp_vpi',vp_dsuk='$vp_dsuk',vp_state='$vp_state',vp_statechangedate='$vp_statechangedate',vp_orderedstate='$vp_orderedstate',vp_orderedstatechangedate='$vp_orderedstatechangedate' where vp_id='$vp_id'");
  calc_vpusage($vp_id);
// history
  }
else
  {
  echo("<h4>EXCHANGE DELIVERED STATE ERROR</h4><br>");
  }
?>
