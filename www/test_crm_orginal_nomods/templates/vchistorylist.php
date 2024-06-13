<?

$bgcolor='ffeebb';
  $query="select vc_cli,vc_surname,vc_street,vc_city,vc_cbuk,vc_vci from dslprov_vc where vc_cli like '$vc_cli'";
  $result=mysql_query($query);

  $row = mysql_fetch_row($result);
  echo("<h4>History for CLI ");
  $j=0;
  foreach ($row as $value)
    {
    echo(": $value ");
    }
  echo("</h4>");
  echo("<center><table border=0><tr bgcolor=$tcolor0>");

  echo("<td align=center nowrap><b>No.</b></td>");
  echo("<td align=center nowrap><b>Lastchange</b></td>");
  echo("<td align=center nowrap><b>Realm</b></td>");
  echo("<td align=center nowrap><b>BT Product</b></td>");
  echo("<td align=center nowrap><b>BW</b></td>");
  echo("<td align=center nowrap><b>CR</b></td>");
  echo("<td align=center nowrap><b>State</b></td>");
  echo("<td align=center nowrap><b>DSUK</b></td>");
  echo("<td align=center nowrap><b>Exchange</b></td>");

  $query="select vc_statechangedate,userrealm_id,btproduct_id,userbw_id,usercr_id,vc_state,vp_id from dslprov_vchistory where vc_cli like '$vc_cli' order by vc_statechangedate desc";
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
        $tvalue=get_userrealm($value);
        echo("<td align=center>$tvalue</td>");
        }
      else if ($j==2)
        {
        $tvalue=get_btproduct($value);
        echo("<td align=center>$tvalue</td>");
        }
      else if ($j==3)
        {
        $tvalue=get_userbw($value);
        echo("<td align=center>$tvalue</td>");
        }
      else if ($j==4)
        {
        $tvalue=get_usercr($value);
        echo("<td align=center>1 : $tvalue</td>");
        }
      else if ($j==5)
        {
        $tvalue=get_vcstate($value);
        $value="$tvalue($value)";
        echo("<td align=center>$value</td>");
        }
      else if ($j==6)
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
        //echo("<td align=center>$vp_vpi</td>");
        echo("<td align=center><a href=index.php?page=7&action=vpshow&vp=$value>$vp_dsuk</a></td>");
        echo("<td align=center><a href=index.php?page=1&action=searchvp_ex&query=$exchange_id>$exchange_id</a></td>");
        //echo("<td align=center><a href=index.php?page=1&action=searchvp_cal&query=$cal_id>$cal</td>");
        //echo("<td align=center>$vp_state_value($vp_state)</td>");
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
