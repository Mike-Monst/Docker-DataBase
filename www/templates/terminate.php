<?php
//$vc_reqdeliverydate=date("d.m.y",time()+604800);

$vc_state_actual=$vc_state;
//$vc_cancel_state=5;
$vc_terminate_state=39;

echo("<h4>Kündigung</h4><br>");



      $enterdate=time();
      echo("$enterdate");

$todaydate=date('d.m.Y');

$checkcanceldate=get_sertime(date('d.m.Y', strtotime('+1 day')));

$formcanceldate=get_sertime($setcanceldate);

$fdate=get_isodate_ff($formcanceldate);


$diffc=$formcanceldate-$checkcanceldate;

// echo("CHECK VCSTATE $vc_state CANCEL DATE $setcanceldate CHECK $checkcanceldate FORM $formcanceldate DIFFC $diffc ");


$diffc=0;

if ($diffc<0)
  {
  echo("<h1>FEHLER DATUM - keine Kündigung vorgemerkt.</h1>");
  }
else
  {
  if (($vc_state>29)&&($vc_state<32)&&($action == 'terminate'))

    {
//    echo ("$action UPDATE $vc_visprefnum $vc_id");
    echo("<h1>OK - Kündigung vorgemerkt. Bitte im RSP kündigen!</h1>");

    MYSQL_QUERY("UPDATE `dslprov_vc` SET vc_state='$vc_terminate_state',vc_state_voice='$vc_terminate_state',vc_canceldate='$fdate' WHERE vc_id=$vc_id;");
    MYSQL_QUERY("INSERT INTO `dslprov_vc_changes` VALUES ('', '$vc_visprefnum', 'CONFIRMED', 'CANCEL', '$setcanceldate','','','$todaydate');");
    add_vchistory($vc_id);
    }

  }

?>