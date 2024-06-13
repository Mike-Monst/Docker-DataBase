<?

echo("

<center>
<form method=get>
<input type=hidden name=page value=1>
<input type=hidden name=action value='searchvc'>

<table border=0>
  <tr>
    <td bgcolor=$tcolor0>Batch ID</td>
    <td bgcolor=$tcolor0><input name=vc_batch_visp value='$vc_batch_visp' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>Reference / Order Number</td>
    <td bgcolor=$tcolor1><input name=vc_visprefnum value='$vc_visprefnum' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>Surname</td>
    <td bgcolor=$tcolor0><input name=vc_surname value='$vc_surname' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>Firstname</td>
    <td bgcolor=$tcolor1><input name=vc_firstname value='$vc_firstname' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>Street</td>
    <td bgcolor=$tcolor0><input name=vc_street value='$vc_street' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>City</td>
    <td bgcolor=$tcolor1><input name=vc_city value='$vc_city' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>Postcode</td>
    <td bgcolor=$tcolor0><input name=vc_postcode value='$vc_postcode' size=8></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>Prefix / CLI</td>
    <td bgcolor=$tcolor1><input name=vc_cli value='$vc_cli' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>Order Date YYYY-MM-DD</td>
    <td bgcolor=$tcolor0><input name=vc_orderdate value='$vc_orderdate' size=16></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>Requested Delivery Date YYYY-MM-DD</td>
    <td bgcolor=$tcolor1><input name=vc_reqdeliverydate value='$vc_reqdeliverydate'
size=16></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>Commit Date YYYY-MM-DD</td>
    <td bgcolor=$tcolor0><input name=vc_commitdate value='$vc_commitdate' size=16></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>Installation Date YYYY-MM-DD</td>
    <td bgcolor=$tcolor1><input name=vc_installationdate value='$vc_installationdate'
size=16></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>Production Date YYYY-MM-DD</td>
    <td bgcolor=$tcolor0><input name=vc_productiondate value='$vc_productiondate'
size=16></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>Cancel Date YYYY-MM-DD</td>
    <td bgcolor=$tcolor1><input name=vc_canceldate value='$vc_canceldate'
size=16></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>Product Bandwidth</td>
    <td bgcolor=$tcolor0>
    <select name=userbw_id>
");


  $query="select * from dslprov_userbw";
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
       if (is_numeric($value)) { $value = (int)$value; }
       if ($j==0)
         {
         $sel='';
         if ($userbw_id==$value)
           {
           $sel=" selected";
           }
         print "<option value=$value$sel>";
         }
       if ($j==1)
         {
         print "$value KBit/s</option>\n";
         }
       $j++;
       }
     }

echo("
    </select>
    </td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>Contention</td>
    <td bgcolor=$tcolor1>
    <select name=usercr_id>
");

  $query="select * from dslprov_usercr";
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
       if (is_numeric($value)) { $value = (int)$value; }
       if ($j==0)
         {
         $sel='';
         if ($usercr_id==$value)
           {
           $sel=" selected";
           }
         print "<option value=$value$sel>";
         }
       if ($j==1)
         {
         print "1 : $value</option>\n";
         }
       $j++;
       }
     }


echo("
    </select>
    </td>
  </tr>

  <tr>
    <td bgcolor=$tcolor0>State</td>
    <td bgcolor=$tcolor0>
    <select name=vc_state>
");

  $query="select vcstate_id,vcstate_value from dslprov_vcstate";
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
  </tr>
  <tr>
    <td bgcolor=$tcolor1>Realm</td>
    <td bgcolor=$tcolor1>
    <select name=userrealm_id>
");


  $query="select * from dslprov_userrealm";
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
       if (is_numeric($value)) { $value = (int)$value; }
       if ($j==0)
         {
         $sel='';
         if ($userrealm_id==$value)
           {
           $sel=" selected";
           }
         print "<option value=$value$sel>";
         }
       if ($j==2)
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
    <td bgcolor=$tcolor0>BT Product</td>
    <td bgcolor=$tcolor0>
    <select name=btproduct_id>
");


  $query="select * from dslprov_btproduct";
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
       if (is_numeric($value)) { $value = (int)$value; }
       if ($j==0)
         {
         $sel='';
         if ($btproduct_id==$value)
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
    <td bgcolor=$tcolor1>CBUK</td>
    <td bgcolor=$tcolor1><input name=vc_cbuk value='$vc_cbuk' size=16></td>
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
