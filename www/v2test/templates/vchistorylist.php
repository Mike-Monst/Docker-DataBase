<?php

$bgcolor='ffeebb';
  $query="select vc_visprefnum,vc_surname,vc_firstname,vc_citysubloc,vc_postcode,vc_city,vc_street,vc_houseno from dslprov_vc where vc_visprefnum like '$vc_visprefnum'";
  $result=mysql_query($query);

  $row = mysql_fetch_row($result);
  echo("<h4>Historie der Auftragsnummer ");
  $j=0;
  foreach ($row as $value)
    {
    echo(": $value ");
    }
  echo("</h4>");
  echo("<center><table border=0><tr bgcolor=$tcolor0>");

  echo("<td align=center nowrap><b>Lfd.</b></td>");
  echo("<td align=center nowrap><b>LetzterChange</b></td>");
  echo("<td align=center nowrap><b>Produkt</b></td>");
  echo("<td align=center nowrap><b>ZusatzProdukt</b></td>");
  echo("<td align=center nowrap><b>Vorprodukt</b></td>");
  echo("<td align=center nowrap><b>Email</b></td>");
  echo("<td align=center nowrap><b>InvMail</b></td>");
  echo("<td align=center nowrap><b>HW</b></td>");
  echo("<td align=center nowrap><b>Status</b></td>");
  echo("<td align=center nowrap><b>StatusVoice</b></td>");

  $query="select vc_statechangedate,product_id,productadditional_id,productcap_id,vc_email,invoicemail_id,hardware_id,vc_state,vc_state_voice from dslprov_vchistory where vc_visprefnum like '$vc_visprefnum' order by vc_statechangedate desc";
  $result=mysql_query($query);

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
        echo("<td align=center><b>$k</b></td>");
        $tvalue=get_isodate($value);
        echo("<td align=center>$tvalue</td>");
        }
      else if ($j==1)
        {
        $tvalue=get_product($value);
        if ($value==0) { $tvalue='-'; }
        echo("<td align=center>$tvalue</td>");
        }
      else if ($j==2)
        {
        $tvalue=get_productadditional($value);
        if ($value==0) { $tvalue='-'; }
        echo("<td align=center>$tvalue</td>");
        }
      else if ($j==3)
        {
        $tvalue=get_productcap($value);
        if ($value==0) { $tvalue='-'; }
        echo("<td align=center>$tvalue</td>");
        }
      else if ($j==7)
        {
        $tvalue=get_vcstate($value);
        $value="$tvalue($value)";
        echo("<td align=center>$value</td>");
        }
      else
        {
        echo("<td align=center>$value</td>");
        }
      $j++;
      }
    }
  echo("</tr></table></center>");
     
?>
