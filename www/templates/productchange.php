<?php
//$vc_reqdeliverydate=date("d.m.y",time()+604800);

$vc_state_actual=$vc_state;
//$vc_cancel_state=5;
$vc_pchange_state=32;

echo("<h4>Produktwechsel</h4><br>");



      $enterdate=time();
      echo("$enterdate");

$todaydate=date('d.m.Y');

$checkpchangedate=get_sertime(date('d.m.Y', strtotime('first day of next month')));

$formpchangedate=get_sertime($setpchangedate);

$diffc=$formpchangedate-$checkpchangedate;

// echo("CHECK VCSTATE $vc_state CANCEL DATE $setpchangedate CHECK $checkpchangedate FORM $formpchangedate DIFFC $diffc ");

if ($diffc<0)
  {
  echo("<h1>FEHLER DATUM - kein Produktwechsel vorgemerkt.</h1>");
  }
else if ($product_id==$product_id_change)
  {
  echo("<h1>FEHLER PRODUKT - identisch</h1>");
  }  
else
  {
  if (($vc_state>29)&&($vc_state<32)&&($action == 'productchange'))

    {
//    echo ("$action UPDATE $vc_visprefnum $vc_id");
    echo("<h1>OK - Produktwechsel zum $setpchangedate vorgemerkt. <br>Bitte im RSP ordern!</h1>");

    MYSQL_QUERY("UPDATE `dslprov_vc` SET vc_state='$vc_pchange_state',vc_state_voice='$vc_pchange_state' WHERE vc_id=$vc_id;");
    MYSQL_QUERY("INSERT INTO `dslprov_vc_changes` VALUES ('', '$vc_visprefnum', 'CONFIRMED', 'PRODUCTCHANGE', '$setpchangedate','$product_id','$product_id_change','$todaydate');");
    add_vchistory($vc_id);

    }

  }

?>
