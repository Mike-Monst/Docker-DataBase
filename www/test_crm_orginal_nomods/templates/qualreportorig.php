<?

$bgcolor='#ffeebb';

echo("<h3>$month $year</h3>");
$repdatebegin=strtotime("$month/01/$year");
$month++;
$repdateend=strtotime("$month/01/$year");
$repdays=ceil(($repdateend-$repdatebegin)/86400);
//echo($repdays);

  echo("<center><table border=0><tr bgcolor=$tcolor0>");
  echo("<td align=center nowrap><b>Realm</b></td>");
  echo("<td align=center nowrap><b>Day</b></td>");
  echo("<td align=center nowrap><b>Leadtime:</b></td>");
  echo("<td bgcolor=amber align=center nowrap><b>< 1 week</b></td>");
  echo("<td bgcolor=yellow align=center nowrap><b>< 2 weeks</b></td>");
  echo("<td bgcolor=orange align=center nowrap><b>> 2 weeks</b></td>");
  echo("<td align=center nowrap><b>Delay Reasons:</b></td>");
  echo("<td bgcolor=orange align=center nowrap><b>Incompatible Product</b></td>");
  echo("<td bgcolor=orange align=center nowrap><b>Capacity Problems</b></td>");
  echo("<td bgcolor=orange align=center nowrap><b>BT Error</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>Total</b></td>");
  echo("</tr>");
  echo("<tr bgcolor=$tcolor0>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("</tr>");
  $userrealm=get_userrealm($userrealm_id);
  $w1sum=0;
  $w2sum=0;
  $w3sum=0;
  $w31sum=0;
  $w32sum=0;
  $w33sum=0;
  $sumwtotal=0;
  for ($i=0;$i<$repdays;$i++)
    {
    $d=$i+1;
    $w1=rand(10,99);
    $w2=rand(0,$w1);
    $w3=rand(0,$w2);
    $sumw=$w1+$w2+$w3;
    $w31=rand(0,$w3);
    $w32=rand(0,$w3-$w31);
    $w33=$w3-$w31-$w32;
    $w1sum+=$w1;
    $w2sum+=$w2;    
    $w3sum+=$w3;
    $w31sum+=$w31;
    $w32sum+=$w32;
    $w33sum+=$w33;
    $sumwtotal+=$sumw;

  echo("<tr bgcolor=$tcolor0>");
  echo("<td align=center nowrap><b>$userrealm</b></td>");
  echo("<td align=center nowrap><b>$d</b></td>");
  echo("<td align=center nowrap><b>&nbsp;</b></td>");
  echo("<td bgcolor=amber align=center nowrap><b>$w1</b></td>");
  echo("<td bgcolor=yellow align=center nowrap><b>$w2</b></td>");
  echo("<td bgcolor=orange align=center nowrap><b>$w3</b></td>");
  echo("<td align=center nowrap><b>&nbsp;</b></td>");
  echo("<td bgcolor=orange align=center nowrap><b>$w31</b></td>");
  echo("<td bgcolor=orange align=center nowrap><b>$w32</b></td>");
  echo("<td bgcolor=orange align=center nowrap><b>$w33</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>$sumw</b></td>");
  echo("</tr>");
    }

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


  echo("<tr bgcolor=$tcolor0>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("</tr>");
  echo("<tr bgcolor=$tcolor0>");
  echo("<td align=center nowrap><b>$userrealm</b></td>");
  echo("<td align=center nowrap><b>SUM:</b></td>");
  echo("<td align=center nowrap><b>&nbsp;</b></td>");
  echo("<td bgcolor=amber align=center nowrap><b>$w1sum</b></td>");
  echo("<td bgcolor=yellow align=center nowrap><b>$w2sum</b></td>");
  echo("<td bgcolor=orange align=center nowrap><b>$w3sum</b></td>");
  echo("<td align=center nowrap><b>&nbsp;</b></td>");
  echo("<td bgcolor=orange align=center nowrap><b>$w31sum</b></td>");
  echo("<td bgcolor=orange align=center nowrap><b>$w32sum</b></td>");
  echo("<td bgcolor=orange align=center nowrap><b>$w33sum</b></td>");
  echo("<td align=center nowrap><b>&nbsp;&nbsp;</b></td>");
  echo("<td align=center nowrap><b>$sumwtotal</b></td>");
  echo("</tr>");


  echo("</table></center>");

?>