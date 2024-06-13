<?

// VBR --> CBR & co

if (($vp_state>10)&&($vp_state<30))
  {
  $upgrade=0;
  if ($vp_portres>$vp_portresold)
    {
    $upgrade=1;
    $vp_portordereddate=time();
    }
  if ($vpbw_id>$vpbw_idold)
    {
    $upgrade=1;
    $vp_bwordereddate=time();
    }
  $demand=0;
  if ($vp_portres<$vp_portdemand)
    {
    $demand=1;
//    echo("A1");
    }
  $bwvalue=get_vpbw($vpbw_id);
  if ($bwvalue<$vp_bwdemand)
    {
    $demand=1;
//    echo("B1");
    }


  $diff=$vp_updemandstate-$demand;
//  echo("$diff");

  if ($upgrade==1)
    {
    echo("<h4>EXCHANGE/UPGRADE HAS BEEN ORDERED</h4><br>");
    // statechange in history
    $vp_updemandstate=$demand;
    if ($diff!=0)
      {
      $vp_updemandstatechangedate=time();
      }
    $vp_orderedstate=1;
    $vp_orderedstatechangedate=time();
    MYSQL_QUERY("update dslprov_vp set vp_reqdeliverydate='$vp_reqdeliverydate',vpbwordered_id='$vpbw_id',vp_portordered='$vp_portres',vp_portordereddate='$vp_portordereddate',vp_bwordereddate='$vp_bwordereddate',vp_orderedstate='$vp_orderedstate',vp_orderedstatechangedate='$vp_orderedstatechangedate',vp_updemandstate='$vp_updemandstate',vp_updemandstatechangedate='$vp_updemandstatechangedate' where vp_id='$vp_id'");
//history
    }
  else
    {
    echo("<h4>EXCHANGE ORDER/UPGRADE NO CHANGE</h4><br>");
    }
  }
else
  {
  echo("<h4>EXCHANGE ORDER/UPGRADE STATE ERROR</h4><br>");
  }
?>
