<?php
//$vc_reqdeliverydate=date("d.m.y",time()+604800);

$vc_state_actual=$vc_state;
$vc_cancel_state=5;

echo("<h4>STORNO</h4><br>");



      $enterdate=time();
      echo("$enterdate");

echo("CHECK VCSTATE $vc_state $action");


if (($vc_state<23)&&($action == 'cancel'))

  {
  echo ("$action UPDATE $vc_visprefnum $vc_id");
  MYSQL_QUERY("UPDATE `dslprov_vc` SET vc_state='$vc_cancel_state',vc_state_voice='$vc_cancel_state',vc_refnum='' WHERE vc_id=$vc_id;");
  }

add_vchistory($vc_id);


?>