<?

// dates checken

      $ordererror=0;

if ($checkmode=='vc')
  {
      $ordererror+=checktext($vc_surname,"Surname",1);
      $ordererror+=checktext($vc_street,"Street",1);
      $ordererror+=checktext($vc_city,"City",1);
      $ordererror+=checktext($vc_postcode,"Postcode",3);
      $ordererror+=checktext($vc_reqdeliverydate,"Requested Delivery Date",7);
      $ordererror+=checktext($vc_title,"Title",2);
      $ordererror+=checktext($vc_premisesname,"Premises Name",2);
      $ordererror+=checktext($vc_firstname,"First Name",2);
      $ordererror+=checktext($vc_houseno,"House Number",2);
//      $ordererror+=checktext($vc_notes,"Notes",2);
      $ordererror+=checktext($vc_cli,"CLI",4);
      $ordererror+=checktext($vc_contactphone,"Contact Phone",5);
      $ordererror+=checktext($userbw_id,"User Bandwidth",6);
      $ordererror+=checktext($usercr_id,"Contention Ratio",6);
      $ordererror+=checktext($userrealm_id,"Realm",6);
//      $ordererror+=checktext($vc_carelevel,"Care Level",6);
//      $ordererror+=checktext($btuserordertype_id,"Ordertype",6);
  if ($ordererror==0)
    {
    $vc_reqdeliverydate=get_sertime($vc_reqdeliverydate);
    } 
  }  

if ($checkmode=='vp')
  {
  if ($action=='vpupgradeconf')
    {
      $ordererror+=checktext($vp_portres,"Port Reservation",6);
      $ordererror+=checktext($vpbw_id,"Bandwidth",6);
//      $ordererror+=checktext($vptype_id,"Type",6);
    }
  if ($action=='vpdeliveredconf')
    {
      $ordererror+=checktext($vp_vpi,"VPI",6);
      $ordererror+=checktext($vp_dsuk,"VP DSUK",1);
      $ordererror+=checktext($vp_productiondate,"Production Date",7);      
    }
  if ($ordererror==0)
    {
    $vp_productiondate=get_sertime($vp_productiondate);
    }
  else
    {
    $vp_productiondate='';
    }
  }
if ($debug) echo("ordererror: $ordererror<br>");


function checktext($text,$descr,$mode)
  {
  $error=0;
  if ($mode==1)
    {
    if(eregi("^[_0-9a-zA-z‰ˆ¸ƒ÷‹ﬂ.\ ]{2,32}$",$text)==0)
      {
      $error=1;
      echo("<font color=red>no entry or wrong characters in field
<b>$descr</b></font><br>");
      }
    }
  if ($mode==2)
    {
    if(eregi("^[_0-9a-zA-z‰ˆ¸ƒ÷‹ﬂ.\ ]{0,32}$",$text)==0)
      {
      $error=1;
      echo("<font color=red>no entry or wrong characters in field
<b>$descr</b></font><br>");
      }
    }
  if ($mode==3)
    {
    if(eregi("^[_0-9a-zA-z‰ˆ¸ƒ÷‹ﬂ.\ ]{2,8}$",$text)==0)
      {
      $error=1;
      echo("<font color=red>no entry or wrong characters in field
<b>$descr</b></font><br>");
      }
    }
  if ($mode==4)
    {
    if(eregi("^[0-9]{10,11}$",$text)==0)
      {
      $error=1;
      echo("<font color=red>no entry or wrong characters in field
<b>$descr</b></font><br>");
      }
    }
  if ($mode==5)
    {
    if(eregi("^[0-9]{0,11}$",$text)==0)
      {
      $error=1;
      echo("<font color=red>no entry or wrong characters in field
<b>$descr</b></font><br>");
      }
    }
  if ($mode==6)
    {
    if(eregi("^[0-9]{1,5}$",$text)==0)
      {
      $error=1;
      echo("<font color=red>no entry or wrong characters in field
<b>$descr</b></font><br>");
      }
    }
  if ($mode==7)
    {
    if(strlen($text)!=10)
      {
      $error=1;
      echo("<font color=red>no entry or wrong characters in field
<b>$descr</b></font><br>");
      }
    else
      {
      $stime=get_sertime($text);
      if ($stime==-1)
        {
        $error=1;
        echo("<font color=red>wrong entry in <b>$descr</b></font><br>");
        }
      }
    }

  return($error);
  }


?>
