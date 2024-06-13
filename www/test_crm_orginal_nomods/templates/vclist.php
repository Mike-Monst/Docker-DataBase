<?

$bgcolor='ffeebb';

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
//  22: ordered
//  23: committed (commitdate BT)
//  24: installed (installdate BT)
//  25: vci issued (prod BT)
//  26: productive (configured)

//  31: precease


  $query="select vc_surname,vc_postcode,vc_cli,vc_street,vc_city,vc_cbuk,btproduct_id,userbw_id,usercr_id,vc_orderdate,vc_reqdeliverydate,vc_productiondate,vc_state,vc_vci,vp_id,vcfault_id,vc_id from dslprov_vc where vc_state>9 and vc_state <22";
  if ($action=='searchvc')
    {
    $repstring='';
    $sterror=0;
    if ($vc_batch_visp!='')
      {
      $st1="vc_batch_visp like '$vc_batch_visp'";
      }
    else
      {
      $st1=1;
      $sterror++;
      }
    if ($vc_visprefnum!='')
      {
      $st2="vc_visprefnum like '$vc_visprefnum'";
      }
    else
      {
      $st2=1;
      $sterror++;
      }
    if ($vc_surname!='')
      {
      $st3="vc_surname like '%$vc_surname%'";
      }
    else
      {
      $st3=1;
      $sterror++;
      }
    if ($vc_firstname!='')
      {
      $st4="vc_firstname like '%$vc_firstname%'";
      }
    else
      {
      $st4=1;
      $sterror++;
      }
    if ($vc_street!='')
      {
      $st5="vc_street like '%$vc_street%'";
      }
    else
      {
      $st5=1;
      $sterror++;
      }
    if ($vc_city!='')
      {
      $st6="vc_city like '%$vc_city%'";
      }
    else
      {
      $st6=1;
      $sterror++;
      }
    if ($vc_postcode!='')
      {
      $st7="vc_postcode like '$vc_postcode%'";
      }
    else
      {
      $st7=1;
      $sterror++;
      }
    if ($vc_cli!='')
      {
      $st8="vc_cli like '$vc_cli%'";
      }
    else
      {
      $st8=1;
      $sterror++;
      }
    if (($vc_orderdate!='')||(($orderdatefrom!='')&&($orderdateto!='')))
      {
      if ($vc_orderdate=='')
        {
        $vc_orderdatefrom=$sertimenull-(86400*$orderdatefrom);
        $vc_orderdateto=86400+$sertimenull-(86400*$orderdateto);
        $vc_orderdatefromiso=get_isodate($vc_orderdatefrom);
        $vc_orderdatetoiso=get_isodate($vc_orderdateto);
        $repstring=$repstring."Orderdate $vc_orderdatefromiso - $vc_orderdatetoiso";
        }
      else
        {
        $vc_orderdatefrom=get_sertime($vc_orderdate);
        $vc_orderdateto=$vc_orderdatefrom+86400;
        }
      $st9="(vc_orderdate >= '$vc_orderdatefrom' and vc_orderdate < '$vc_orderdateto')";
      }
    else
      {
      $st9=1;
      $sterror++;
      }
    if (($vc_reqdeliverydate!='')||(($reqdeliverydatefrom!='')&&($reqdeliverydateto!='')))
      {
      if ($vc_reqdeliverydate=='')
        {
        $vc_reqdeliverydatefrom=$sertimenull-(86400*$reqdeliverydatefrom);
        $vc_reqdeliverydateto=86400+$sertimenull-(86400*$reqdeliverydateto);
        $vc_reqdeliveryfromiso=get_isodate($vc_reqdeliveryfrom);
        $vc_reqdeliverytoiso=get_isodate($vc_reqdeliveryto);
        $repstring=$repstring."RDDate $vc_reqdeliveryfromiso - $vc_reqdeliverytoiso";
        }
      else
        {
        $vc_reqdeliverydatefrom=get_sertime($vc_reqdeliverydate);
        $vc_reqdeliverydateto=$vc_reqdeliverydatefrom+86400;
        }
//$st1=get_isodate($vc_reqdeliverydatefrom);
//$st2=get_isodate($vc_reqdeliverydateto);
//echo("$st1 $st2");
      $st10="(vc_reqdeliverydate >= '$vc_reqdeliverydatefrom' and vc_reqdeliverydate < '$vc_reqdeliverydateto')";
      }
    else
      {
      $st10=1;
      $sterror++;
      }
    if (($vc_commitdate!='')||(($commitdatefrom!='')&&($commitdateto!='')))
      {
      if ($vc_commitdate=='')
        {
        $vc_commitdatefrom=$sertimenull-(86400*$commitdatefrom);
        $vc_commitdateto=86400+$sertimenull-(86400*$commitdateto);
        $vc_commitdatefromiso=get_isodate($vc_commitdatefrom);
        $vc_commitdatetoiso=get_isodate($vc_commitdateto);
        $repstring=$repstring."Commitdate $vc_commitdatefromiso - $vc_commitdatetoiso";
        }
      else
        {
        $vc_commitdatefrom=get_sertime($vc_commitdate);
        $vc_commitdateto=$vc_commitdatefrom+86400;
        }
      $st11="(vc_commitdate >= '$vc_commitdatefrom' and vc_commitdate < '$vc_commitdateto')";
      }
    else
      {
      $st11=1;
      $sterror++;
      }
    if (($vc_installationdate!='')||(($installationdatefrom!='')&&($installationdateto!='')))
      {
      if ($vc_installationdate=='')
        {
        $vc_installationdatefrom=$sertimenull-(86400*$installationdatefrom);
        $vc_installationdateto=86400+$sertimenull-(86400*$installationdateto);
        $vc_installationdatefromiso=get_isodate($vc_installationdatefrom);
        $vc_installationdatetoiso=get_isodate($vc_installationdateto);
        $repstring=$repstring."Installationdate $vc_installationdatefromiso - $vc_installationdatetoiso";
        }
      else
        {
        $vc_installationdatefrom=get_sertime($vc_installationdate);
        $vc_installationdateto=$vc_installationdatefrom+86400;
        }
      $st12="(vc_installationdate >= '$vc_installationdatefrom' and vc_installationdate < '$vc_installationdateto')";
      }
    else
      {
      $st12=1;
      $sterror++;
      }
    if (($vc_productiondate!='')||(($productiondatefrom!='')&&($productiondateto!='')))
      {
      if ($vc_productiondate=='')
        {
        $vc_productiondatefrom=$sertimenull-(86400*$productiondatefrom);
        $vc_productiondateto=86400+$sertimenull-(86400*$productiondateto);
        $vc_productiondatefromiso=get_isodate($vc_productiondatefrom);
        $vc_productiondatetoiso=get_isodate($vc_productiondateto);
        $repstring=$repstring."Productiondate $vc_productiondatefromiso - $vc_productiondatetoiso";
        }
      else
        {
        $vc_productiondatefrom=get_sertime($vc_productiondate);
        $vc_productiondateto=$vc_productiondatefrom+86400;
        }
      $st13="(vc_productiondate >= '$vc_productiondatefrom' and vc_productiondate < '$vc_productiondateto')";
      }
    else
      {
      $st13=1;
      $sterror++;
      }
    if (($vc_canceldate!='')||(($canceldatefrom!='')&&($canceldateto!='')))
      {
      if ($vc_canceldate=='')
        {
        $vc_canceldatefrom=$sertimenull-(86400*$canceldatefrom);
        $vc_canceldateto=86400+$sertimenull-(86400*$canceldateto);
        $vc_canceldatefromiso=get_isodate($vc_canceldatefrom);
        $vc_canceldatetoiso=get_isodate($vc_canceldateto);
        $repstring=$repstring."Canceldate $vc_canceldatefromiso - $vc_canceldatetoiso";
        }
      else
        {
        $vc_canceldatefrom=get_sertime($vc_canceldate);
        $vc_canceldateto=$vc_canceldatefrom+86400;
        }
      $st14="(vc_canceldate >= '$vc_canceldatefrom' and vc_canceldate < '$vc_canceldateto')";
      }
    else
      {
      $st14=1;
      $sterror++;
      }
    if ($vc_state!='0')
      {
      $st15="vc_state like '$vc_state'";      
      $repstring=$repstring."State ";
      }
    else
      {
      $st15=1;
      $sterror++;
      }
    if ($btproduct_id!='0')
      {
      $st16="btproduct_id like '$btproduct_id'";
      }
    else
      {
      $st16=1;
      $sterror++;
      }
    if ($userbw_id!='0')
      {
      $st17="userbw_id like '$userbw_id'";
      }
    else
      {
      $st17=1;
      $sterror++;
      }
    if ($usercr_id!='0')
      {
      $st18="usercr_id like '$usercr_id'";
      }
    else
      {
      $st18=1;
      $sterror++;
      }
// aenderung fuer Login realm
    if ($userrealm_id!='0')
      {
      $st19="userrealm_id like '$userrealm_id'";
      }
    else
      {
      $st19=1;
      $sterror++;
      }
    if ($vc_cbuk!='')
      {
      $st20="vc_cbuk like '%$vc_cbuk%'";
      }
    else
      {
      $st20=1;
      $sterror++;
      }

    if ($sterror==20) { $st8='0000000000'; }
    $query="select vc_surname,vc_postcode,vc_cli,vc_street,vc_city,vc_cbuk,btproduct_id,userbw_id,usercr_id,vc_orderdate,vc_reqdeliverydate,vc_productiondate,vc_state,vc_vci,vp_id,vcfault_id,vc_id from dslprov_vc where $st1 and $st2 and $st3 and $st4 and $st5 and $st6 and $st7 and $st8 and $st9 and $st10 and $st11 and $st12 and $st13 and $st14 and $st15 and $st16 and $st17 and $st18 and $st19 and $st20";

// echo("$query");

    }



  else if ($action=='searchvc_vp') 
    {
    $vpdsuk=get_vpdsuk($vp_id);
    echo("<h3>Customers on VP $vpdsuk ; ID= $vp_id</h3>");
    $query="select t1.vc_surname,t1.vc_postcode,t1.vc_cli,t1.vc_street,t1.vc_city,t1.vc_cbuk,t1.btproduct_id,t1.userbw_id,t1.usercr_id,t1.vc_orderdate,t1.vc_reqdeliverydate,t1.vc_productiondate,t1.vc_state,t1.vc_vci,t1.vp_id,t1.vcfault_id,t1.vc_id from dslprov_vc as t1 left join dslprov_vp as t2 on t1.vp_id = t2.vp_id where t2.vp_id LIKE '$vp_id'";
    }

  else if ($action=='searchvc_ex') 
    {
    echo("<h3>Customers on exchange $exchange_id</h3>");
    $query="select t1.vc_surname,t1.vc_postcode,t1.vc_cli,t1.vc_street,t1.vc_city,t1.vc_cbuk,t1.btproduct_id,t1.userbw_id,t1.usercr_id,t1.vc_orderdate,t1.vc_reqdeliverydate,t1.vc_productiondate,t1.vc_state,t1.vc_vci,t1.vp_id,t1.vcfault_id,t1.vc_id from dslprov_vc as t1 left join dslprov_vp as t2 on t1.vp_id = t2.vp_id where t2.exchange_id LIKE '$exchange_id'";
    }

  else if ($action=='searchvc_cal') 
    {
    $calname=get_calname($cal_id);
    echo("<h3>Customers on CAL $calname</h3>");
    $query="select t1.vc_surname,t1.vc_postcode,t1.vc_cli,t1.vc_street,t1.vc_city,t1.vc_cbuk,t1.btproduct_id,t1.userbw_id,t1.usercr_id,,t1.vc_orderdate,t1.vc_reqdeliverydate,t1.vc_productiondate,t1.vc_state,t1.vc_vci,t1.vp_id,t1.vcfault_id,t1.vc_id from dslprov_vc as t1 left join dslprov_vp as t2 on t1.vp_id = t2.vp_id where t2.cal_id LIKE '$cal_id'";
    }
// reporting fake
  else if ($action=='last3')
    {
    $time=time();
    $query="select vc_surname,vc_postcode,vc_cli,vc_street,vc_city,vc_cbuk,btproduct_id,userbw_id,usercr_id,vc_orderdate,vc_reqdeliverydate,vc_productiondate,vc_state,vc_vci,vp_id,vcfault_id,vc_id from dslprov_vc where vc_state>21";
    }

  else if ($action=='ordertracking')
    {
    $query="select vc_surname,vc_postcode,vc_cli,vc_street,vc_city,vc_cbuk,btproduct_id,userbw_id,usercr_id,vc_orderdate,vc_reqdeliverydate,vc_productiondate,vc_state,vc_vci,vp_id,vcfault_id,vc_id from dslprov_vc where (vc_state>21 and vc_state<26) or vc_state>30";
    }

  else if ($action=='exceptions')
    {
    $query="select vc_surname,vc_postcode,vc_cli,vc_street,vc_city,vc_cbuk,btproduct_id,userbw_id,usercr_id,vc_orderdate,vc_reqdeliverydate,vc_productiondate,vc_state,vc_vci,vp_id,vcfault_id,vc_id from dslprov_vc where vc_state<9";
    }

  $cresult=mysql_query($query);
  $number=mysql_num_rows($cresult);
  
  if ($limit=='') { $limit=0; }
  $limitstm=" LIMIT $limit,$limitinterval";
  $query=$query.$limitstm;
  $result=mysql_query($query);  


  echo("<center>");
  $cnt=1;
  $uri=eregi_replace('limit','limitold',$uri);
  echo("page ");
  for ($z=0;$z<$number;$z=$z+$limitinterval)
    {
    $puri=$uri."&limit=$z";
    echo("<a href=$puri>$cnt</a> ");
    $cnt++;
    }

echo("<table border=0><tr bgcolor=$tcolor0>");
// VISP , Realm

  echo("<td align=center nowrap><b>No.</b></td>");
  echo("<td align=center nowrap><b>Surname</b></td>");
  echo("<td align=center nowrap><b>Postcode</b></td>");
  echo("<td align=center nowrap><b>CLI</b></td>");
  echo("<td align=center nowrap><b>Street</b></td>");
  echo("<td align=center nowrap><b>City</b></td>");
  echo("<td align=center nowrap><b>CBUK</b></td>");
  echo("<td align=center nowrap><b>BT Product</b></td>");
  echo("<td align=center nowrap><b>R Product</b></td>"); 
  echo("<td align=center nowrap><b>OrderDate</b></td>");
  echo("<td align=center nowrap><b>ReqDelDate</b></td>");
  echo("<td align=center nowrap><b>ProdDate</b></td>");
  echo("<td align=center nowrap><b>State</b></td>");
  echo("<td align=center nowrap><b>VCI</b></td>");
  echo("<td align=center nowrap><b>VPI</b></td>");
  echo("<td align=center nowrap><b>DSUK</b></td>");
  echo("<td align=center nowrap><b>Exchange</b></td>");
  echo("<td align=center nowrap><b>CAL</b></td>");
  echo("<td align=center nowrap><b>VP State</b></td>");
  echo("<td align=center nowrap><b>Fault</b></td>");
  echo("<td align=center nowrap><b>EditVC</b></td>");
  echo("<!-- <td align=center nowrap><b>ShowVC</b></td>  -->");

  for ($i=0;$i < mysql_num_rows($result);$i++)
    {
    $row = mysql_fetch_row($result);
    $j=0;
    echo("</tr><tr bgcolor=$bgcolor>");
    foreach ($row as $value)
      {
      if ($j==0)
        {
        $k=$i+1+$limit;
        echo("<td align=center><b>$k</b></td>");
        echo("<td align=center>$value</td>");
        }
      else if ($j==2)
        {
        echo("<td align=center><a href=index.php?page=1&action=vchistory&vc_cli=$value>$value</a></td>");
        }
      else if ($j==6)
        {
        $tvalue=get_btproduct($value);
        echo("<td align=center>$tvalue</td>");
        }
      else if ($j==7)
        {
        $tvalue=get_userbw($value);
        }
      else if ($j==8)
        {
        $t1value=get_usercr($value);
        $value="$tvalue 1:$t1value";
        echo("<td align=center>DSL $value</td>");
        }
      else if (($j==9)||($j==10)||($j==11))
        {
        $tvalue=get_isodate($value);
        if ($value==0) { $tvalue='none'; }
        echo("<td align=center>$tvalue</td>");
        }
      else if ($j==12)
        {
        $tvalue=get_vcstate($value);
        $value="$tvalue($value)";
        echo("<td align=center>$value</td>");
        }
      else if ($j==14)
        {
        $query2="select * from dslprov_vp where vp_id LIKE '$value'";
        $result2=mysql_query($query2);
        $number2=mysql_num_rows($result2);
        $rowarray=mysql_fetch_array($result2);

        $vp_state=$rowarray['vp_state'];
        $vp_state_value=get_vpstate($vp_state);
        $cal_id=$rowarray['cal_id'];
        $cal=get_calname($cal_id);
        if ($cal=='-1') { $cal='none'; }
        $exchange_id=$rowarray['exchange_id'];
        $vp_dsuk=$rowarray['vp_dsuk'];
        $vp_vpi=$rowarray['vp_vpi'];
        echo("<td align=center>$vp_vpi</td>");
        echo("<td align=center><a href=index.php?page=7&action=vpshow&vp=$value>$vp_dsuk</a></td>");
        echo("<td align=center><a href=index.php?page=1&action=searchvp_ex&query=$exchange_id>$exchange_id</a></td>");
        echo("<td align=center><a href=index.php?page=1&action=searchvp_cal&query=$cal_id>$cal</td>");
        echo("<td align=center>$vp_state_value($vp_state)</td>");
        }
      else if ($j==15)
        {
        $tvalue=get_vcfault($value);
        echo("<td align=center>$tvalue</td>");
        }
      else if ($j==16)
        {
        echo("<td align=center><b><a href=index.php?page=3&action=vcupgrade&vc_id=$value>>Edit</a></b></td>");         
        echo("<!-- <td align=center><b><a href=index.php?page=3&action=vcshow&vc_id=$value>>Show</a></b></td> -->");         
        }
      else
        {
        echo("<td align=center>$value</td>");
        }
      $j++;
      }
    }
  echo("</tr></table>");
  $cnt=1;
  $uri=eregi_replace('limit','limitold',$uri);
  echo("page ");
  for ($z=0;$z<$number;$z=$z+$limitinterval)
    {
    $puri=$uri."&limit=$z";
    echo("<a href=$puri>$cnt</a> ");
    $cnt++;
    }
  echo("</center>");
     
?>
