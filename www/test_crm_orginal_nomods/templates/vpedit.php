<?
$write=1;

$submitvalue='';
$actionflag=0;
if ($vp!=0)
  {
  $query="select * from dslprov_vp where vp_id LIKE '$vp'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  $rowarray=mysql_fetch_array($result);

  $vp_id=$vp;
  $vp_state=$rowarray['vp_state'];
  $cal_id=$rowarray['cal_id'];
  $exchange_id=$rowarray['exchange_id'];
  $vp_dsuk=$rowarray['vp_dsuk'];
  $vp_vpi=$rowarray['vp_vpi'];
  $vp_portres=$rowarray['vp_portres'];
  $vp_portordered=$rowarray['vp_portordered'];
  $vp_portordereddate=$rowarray['vp_portordereddate'];
  $vp_portdemand=$rowarray['vp_portdemand'];
  $vpbw_id=$rowarray['vpbw_id'];
  $vpbwordered_id=$rowarray['vpbwordered_id'];
  $vp_bwordereddate=$rowarray['vp_bwordereddate'];
  $vp_bwdemand=$rowarray['vp_bwdemand'];
  $vptype_id=$rowarray['vptype_id'];
  $vp_reqdeliverydate=$rowarray['vp_reqdeliverydate'];
  $vp_productiondate=$rowarray['vp_productiondate'];
  $vp_updemandstate=$rowarray['vp_updemandstate'];
  $vp_updemandstatechangedate=$rowarray['vp_updemandstatechangedate'];
  $vp_orderedstate=$rowarray['vp_orderedstate'];
  $vp_orderedstatechangedate=$rowarray['vp_orderedstatechangedate'];
  }

echo("
<center>
<form method=get>
<input type=hidden name=page value=7>
<input type=hidden name=vp_id value=$vp_id>
<input type=hidden name=vp_updemandstate value=$vp_updemandstate>
<input type=hidden name=vp_updemandstatechangedate value=$vp_updemandstatechangedate>
<input type=hidden name=vp_orderedstate value=$vp_orderedstate>
<input type=hidden name=vp_orderedstatechangedate value=$vp_orderedstatechangedate>
");


  $time=time();
//  date("d.m.y H:i",$time)
if ($write==1)
  {
  if ((($action=='vpdelivered')||($action==vpdeliveredconf))&&($write==1))
    {
    $actionflag=2;
    echo("<input type=hidden name=action value=vpdeliveredconf>");
    $submitvalue='Save';
    }
  // else if ((($action=='vpupgrade')||($action==vpupgradeconf))&&($write==1))
  else
    {
    $actionflag=1;
    echo("<input type=hidden name=action value=vpupgradeconf>");
    $submitvalue='Order/Update';
    if ($vp_reqdeliverydate=='')
      {
      
      get_leadtimes($vc_leadtime,$vp_leadtime);
      $vp_reqdeliverydate=time()+$vp_leadtime;
      }
    }
  }
else
  {
  $actionflag=3;
  }

$vp_state_value=get_vpstate($vp_state);
$cal_value=get_calname($cal_id);

echo("
<table border=0>
  <tr>
    <td>VP State</td>
    <td><b>$vp_state_value($vp_state)</b></td>
<input type=hidden name=vp_state value='$vp_state'>
  </tr>
  <tr>
    <td>Exchange</td>
    <td>$exchange_id</td>
<input type=hidden name=exchange_id value='$exchange_id'>
  </tr>
  <tr>
    <td>CAL</td>
    <td>$cal_value</td>
<input type=hidden name=cal_id value='$cal_id'>
  </tr>
  <tr>
    <td>DSUK Ref.</td>
");

if ($actionflag==2)
  {
  echo("<td><input name=vp_dsuk value='$vp_dsuk' size=16></td>");
  }
else
  {
  echo("
  <td>$vp_dsuk</td>
  <input type=hidden name=vp_dsuk value='$vp_dsuk'>
  ");
  }

echo("
  </tr>
  <tr>
    <td>VPI</td>
");

if ($actionflag==2)
  {
  echo("<td><input name=vp_vpi value='$vp_vpi' size=16></td>");
  }
else
  {
  echo("
  <td>$vp_vpi</td>
  <input type=hidden name=vp_vpi value='$vp_vpi'>
  ");
  }

echo("
  </tr>
  <tr>
    <td>Port Reservation</td>
");

if (($actionflag==2)||($actionflag==3))
  {
  echo("
  <td>$vp_portres</td>
  <input type=hidden name=vp_portres value='$vp_portres'>
  ");
  }
else 
  {
  echo("
  <input type=hidden name=vp_portresold value='$vp_portres'>
  <td><input name=vp_portres value='$vp_portres' size=8></td>
  ");
  }

echo("
  </tr>
  <tr>
    <td>Last Ports Order</td>
    <td>$vp_portordered</td>
<input type=hidden name=vp_portordered value='$vp_portordered'>
  </tr>
  <tr>
    <td>Last Ports Order Date</td>
");

  $vp_portordereddateiso=get_isodate($vp_portordereddate);
  if ($vp_portordereddate==0)
    {
    $vp_portordereddateiso='none';
    }
echo("    <td>$vp_portordereddateiso</td>
<input type=hidden name=vp_portordereddate value='$vp_portordereddate'>
  </tr>
  <tr>
    <td>Port Demand</td>
    <td>$vp_portdemand</td>
<input type=hidden name=vp_portdemand value='$vp_portdemand'>
  </tr>
  <tr>
    <td>Bandwidth</td>
");

if (($actionflag==2)||($actionflag==3))
  {
  $value=get_vpbw($vpbw_id);
  echo("
  <td>$value</td>
  <input type=hidden name=vpbw_id value='$vpbw_id'>
  ");
  }
else
  {
  echo("
    <input type=hidden name=vpbw_idold value='$vpbw_id'>
    <td>
    <select name=vpbw_id>
  ");

  $query="select * from dslprov_vpbw";  
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
   for ($i=0;$i < mysql_num_rows($result);$i++) 
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value) 
       {
       if (is_numeric($value)) { $value = (int)$value; }
       if ($j==0)
         {
         $sel='';
         $h=$i+1;
         if ($vpbw_id==$h)
           {
           $sel=" selected";
           }
         print "<option value=$value$sel>";
         }
       if ($j==1)
         {
         print "$value Kbits</option>\n";
         }
       $j++;
       }
     }

  echo("
    </select>
    </td>
  ");
  }

echo("
  </tr>
  <tr>
    <td>Last Bandwidth Order</td>
    <td>
");
$value=get_vpbw($vpbwordered_id);
if ($value==-1) $value='none';
echo("$value Kbits</td>
<input type=hidden name=vpbwordered_id value='$vpbwordered_id'>
  </tr>
  <tr>
    <td>Last Bandwidth Order Date</td>
");

  $vp_bwordereddateiso=get_isodate($vp_bwordereddate);
  if ($vp_bwordereddate==0)
    {
    $vp_bwordereddateiso='none';
    }

echo("    <td>$vp_bwordereddateiso</td>
<input type=hidden name=vp_bwordereddate value='$vp_bwordereddate'>
  </tr>
  <tr>
    <td>Bandwidth Demand</td>
    <td>$vp_bwdemand Kbits</td>
<input type=hidden name=vp_bwdemand value='$vp_bwdemand'>
  </tr>

  <tr>
    <td>Req. Delivery Date</td>
");

  $vp_reqdeliverydateiso=get_isodate($vp_reqdeliverydate);

echo("    <td>$vp_reqdeliverydateiso</td>

<input type=hidden name=vp_reqdeliverydate value='$vp_reqdeliverydate'>
  </tr>
  <tr>
    <td>Production Date</td>

");
  $vp_productiondatiso='';
  if ($vp_productiondate!='')
    {
    $vp_productiondateiso=get_isodate($vp_productiondate);
    }
  else
    {
    if ($actionflag==2) {$vp_productiondateiso=get_isodate(time()); }
    }
if ($actionflag==2)
  {
  echo("<td><input name=vp_productiondate value='$vp_productiondateiso' size=16></td>");
  }
else
  {
  echo("
  <td>$vp_productiondateiso</td>
  <input type=hidden name=vp_productiondate value='$vp_productiondateiso'>
  ");
  }

if (($actionflag==1)||($actionflag==2))
  {
echo("
  </tr>
  <tr>
    <td colspan=2><center><br><br>
    <input type=submit value='$submitvalue' name=formtype>
    </center> 
   </td>
");
  }

echo("
  </tr>
</table>
</form>
</center>
");


?>
