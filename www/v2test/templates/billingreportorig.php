<?php

$bgcolor='#ffeebb';

//echo("$month $year");
$repdatebegin=strtotime("$month/01/$year");
$month++;
$repdateend=strtotime("$month/01/$year");

//echo("$repdatebegin $repdateend");

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

  echo("<center><table border=0><tr bgcolor=$tcolor0>");
// VISP , Realm

  echo("<td align=center nowrap><b>Realm</b></td>");
  echo("<td align=center nowrap><b>Surname</b></td>");
  echo("<td align=center nowrap><b>Postcode</b></td>");
  echo("<td align=center nowrap><b>CLI</b></td>");
  echo("<td align=center nowrap><b>Street</b></td>");
  echo("<td align=center nowrap><b>City</b></td>");
  echo("<td align=center nowrap><b>CBUK</b></td>");
  echo("<td align=center nowrap><b>BW</b></td>");
  echo("<td align=center nowrap><b>CR</b></td>");
  echo("<td align=center nowrap><b>Production Date</b></td>");
  echo("<td align=center nowrap><b>Usage Price</b></td>");
  echo("<td align=center nowrap><b>Inst. Price</b></td>");
  if ($userrealm_id=='all')
    {
    $selectrealm='';
    }
  else
    {
    $selectrealm="AND userrealm_id=$userrealm_id";
    }

  $query="select userrealm_id,vc_surname,vc_postcode,vc_cli,vc_street,vc_city,vc_cbuk,userbw_id,usercr_id,vc_productiondate from dslprov_vc where vc_state>25 AND vc_productiondate<$repdateend $selectrealm order by userrealm_id";

  //echo("$query");

  $result=mysql_query($query);

  $ipricesum=0;
  $mpricesum=0;

  for ($i=0;$i < mysql_num_rows($result);$i++)
    {
    $row = mysql_fetch_row($result);
    $j=0;
    echo("</tr><tr bgcolor=$bgcolor>");
    foreach ($row as $value)
      {
      if ($j==0)
        {
        $userrealm=get_userrealm($value);
        $userrealmid=$value;
        echo("<td align=center>$userrealm</td>");
        }
      else if ($j==7)
        {
        $tvalue=get_userbw($value);
        $value="$tvalue";
        echo("<td align=center>$value</td>");
        }
      else if ($j==8)
        {
        $tvalue=get_usercr($value);
        $value="1:$tvalue";
        echo("<td align=center>$value</td>");
        }
      else if ($j==9)
        {
        $totalrepdays=(($repdateend-$repdatebegin)/86400);
        $tvalue=date("d.m.y",$value);
        if ($value>$repdatebegin)
          {
          $repdays=ceil(($repdateend-$value)/86400);
          $installation=1;
          }
        else
          {
          $repdays=$totalrepdays;
          $installation=0;
          }
        $repfactor=($repdays/$totalrepdays);
        $value=$tvalue;
        echo("<td align=center>$value</td>");

        $tvalue=get_userrealmmprice($userrealmid);
        $price=round(($repfactor*$tvalue),2);
        //var_dump($repfactor);
        //var_dump($tvalue);
        echo("<td align=center><b>");
        $mpricesum+=$price;
        $mprice=sprintf("%01.2f",$price);
        echo("&pound; $mprice</b></td>");   
        $tvalue=0;    
        if ($installation==1)
          {  
          $tvalue=get_userrealmiprice($userrealmid);
          $ipricesum+=$tvalue;
          }
        echo("<td align=center><b>");
        $iprice=sprintf("%01.2f",$tvalue);
        echo("&pound; $iprice</b></td>");         
        }
      else
        {
        echo("<td align=center>$value</td>");
        }
      $j++;
      }
    }
  $ipricesumr=sprintf("%01.2f",$ipricesum);
  $mpricesumr=sprintf("%01.2f",$mpricesum);
  echo("</tr><tr>");
  echo("<td bgcolor=$tcolorblue align=center nowrap><span class=table0><b></b></span></td>");
  echo("<td bgcolor=$tcolorblue align=center nowrap><span class=table0><b></b></span></td>");
  echo("<td bgcolor=$tcolorblue align=center nowrap><span class=table0><b></b></span></td>");
  echo("<td bgcolor=$tcolorblue align=center nowrap><span class=table0><b></b></span></td>");
  echo("<td bgcolor=$tcolorblue align=center nowrap><span class=table0><b></b></span></td>");
  echo("<td bgcolor=$tcolorblue align=center nowrap><span class=table0><b></b></span></td>");
  echo("<td bgcolor=$tcolorblue align=center nowrap><span class=table0><b></b></span></td>");
  echo("<td bgcolor=$tcolorblue align=center nowrap><span class=table0><b></b></span></td>");
  echo("<td bgcolor=$tcolorblue align=center nowrap><span class=table0><b></b></span></td>");
  echo("<td bgcolor=$tcolorblue align=center nowrap><span class=table0><b></b></span></td>");
  echo("<td bgcolor=$tcolorblue align=center nowrap><span class=table0><b>&pound; $mpricesumr</b></span></td>");
  echo("<td bgcolor=$tcolorblue align=center nowrap><span class=table0><b>&pound; $ipricesumr</b></span></td>");

  echo("</tr></table></center>");

?>