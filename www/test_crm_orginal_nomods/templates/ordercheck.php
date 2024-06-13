<?
//$vc_reqdeliverydate=date("d.m.y",time()+604800);

if (($vca_availreasoncode=='BTOK')||($action=='vpdeliveredconf'))
  {
// --> BTOK
  
// vcstate:
// <=10 : not to be used in calc
//
//  1 : pending_bterror
//  5 : cancelled
//  6 : rejected
//  9 : ceased

// >10 : to be used in cli double
//
//  11: new
//  12: pending (bw,crsum BW upgrade)
//  13: reserved

// >20 : to be used in calc
//
//  21: pending (ports Port upgrade)
//  22: orderprepare
//  23: ordered
//  24: committed (commitdate BT)
//  25: installed (installdate BT)
//  26: vci issued (prod BT)
//  27: productive (configured)
//  31: cease prepare

      // DB double cli check

  if ($action=='vpdeliveredconf')
    {
    $number=0;
    $ordermode=2;
    }
  else
    {
    $query="select * from dslprov_vc where vc_cli LIKE '$vca_cli' AND vc_state >10";
    $result=mysql_query($query);
    $number=mysql_num_rows($result);
    }

  if ($number>0)
    {
    echo("<h4>Inventory Error: CLI double</h4><br>");
    $vca_availreasoncode='T-CLI';
    }
  else

    // DB VP exists for exchange check, highest preferred weight
    {
    if ($action=='vpdeliveredconf')
      {
      $query="select * from dslprov_vp where vp_id LIKE $vp_id";
      }
    else
      {
      $query="select * from dslprov_vp where exchange_id LIKE '$vca_exchangecode' AND vp_state >10 ORDER BY vp_preferred DESC";
      }
    $result=mysql_query($query);
    $number=mysql_num_rows($result);
    $rowarray=mysql_fetch_array($result);
    $vp_preferred=$rowarray['vp_preferred'];
    $vp_id=$rowarray['vp_id'];
    $vpbw_id=$rowarray['vpbw_id'];
    $vp_bwdemand=$rowarray['vp_bwdemand'];
    $vp_portres=$rowarray['vp_portres'];
    $vp_portdemand=$rowarray['vp_portdemand'];
    $vp_state=$rowarray['vp_state'];

    if ($number>0)
      {
      if ($debug) echo("VP exists nu $number pref $vp_preferred vpid $vp_id<br>");

      $query="select vpbw_value from dslprov_vpbw where vpbw_id LIKE '$vpbw_id'";
      $result=mysql_query($query);
      $number=mysql_num_rows($result);
      $rowarray=mysql_fetch_array($result);
      $vpbw_value=$rowarray['vpbw_value'];
      if ($debug) echo("vpbw_value $vpbw_value<br>");

      $bwerror=0;
      $bwerrortotal=0;
      $crsum=0;
      $crsumtotal=0;
      $crerror=0;
      $porterror=0;

      $query="select vc_id,vc_state,userbw_id,usercr_id from dslprov_vc where vp_id LIKE '$vp_id' AND vc_state >10 ORDER BY vc_state DESC";
      $result=mysql_query($query);
      $vcinvp=0;
      $vcinvptotal=0;

      for ($i=0;$i < mysql_num_rows($result);$i++)
        {
        $row = mysql_fetch_row($result);
        $j=0;
        foreach ($row as $value)
          {
          if ($j==0)
            {
            $vc_id=$value;
            }
          if ($j==1)
            {
            $actvcerrorbw=0;
            $actvcerrorp=0;
            $vc_state=$value;
            if ($debug) echo("<br>vc_state $vc_state");
            if ($vc_state>20)
              {
              $vcinvp++;
              }
            $vcinvptotal++;
            if ($vcinvptotal>$vp_portres)
              {
              $actvcerrorp=1;
              }
            }
          if ($j==2)  // CHECK VC BW > VP BW
            {
            if ($debug) echo("<br>------------<br>");
            $userbw_value=get_userbw($value);
            if ($debug) echo("--> userbw_id $value value $userbw_value<br>");

            if ($vc_state>20)
              {
              if ($userbw_value>$vpbw_value)
                {
                if ($userbw_value>$bwerror)
                  {
                  $bwerror=$userbw_value;
                  }
                }
              if ($debug) echo("state20<br>");
              }
            if ($userbw_value>$vpbw_value)
              {
              $actvcerrorbw=1;
              if ($userbw_value>$bwerrortotal)
                {
                $bwerrortotal=$userbw_value;
                }
              }  
            if ($debug) echo("bwerror $bwerror bwerrortotal $bwerrortotal<br>");
            if ($debug) echo("userbw_value $userbw_value vpbw_value $vpbw_value<br>");
            }
          if ($j==3)  // SUM OF BW / CR
            {
            $usercr_value=get_usercr($value);
            if ($debug) echo("--> usercr_id $value value $usercr_value<br>");
            $crtmp=$userbw_value/$usercr_value;
            if ($vc_state>20)
              {
              $crsum+=$crtmp;
              }
            $crsumtotal+=$crtmp;

            if ($crsumtotal>$vpbw_value)
              {
              $actvcerrorbw=1;
              }

            if ($debug) echo("usercr_value $usercr_value crtmp $crtmp crsum $crsum<br>");
            if ($debug) echo("usercr_value $usercr_value crtmp $crtmp crsumtotal $crsumtotal<br>");
            }

          if ($j==3)
// recalculation of all vcs within delivered/upgraded vp
            {
            if (($action=='vpdeliveredconf')&&($vc_state<22))
              {
              if ($debug) echo("recalc $vc_state");
              if (($actvcerrorbw==0) && ($actvcerrorp==0))
                {
                $vc_statenew=22;
                }
              if ($actvcerrorbw==1)
                {
                $vc_statenew=12;
                }
              if ($actvcerrorp==1)
                {
                $vc_statenew=21;
                }
              $diffstate=$vc_statenew-$vc_state;
              if ($diffstate!=0)
                {
                if ($debug) echo("diff vcstate $vc_state newstate $vc_statenew");

                $vc_statechangedate=time();
                $btuserordertype=get_btuserordertypeid($vc_id);
                if (($vc_statenew==22)&&($btuserordertype==5)) // Manual Provide
                  {
                  $vc_statenew=23;  
                  }
                MYSQL_QUERY("update dslprov_vc set vc_statechangedate='$vc_statechangedate',vc_state='$vc_statenew',vc_reqdeliverydate='$vc_reqdeliverydate' where vc_id='$vc_id'");
                add_vchistory($vc_id);
                }
              }
            }
          $j++;
          }
        }

        if ($action=='vcorder')
          {
// new user from input
          if ($debug) echo("<br>----------<br>");
          $userbw_value=get_userbw($userbw_id);

          if ($userbw_value>$vpbw_value)
            {
            if ($userbw_value>$bwerror)
              {
              $bwerror=$userbw_value;
              }
            if ($userbw_value>$bwerrortotal)
              {
              $bwerrortotal=$userbw_value;
              }
            }
          if ($debug) echo("bwerror $bwerror bwerrortotal $bwerrortotal<br>");
          if ($debug) echo("userbw_value $userbw_value vpbw_value $vpbw_value<br>");

          $usercr_value=get_usercr($usercr_id);

          $crtmp=$userbw_value/$usercr_value;
          $crsum+=$crtmp;
          $crsumtotal+=$crtmp;
          if ($debug) echo("usercr_value $usercr_value crtmp $crtmp crsum $crsum<br>");
          if ($debug) echo("usercr_value $usercr_value crtmp $crtmp crsumtotal $crsumtotal<br>");

// --- new user end
          }

$vpstatechange=0;

// Errorchecks CR&BW incl. vc_state>20

                   // CR Errorcheck

      if ($crsum>$vpbw_value)
        {
        $vc_state=12;
        if ($debug) echo("ERROR: crsum $crsum vpbw_value $vpbw_value<br>");
        $crerror=1;
        $vp_bwdemand=$crsum;
        $vca_availreasoncode="T-$vpbw_value";
        $vpstatechange=1;
        }

                   // BW Errorcheck
      if ($bwerror>$vpbw_value)
        {
        $vc_state=12;
        if ($debug) echo("ERROR: bwerror $bwerror vpbw_value $vpbw_value<br>");
        if ($vp_bwdemand<$bwerror)
          {
          $vp_bwdemand=$bwerror;
          }
        $vca_availreasoncode="T-$vpbw_value";
        $vpstatechange=1;
        }

// Errorchecks CR&BW incl. vc_state>10

      if ($crsumtotal>$vpbw_value)  // $vp_bwdemand ?
        {
        if ($debug) echo("VP demand update $crsumtotal<br>");
        $vp_bwdemand=$crsumtotal;
        $vpstatechange=1;
        }
      if ($bwerrortotal>$vpbw_value)  // $vp_bwdemand ?
        {
        if ($vp_bwdemand<$bwerrortotal)
          {
          $vp_bwdemand=$bwerrortotal;
          }
        if ($debug) echo("VP demand update $bwerrortotal<br>");
        $vpstatechange=1;
        }
      if ($debug) echo("vp_bwdemand $vp_bwdemand<br>");


// Errorchecks Ports incl. vc_state>20

      if ($action=='vcorder')
        {
        // new vc has to be added in ports
        $vcinvp++;
        $vcinvptotal++;
        }

      if ($debug) echo("vcinvp $vcinvp vcinvptotal $vcinvptotal<br>");

      if ($vcinvp>$vp_portres)
        {
        $vc_state=21;
        if ($debug==0) echo("ERROR: vcinvp $vcinvp vp_portres $vp_portres<br>");
        $porterror=1;
        $vp_portdemand=$vcinvp;
        $vca_availreasoncode="T-$vpbw_value";
        $vpstatechange=1;
        }

// Errorchecks Ports incl. vc_state>10

      if ($vcinvptotal>$vp_portres) //$vp_portdemand?
        {
        if ($debug==0) echo("VP ports update $vcinvptotal<br>");
        $vp_portdemand=$vcinvptotal;
        $vpstatechange=1;
        }

      if ($vpstatechange==1)
        {
        // statechange in history
        $vp_updemandstate=1;
        $vp_updemandstatechangedate=date("d.m.y",time());
        if ($ordermode>0) // order & vpdelivered recalc
          {
          MYSQL_QUERY("update dslprov_vp set vp_portdemand='$vp_portdemand',vp_bwdemand='$vp_bwdemand',vp_updemandstate='$vp_updemandstate',vp_updemandstatechangedate='$vp_updemandstatechangedate' where vp_id='$vp_id'");
          add_vphistory($vp_id);
          }
        }

      if ($vca_availreasoncode=='T-')
        {
        $vca_availreasoncode='T-0';
        }

// ORDER
      if (($bwerror==0)&&($porterror==0)&&($crerror==0))
        {
        $batchid='';
        $vc_btaccountcode='';
        $vc_state=22;
        if ($ordermode==1) echo("<h4>Inventory Check OK: ORDER PREPARE</h4><br>");
        $vca_availreasoncode="T-OK";
        }
      else
        {
        if ($ordermode==1) echo("<h4>Inventory Check Error: ORDER POSTPONED, CHECK EXCHANGE CAPACITY</h4><br>");        
        }

      if ($btproduct_id==0)
        {
        $btproduct_id=rulecheck(1,$userbw_id,$btprod);
        }
      else
        {
        $btprod=get_btproductshort($btproduct_id);
        }
      // unsauber, else muss den rest ausschliessen
      // nicht den VP durchkalkulieren!!!
      if (($btprod=='is')||($btprod=='ish'))
        {
        $vc_state=22;
        $vp_id=0;
        }
      }
    else
      {
      // NO VP FOUND !!!

//      if ($ordermode==1) echo("<h4>Inventory Check Error: ORDER POSTPONED, NEW EXCHANGE CONN. ORDER</h4><br>");
      $vca_availreasoncode='T-L';

      if ($btproduct_id==0)
        {
        $btproduct_id=rulecheck(0,$userbw_id,$btprod);
        }
      else
        {
        $btprod=get_btproductshort($btproduct_id);
        }
      if (($btprod=='is')||($btprod=='ish'))
        {
        if ($ordermode==1) echo("<h4>ORDER PREPARE</h4><br>");
        $vca_availreasoncode='IPS';
        $vc_state=22;
        $vp_id=0;
        }
      else
        {
        if ($ordermode==1) echo("<h4>Inventory Check Error: ORDER POSTPONED, NEW EXCHANGE CONN. ORDER</h4><br>");
        $vca_availreasoncode='T-L';


        // 1. Postcode Distance Check zu Pops, Pop waehlen
        // 2. alle CAL BW des POP kalkulieren, niedrigste auswaehlen,
        //      a) wenn alle ueber 80% --> VP FEnd Message, dass CAL bestellt wd.
        //      b) wenn niedrigste <80% --> VP Fend order Vorschlag mit VC BW
        //$cal_id=1;

	require ("distancecheck.php");

        $vc_state=21;
        $vp_id=(time()*100)+$vca_offset;
        $vp_bwdemand=get_userbw($userbw_id);      
        $vpbw_id=0;
//        $vpbw_id=get_vpbwid_from_userbwid($userbw_id);
        $vp_portres=0;
        $vptype_id=2; 
        $vp_state=11;
        $vp_statechangedate=date("d.m.y",time());
        $vp_updemandstate=1;
        $vp_updemandstatechangedate=date("d.m.y",time());
        if ($ordermode==1)
          {
          $enterdate=time();
          MYSQL_QUERY("INSERT INTO dslprov_vp VALUES ('$vp_id','$enterdate','$cal_id','$vca_exchangecode','0','1','0','','$vp_portres','0','','1','0','$vpbw_id','0','','$vp_bwdemand','0','$vptype_id','','','','','','','$vp_state','$vp_statechangedate','0','','$vp_updemandstate','$vp_updemandstatechangedate','0','','1')");
          add_vphistory($vp_id);
          }
        }

      }
    if ($ordermode==1)
      {
      $enterdate=time();
//      echo("$enterdate");
      if (($vc_state==22)&&($btuserordertype_id==5)) // Manual Provide
        {
        $vc_state=23;  
        }
      MYSQL_QUERY("INSERT INTO dslprov_vc VALUES ('$vca_id','$enterdate','$vp_id','0','$vc_batch_bt','$vc_batch_visp','','$vc_btaccountcode','$vc_refnum','$vc_visprefnum','$btuserordertype_id','0','$vca_availreasoncode','$btproduct_id','$vispproduct_id','$vc_title','$vc_surname','$vc_firstname','$vc_initials','$vc_premisesname','$vc_houseno','$vc_street','$vc_city','$vca_postcode','$vca_cli','$vca_exchangecode','$vc_contactphone','$vc_orderdate','$vc_reqdeliverydate','0','0','0','0','$vc_notes','$vc_resellernotes','$userbw_id','$usercr_id','$userrealm_id','$visp_id','$domain1_id','$domain2_id','$domain3_id','$vc_carelevel','$vc_confirmations','ip','$vca_user','$vc_state','$enterdate','0','0','0','$vc_migkey')");
      add_vchistory($vca_id);
      }
    }


// --> BTOK ENDE
  }
  if ($debug) echo ("$vca_availreasoncode<br>"); 
?>
