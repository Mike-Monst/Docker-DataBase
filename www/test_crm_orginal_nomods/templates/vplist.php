<?

$formquery=$query;

$bgcolor='#ffeebb';

// vpstate:
// <=10 : not to be used in calc
//
//  1 : pending_bterror
//  2 : cancelled
//  3 : rejected
//  4 : ceased

// >10 : 
//
//  11: new

// >20 :
//
//  25: prod BT. VPI issued
//  26: productive (configured)
//  31: cease prepare

  if ($sort=='') {$sort=1;} 
  $orderstm="$sort ASC";

  if ($action=='listvpupdemand')
    {
    $action='vpupgrade';
    $query="select vp_id,vp_state,cal_id,exchange_id,vp_dsuk,vp_vpi,vp_portres,vp_portordered,vp_portdemand,vpbw_id,vpbwordered_id,vp_bwdemand,vptype_id,vp_productiondate from dslprov_vp where vp_state >10 AND vp_updemandstate>0 AND vp_orderedstate<1 order by $orderstm";
    }
  else if ($action=='listvpordered')
    {
    $action='vpdelivered';
    $query="select vp_id,vp_state,cal_id,exchange_id,vp_dsuk,vp_vpi,vp_portres,vp_portordered,vp_portdemand,vpbw_id,vpbwordered_id,vp_bwdemand,vptype_id,vp_productiondate from dslprov_vp where vp_state >10 AND vp_orderedstate>0 order by $orderstm";
    }
  else if ($action=='searchvp_cal')
    {
    $query="select vp_id,vp_state,cal_id,exchange_id,vp_dsuk,vp_vpi,vp_portres,vp_portordered,vp_portdemand,vpbw_id,vpbwordered_id,vp_bwdemand,vptype_id,vp_productiondate from dslprov_vp where cal_id LIKE '$query' order by $orderstm";
    }
  else if ($action=='searchvp_vpi')
    {
    $query="select vp_id,vp_state,cal_id,exchange_id,vp_dsuk,vp_vpi,vp_portres,vp_portordered,vp_portdemand,vpbw_id,vpbwordered_id,vp_bwdemand,vptype_id,vp_productiondate from dslprov_vp where vp_vpi LIKE '$query' order by $orderstm";
    }
  else if ($action=='searchvp_ex')
    {
    $query="select vp_id,vp_state,cal_id,exchange_id,vp_dsuk,vp_vpi,vp_portres,vp_portordered,vp_portdemand,vpbw_id,vpbwordered_id,vp_bwdemand,vptype_id,vp_productiondate from dslprov_vp where exchange_id LIKE '$query' order by $orderstm";
    }
  else if ($action=='searchvp_dsuk')
    {
    $query="select vp_id,vp_state,cal_id,exchange_id,vp_dsuk,vp_vpi,vp_portres,vp_portordered,vp_portdemand,vpbw_id,vpbwordered_id,vp_bwdemand,vptype_id,vp_productiondate from dslprov_vp where vp_dsuk LIKE '%$query%' order by $orderstm";
    }
  else if ($action=='searchvp_state')
    {
    if ($query!=0)
      {
      $stm="vp_state LIKE '$query'";
      }
    else
      {
      $stm=1;
      }
    $query="select vp_id,vp_state,cal_id,exchange_id,vp_dsuk,vp_vpi,vp_portres,vp_portordered,vp_portdemand,vpbw_id,vpbwordered_id,vp_bwdemand,vptype_id,vp_productiondate from dslprov_vp where $stm order by $orderstm";
    }
  else if ($action=='searchvp_bwperc')
    {
    $query=$query/100;
    $query="select vp_id,vp_state,cal_id,exchange_id,vp_dsuk,vp_vpi,vp_portres,vp_portordered,vp_portdemand,vpbw_id,vpbwordered_id,vp_bwdemand,vptype_id,vp_productiondate from dslprov_vp where vp_bwperc > '$query' order by $orderstm";
    }
  else if ($action=='searchvp_portsperc')
    {
    $query=$query/100;
    $query="select vp_id,vp_state,cal_id,exchange_id,vp_dsuk,vp_vpi,vp_portres,vp_portordered,vp_portdemand,vpbw_id,vpbwordered_id,vp_bwdemand,vptype_id,vp_productiondate from dslprov_vp where vp_portsperc > '$query' order by $orderstm";
    }
  else
    {
    echo("error");
    }
// echo("$query");

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
  echo("<td align=center nowrap><b>No.</b></td>");
  echo("<td align=center nowrap><b><a href=index.php?page=$page&action=$action&formquery=$formquery&sort=vp_state>State</a></b></td>");
  echo("<td align=center nowrap><b><a href=index.php?page=$page&action=$action&formquery=$formquery&sort=cal_id>CAL</a></b></td>");
  echo("<td align=center nowrap><b><a href=index.php?page=$page&action=$action&formquery=$formquery&sort=exchange_id>Exchange</a></b></td>");
  echo("<td align=center nowrap><b><a href=index.php?page=$page&action=$action&formquery=$formquery&sort=vp_dsuk>DSUK</a></b></td>");
  echo("<td align=center nowrap><b><a href=index.php?page=$page&action=$action&formquery=$formquery&sort=vp_vpi>VPI</a></b></td>");
  echo("<td align=center nowrap><b>Port Res.</b></td>");
  echo("<td align=center nowrap><b>Last Port Order</b>");
  echo("<td align=center nowrap><b>Port Demand</b>");
  echo("<td align=center nowrap><b>Bandwidth</b>");
  echo("<td align=center nowrap><b>Last BW Order</b></td>");
  echo("<td align=center nowrap><b>BW Demand</b></td>");
  echo("<td align=center nowrap><b><a href=index.php?page=$page&action=$action&formquery=$formquery&sort=vptype_id>Type</a></b></td>");
  echo("<td align=center nowrap><b><a href=index.php?page=$page&action=$action&formquery=$formquery&sort=vp_productiondate>Prod. Date</a></b></td>");
  echo("<td align=center nowrap><b>EditVP</b></td>");
  echo("<!-- <td align=center nowrap><b>ShowVP</b></td> -->");


  for ($i=0;$i < mysql_num_rows($result);$i++)
    {
    $row = mysql_fetch_row($result);
    $j=0;
    echo("</tr><tr bgcolor=$bgcolor>");
    foreach ($row as $value)
      {
      if ($j==0)
        {
        $k=$i+1;
        $vp_id=$value;
        echo("<td align=center><b>$k</b></td>");
        }
      else if ($j==1)
        {
        $tvalue=get_vpstate($value);
        echo("<td align=center><b>$tvalue($value)</b></td>");
        }
      else if ($j==2)
        {
	$rvalue=get_calname($value);
	if ($rvalue==-1) $rvalue="none";
        echo("<td align=center><a href=index.php?page=1&action=searchvc_cal&cal_id=$value>$rvalue</a></td>");        
        }
      else if ($j==3)
        {
        echo("<td align=center><a href=index.php?page=1&action=searchvc_ex&exchange_id=$value>$value</a></td>");
        }
      else if ($j==4)
        {
        echo("<td align=center><a href=index.php?page=1&action=searchvc_vp&vp_id=$vp_id>$value</a></td>");
        }
      else if ($j==9)
        {
        $rvalue=get_vpbw($value);
        if ($rvalue==-1) $rvalue="none";
        echo("<td align=center>$rvalue</td>");         
        }
      else if ($j==10)
        {
        $rvalue=get_vpbw($value);
        if ($rvalue==-1) $rvalue="none";
        echo("<td align=center>$rvalue</td>");         
        }
      else if ($j==12)
        {
        $rvalue=get_vptype($value);
        if ($rvalue==-1) $rvalue="none";
        echo("<td align=center>$rvalue</td>");
        }
      else if ($j==13)
        {
        $tvalue=get_isodate($value);
        if ($value==0) $tvalue="none";
        echo("<td align=center>$tvalue</td>");
        echo("<td align=center><b><a href=index.php?page=7&vp=$vp_id&action=$action>>Edit</a></b></td>");         
        echo("<!-- <td align=center><b><a href=index.php?page=7&vp=$vp_id&action=vpshow>>Show</a></b></td>-->");         
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
