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
    <td bgcolor=$tcolor1>Hausnummer</td>
    <td bgcolor=$tcolor1><input name=vc_conn_houseno value='$vc_houseno' size=8></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>Kontakt Vorwahl</td>
    <td bgcolor=$tcolor0><input name=vc_conn_contactphonepre value='$vc_contactphonepre' size=16></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>Kontakt Telefonnummer</td>
    <td bgcolor=$tcolor1><input name=vc_conn_contactphone value='$vc_contactphone' size=16></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>Ort</td>
    <td bgcolor=$tcolor1>
    <select name=location_id>
");
   
  if ($location_id=='')
    {
    print "<option value selected>bitte ausw&auml;hlen</option>\n";
    }
  $query="select location_id,location_long,location_provider_details from dslprov_locations order by location_long;";
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
         $tvalue=$value;
         $sel='';
         if ($location_id==$value)
           {
           $sel=" selected";
           }
            
         }  
       if ($j==1)
         {
         $tortvalue=$value;
         }
       if ($j==2)
         {
           print "<option value=$tvalue$sel>$tortvalue --- $value</option>\n";
         }
       $j++;
       }
     }  


echo("
    </select>



    




    </td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>PLZ</td>
    <td bgcolor=$tcolor0><input name=vc_conn_postcode value='$vc_postcode' size=8></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>Firma</td>
    <td bgcolor=$tcolor1><input name=vc_conn_company value='$vc_company' size=32></td>
  </tr>

  <tr>
    <td bgcolor=$tcolor0>Haustyp</td>
    <td bgcolor=$tcolor0>
       <select name=vc_housetype>
       <option value $selvccthno>bitte ausw&auml;hlen</option>
       <option value=Einfamilienhaus $selvcctefh>Einfamilienhaus</option>
       <option value=Mehrfamilienhaus $selvcctmfh>Mehrfamilienhaus</option>
       </select>
    </td>
    <td bgcolor=$tcolor0>
    </td>                                       
  </tr>                







  <tr>
    <td bgcolor=$tcolor1>E-Mail Adresse</td>
    <td bgcolor=$tcolor1><input name=vc_email value='$vc_email' size=32></td>
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

  $query="select vcstate_id,vcstate_value from dslprov_vcstate order by vcstate_id";
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

  $query="select vcstate_id,vcstate_value from dslprov_vcstate order by vcstate_id";
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


</table>
</center>
<br><br>
");


?>
