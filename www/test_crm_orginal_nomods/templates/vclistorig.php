<?

// vcstate:
// <=10 : not to be used in calc
//
//  1 : pending_bterror
//  2 : cancelled
//  3 : rejected
//  4 : ceased

// >10 : to be used in cli double
//
//  11: new
//  12: pending (bw,crsum BW upgrade)
//  13: reserved

// >20 : to be used in calc
//
//  21: pending (ports Port upgrade)
//  22: ordered
//  23: committed (commitdate BT)
//  24: installed (installdate BT)
//  25: vci issued (prod BT)
//  26: productive (configured)

  echo("<center><table border=0><tr>");
// VISP , Realm
  echo("<td bgcolor=#faa000 align=center nowrap><span class=table0><b>Surname</b></span></td>");
  echo("<td bgcolor=#faa000 align=center nowrap><span class=table0><b>Postcode</b></span></td>");
  echo("<td bgcolor=#faa000 align=center nowrap><span class=table0><b>CLI</b></span></td>");
  echo("<td bgcolor=#faa000 align=center nowrap><span class=table0><b>Street</b></span></td>");
  echo("<td bgcolor=#faa000 align=center nowrap><span class=table0><b>City</b></span></td>");
  echo("<td bgcolor=#faa000 align=center nowrap><span class=table0><b>CBUK</b></span></td>");
  echo("<td bgcolor=#faa000 align=center nowrap><span class=table0><b>BW</b></span></td>");
  echo("<td bgcolor=#faa000 align=center nowrap><span class=table0><b>CR</b></span></td>");
  echo("<td bgcolor=#faa000 align=center nowrap><span class=table0><b>Req. Delivery Date</b></span></td>");
  echo("<td bgcolor=#faa000 align=center nowrap><span class=table0><b>State</b></span></td>");
  echo("<td bgcolor=#faa000 align=center nowrap><span class=table0><b>VCI</b></span></td>");
  echo("<td bgcolor=#faa000 align=center nowrap><span class=table0><b>VPI</b></span></td>");
  echo("<td bgcolor=#faa000 align=center nowrap><span class=table0><b>DSUK</b></span></td>");
  echo("<td bgcolor=#faa000 align=center nowrap><span class=table0><b>Exchange</b></span></td>");
  echo("<td bgcolor=#faa000 align=center nowrap><span class=table0><b>CAL</b></span></td>");
  echo("<td bgcolor=#faa000 align=center nowrap><span class=table0><b>VP State</b></span></td>");
  echo("<td bgcolor=#faa000 align=center nowrap><span class=table0><b>EditVC</b></span></td>");
  echo("<td bgcolor=#faa000 align=center nowrap><span class=table0><b>ShowVC</b></span></td>");

  $query="select vc_surname,vc_postcode,vc_cli,vc_street,vc_city,vc_cbuk,userbw_id,usercr_id,vc_reqdeliverydate,vc_state,vc_vci,vp_id,vc_id from dslprov_vc where vc_state <22";

  if ($action=='searchvc')
    {
    $sterror=0;
    if ($vc_surname!='')
      {
      $st1="vc_surname like '%$vc_surname%'";
      }
    else
      {
      $st1=1;
      $sterror++;
      }
    if ($vc_postcode!='')
      {
      $st2="vc_postcode like '$vc_postcode%'";
      }
    else
      {
      $st2=1;
      $sterror++;
      }
    if ($vc_cli!='')
      {
      $st3="vc_cli like '$vc_cli%'";
      }
    else
      {
      $st3=1;
      $sterror++;
      }
    if ($vc_reqdeliverydate!='')
      {
      $st4="vc_reqdeliverydate like '$vc_reqdeliverydate'";
      }
    else
      {
      $st4=1;
      $sterror++;
      }
    if ($vc_installationdate!='')
      {
      $st5="vc_installationdate like '$vc_installationdate'";
      }
    else
      {
      $st5=1;
      $sterror++;
      }
    if ($vc_productiondate!='')
      {
      $st6="vc_productiondate like '$vc_productiondate'";
      }
    else
      {
      $st6=1;
      $sterror++;
      }
    if ($vc_orderdate!='')
      {
      $st7="vc_orderdate like '$vc_orderdate'";
      }
    else
      {
      $st7=1;
      $sterror++;
      }
    if ($vc_state!='0')
      {
      $st8="vc_state like '$vc_state'";
      }
    else
      {
      $st8=1;
      $sterror++;
      }
    if ($sterror==8) { $st2='0000000000'; }
    $query="select vc_surname,vc_postcode,vc_cli,vc_street,vc_city,vc_cbuk,userbw_id,usercr_id,vc_reqdeliverydate,vc_state,vc_vci,vp_id,vc_id from dslprov_vc where $st1 and $st2 and $st3 and $st4 and $st5 and $st6 and $st7 and $st8";

echo("$query");

    }

  else if ($action=='searchvc_ex') 
    {
    echo("<h3>Customers on exchange $exchange_id</h3>");
//    $query="select t1.vc_surname,t1.vc_postcode,t1.vc_cli,t1.vc_street,t1.vc_city,t1.vc_cbuk,t1.userbw_id,t1.vc_reqdeliverydate,t1.vc_state,t1.vc_vci,t1.vp_id,t1.vc_id from dslprov_vc as t1, dslprov_vp as t2 where t2.exchange_id LIKE '$exchange_id' and t1.vp_id = t2.vp_id";
    // ????
    $query="select t1.vc_surname,t1.vc_postcode,t1.vc_cli,t1.vc_street,t1.vc_city,t1.vc_cbuk,t1.userbw_id,t1.usercr_id,t1.vc_reqdeliverydate,t1.vc_state,t1.vc_vci,t1.vp_id,t1.vc_id from dslprov_vc as t1 left join dslprov_vp as t2 on t1.vp_id = t2.vp_id where t2.exchange_id LIKE '$exchange_id'";
    }

  else if ($action=='searchvc_cal') 
    {
    echo("<h3>Customers on CAL $cal_id</h3>");
    // ????
    $query="select t1.vc_surname,t1.vc_postcode,t1.vc_cli,t1.vc_street,t1.vc_city,t1.vc_cbuk,t1.userbw_id,t1.usercr_id,t1.vc_reqdeliverydate,t1.vc_state,t1.vc_vci,t1.vp_id,t1.vc_id from dslprov_vc as t1 left join dslprov_vp as t2 on t1.vp_id = t2.vp_id where t2.cal_id LIKE '$cal_id'";
    }
  else if ($action=='last3') 
    {
    $time=time();
    $query="select vc_surname,vc_postcode,vc_cli,vc_street,vc_city,vc_cbuk,userbw_id,usercr_id,vc_reqdeliverydate,vc_state,vc_vci,vp_id,vc_id from dslprov_vc where vc_state>21";
    }

  $result=mysql_query($query);

  for ($i=0;$i < mysql_num_rows($result);$i++)
    {
    $row = mysql_fetch_row($result);
    $j=0;
    echo("</tr><tr>");
    foreach ($row as $value)
      {
      if ($j==6)
        {
        $tvalue=get_userbw($value);
        $value="$tvalue";
        }
      if ($j==7)
        {
        $tvalue=get_usercr($value);
        $value="1:$tvalue";
        }
      if ($j==9)
        {
        $tvalue=get_vcstate($value);
        $value="$tvalue($value)";
        }
      if ($j==11)
        {
        $query2="select * from dslprov_vp where vp_id LIKE '$value'";
        $result2=mysql_query($query2);
        $number2=mysql_num_rows($result2);
        $rowarray=mysql_fetch_array($result2);

        $vp_state=$rowarray['vp_state'];
        $vp_state_value=get_vpstate($vp_state);
        $cal_id=$rowarray['cal_id'];
        $exchange_id=$rowarray['exchange_id'];
        $vp_dsuk=$rowarray['vp_dsuk'];
        $vp_vpi=$rowarray['vp_vpi'];
        echo("<td bgcolor=#ffeebb align=center>$vp_vpi</td>");
        echo("<td bgcolor=#ffeebb align=center>$vp_dsuk</td>");
        echo("<td bgcolor=#ffeebb align=center><a href=index.php?page=1&action=searchvp_ex&query=$exchange_id>$exchange_id</a></td>");
        echo("<td bgcolor=#ffeebb align=center><a href=index.php?page=1&action=searchvp_cal&query=$cal_id>$cal_id</td>");
        echo("<td bgcolor=#ffeebb align=center>$vp_state_value($vp_state)</td>");
        }
      else if ($j==12)
        {
        echo("<td bgcolor=#ffeebb align=center><b><a href=index.php?page=3&action=vcupgrade&vc_id=$value>>Edit</a></b></td>");         
        echo("<td bgcolor=#ffeebb align=center><b><a href=index.php?page=3&action=vcshow&vc_id=$value>>Show</a></b></td>");         
        }
      else
        {
        echo("<td bgcolor=#ffeebb align=center>$value</td>");
        }
      $j++;
      }
    }
  echo("</tr></table></center>");
     
?>