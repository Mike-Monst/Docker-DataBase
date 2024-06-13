<?php

echo("

<center>
<form method=get>
<input type=hidden name=page value=1>
<input type=hidden name=action value='searchvc'>

<table border=0>
  <tr>
    <td bgcolor=$tcolor1>Auftragsnummer</td>
    <td bgcolor=$tcolor1><input name=vc_visprefnum value='$vc_visprefnum' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>Nachname</td>
    <td bgcolor=$tcolor0><input name=vc_conn_surname value='$vc_surname' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>Vorname</td>
    <td bgcolor=$tcolor1><input name=vc_conn_firstname value='$vc_firstname' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>Strasse</td>
    <td bgcolor=$tcolor0><input name=vc_conn_street value='$vc_street' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>Ort</td>
    <td bgcolor=$tcolor1><input name=vc_conn_city value='$vc_city' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>PLZ</td>
    <td bgcolor=$tcolor0><input name=vc_conn_postcode value='$vc_postcode' size=8></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>Order Datum YYYY-MM-DD</td>
    <td bgcolor=$tcolor0><input name=vc_orderdate value='$vc_orderdate' size=16></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>Terminwunsch YYYY-MM-DD</td>
    <td bgcolor=$tcolor1><input name=vc_reqdeliverydate value='$vc_reqdeliverydate' size=16></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>Commit Datum YYYY-MM-DD</td>
    <td bgcolor=$tcolor0><input name=vc_commitdate value='$vc_commitdate' size=16></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>Installation Datum YYYY-MM-DD</td>
    <td bgcolor=$tcolor1><input name=vc_installationdate value='$vc_installationdate'
size=16></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>Production Datum YYYY-MM-DD</td>
    <td bgcolor=$tcolor0><input name=vc_productiondate value='$vc_productiondate'
size=16></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>Cancel Datum YYYY-MM-DD</td>
    <td bgcolor=$tcolor1><input name=vc_canceldate value='$vc_canceldate'
size=16></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>Produkt</td>
    <td bgcolor=$tcolor0>
    <select name=product_id>
");


  $query="select * from dslprov_product";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
print"<option value=0 selected>alle</option>";
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
         if ($prod_id==$value)
           {
           $sel=" selected";
           }
         print "<option value=$value$sel>";
         }
       if ($j==1)
         {
         print "$value</option>\n";
         }
       $j++;
       }
     }

echo("
    </select>
    </td>
  </tr>


  <tr>
    <td bgcolor=$tcolor0>Zusatzprodukt</td>
    <td bgcolor=$tcolor0>
    <select name=productadditional_id>
");


  $query="select * from dslprov_productadditional";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
print"<option value=0 selected>alle</option>";
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
         if ($prod_id==$value)
           {
           $sel=" selected";
           }
         print "<option value=$value$sel>";
         }
       if ($j==1)
         {
         print "$value</option>\n";
         }
       $j++;
       }
     }

echo("
    </select>
    </td>
  </tr>


  <tr>
    <td bgcolor=$tcolor0>Status</td>
    <td bgcolor=$tcolor0>
    <select name=vc_state>
");

  $query="select vcstate_id,vcstate_value from dslprov_vcstate";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
print"<option value=0 selected>alle</option>";
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($j==0)
         {
         print "<option value=$value$sel>";
         $dvalue=$value;
         }
       if ($j==1)
         {
         print "$value ($dvalue)</option>\n";
         $dvalue='';
         }
       $j++;
       }
     }

echo("
    </select>
    </td>
  </tr>

  <tr>
    <td bgcolor=$tcolor0>Status Voice</td>
    <td bgcolor=$tcolor0>
    <select name=vc_state_voice>
");

  $query="select vcstate_id,vcstate_value from dslprov_vcstate";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
print"<option value=0 selected>alle</option>";
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($j==0)
         {
         print "<option value=$value$sel>";
         $dvalue=$value;
         }
       if ($j==1)
         {
         print "$value ($dvalue)</option>\n";
         $dvalue='';
         }
       $j++;
       }
     }

echo("
    </select>
    </td>
  </tr>




  <tr>
    <td colspan=2><center><br><br>
    <input type=submit value='SearchCustomer' name=formtype>
    </center> 
   </td>
  </tr>
</table>
</form>

<hr size=1 width=70%>

<form method=get>
<input type=hidden name=page value=1>
<input type=hidden name=action value='searchvp_cal'>

<table border=0>
  <tr>
    <td>VP by CAL</td>
    <td>
    <select name=query>
");

  $query="select cal_id,cal_name from dslprov_cal";
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
         if ($cal_id==$h)
          {
           $sel=" selected";
           }
         print "<option value=$value$sel>";
         }
       if ($j==1)
         {
         print "$value</option>\n";
         }
       $j++;
       }
     }

echo("
    </select>
    </td>
    <td>
    <input type=submit value='Search' name=formtype>
    </td>
  </tr>
</form>

<form method=get>
<input type=hidden name=page value=1>
<input type=hidden name=action value='searchvp_dsuk'>
  <tr>
    <td>VP by DSUK</td>
    <td><input name=query value='$vp_dsuk' size=16></td>
    <td>
    <input type=submit value='Search' name=formtype>
    </td>
  </tr>
</form>
<form method=get>
<input type=hidden name=page value=1>
<input type=hidden name=action value='searchvp_ex'>


  <tr>
    <td>Exchange</td>
    <td>
    <select name=query>
");

  $query="select exchange_id,exchange_name from dslprov_btexchange order by exchange_name";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($j==0)
         {
         print "<option value=$value>$value , ";
         }
       if ($j==1)
         {
         print "$value</option>\n";
         }
       $j++;
       }
     }

echo("
    </select>
    </td>
    <td>    
    <input type=submit value='Search' name=formtype>
    </td>
  </tr>
</form>
<form method=get>
<input type=hidden name=page value=1>
<input type=hidden name=action value='searchvp_state'>

  <tr>
    <td>VP State</td>
    <td>
    <select name=query>
");

  $query="select vpstate_id,vpstate_value from dslprov_vpstate";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
print"<option value=0 selected>all</option>";
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($j==0)
         {
         print "<option value=$value$sel>";
         }
       if ($j==1)
         {
         print "$value</option>\n";
         }
       $j++;
       }
     }

echo("
    </select>
    </td>
    <td>    
    <input type=submit value='Search' name=formtype>
    </td>
  </tr>
</form>
<form method=get>
<input type=hidden name=page value=1>
<input type=hidden name=action value='searchvp_bwperc'>
  <tr>
    <td>VP BW usage > %</td>
    <td><input name=query value='$vpbw_usage' size=16></td>
    <td>
    <input type=submit value='Search' name=formtype>
    </td>
  </tr>
</form>
<form method=get>
<input type=hidden name=page value=1>
<input type=hidden name=action value='searchvp_portsperc'>
  <tr>
    <td>VP Ports usage > %</td>
    <td><input name=query value='$vp_portsusage' size=16></td>
    <td>
    <input type=submit value='Search' name=formtype>
    </td>
  </tr>
</form>
<form method=get>
<input type=hidden name=page value=1>
<input type=hidden name=action value='searchcal_perc'>
  <tr>
    <td>CAL/Central BW usage > %</td>
    <td><input name=query value='$cal_usage' size=16></td>
    <td>
    <input type=submit value='Search' name=formtype>
    </td>
  </tr>
</form>

</table>
</center>
<br><br>
");


?>
