<?php
$write=1;
if ((($action=='vcorder')||($action=='vcorderform'))&&($write==1))
  {
// date("d.m.y H:i",$time)
if ($vc_reqdeliverydate=='')
  {
//  get_leadtimes($vc_leadtime,$vp_leadtime);
//  $vc_reqdeliverydate=time()+$vc_leadtime;
//  $vc_reqdeliverydate=get_isodate($vc_reqdeliverydate);
  }


if ($action!='vcorder')
  {
$c_product_id=$tcolor1;
$c_vc_salutation=$tcolor0;
$c_productcap_id=$tcolor0;
$c_vc_company=$tcolor1;
$c_vc_title=$tcolor0;
$c_vc_surname=$tcolor1;
$c_vc_firstname=$tcolor0;
$c_vc_birthday=$tcolor1;
$c_vc_street=$tcolor0;
$c_vc_houseno=$tcolor1;
$c_vc_postcode=$tcolor0;
$c_vc_city=$tcolor1;
$c_vc_contact=$tcolor0;
$c_vc_contactphone=$tcolor1;
$c_vc_reqdeliverydate=$tcolor1;
$c_vc_taefiber=$tcolor0;
$c_vc_email=$tcolor1;
$c_evn_id=$tcolor0;
$c_hardware_id=$tcolor1;
$c_telregister_id=$tcolor0;
$c_vc_comments=$tcolor1;
$c_vc_bankname=$tcolor1;
$c_vc_bankaccholder=$tcolor0;
$c_vc_bankaccnumber=$tcolor1;
$c_vc_banksortcode=$tcolor0;
$c_vc_bankiban=$tcolor1;
$c_vc_port=$tcolor0;
  }


echo("

<center>
<FORM method=POST enctype=multipart/form-data >
<input type=hidden name=page value=3>
<input type=hidden name=action value=vcorder>
<input type=hidden name=usercr_id value=1>
<table border=0>
  <tr>
    <td bgcolor=$tcolor0><b>Auftragsnummer</b><br>&nbsp;</td>
    <td bgcolor=$tcolor0>wird automatisch erzeugt<br>&nbsp;</td>
    <td bgcolor=$tcolor0>
  </tr>
  <tr>
    <td bgcolor=$c_product_id>&nbsp;<br><b>Produkt</b><br>&nbsp;</td>
    <td bgcolor=$tcolor1>
    <select name=product_id>
");


  $query="select * from dslprov_product";
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
         if ($product_id==$value)
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
    <td bgcolor=$tcolor1>
    <select name=productadditional_id>
    <option value=0 selected>kein Zusatzprodukt</option>
");


  $query="select * from dslprov_productadditional";
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
         if ($productadditional_id==$value)
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
    <td bgcolor=$c_productcap_id>CAP Vorproduktwahl</td>
    <td bgcolor=$tcolor0>
    <select name=productcap_id>
    <option value=0 selected>automatisch</option>
");


  $query="select * from dslprov_productcap";
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
         if ($productcap_id==$value)
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
    <td bgcolor=$tcolor0></td>
  </tr>

  <tr>
    <td bgcolor=$tcolor1>&nbsp;<br><b>Kundendaten</b><br>&nbsp;</td>
    <td bgcolor=$tcolor1>&nbsp;<br>Anschlussanschrift:<br>Wo soll die Leitung geschaltet werden?<br>&nbsp;</td>
    <td bgcolor=$tcolor1>&nbsp;<br>optional, nur falls abweichend:<br>Auftraggeber-/Rechnungsanschrift<br>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_salutation>* Anrede</td>
    <td bgcolor=$tcolor0>
       <select name=vc_conn_salutation>
     ");
     
if ($vc_conn_salutation=='Herr') { $selvccthr='selected'; }
else if ($vc_conn_salutation=='Frau') { $selvcctfr='selected'; }
else if ($vc_conn_salutation=='Firma') { $selvcctfa='selected'; } 
else if ($vc_conn_salutation=='Frau_und_Herr') { $selvcctfh='selected'; } 
else { $selvcctno='selected'; }    
     
echo("              
       <option value $selvcctno>bitte ausw&auml;hlen</option>
       <option value=Herr $selvccthr>Herr</option>
       <option value=Frau $selvcctfr>Frau</option>
       <option value=Firma $selvcctfa>Firma</option>
       <option value=Frau_und_Herr $selvcctfh>Frau und Herr</option>       
       </select>
    </td>
    <td bgcolor=$tcolor0>
      <select name=vc_salutation>
     ");
     
if ($vc_salutation=='Herr') { $selvcthr='selected'; }
else if ($vc_salutation=='Frau') { $selvctfr='selected'; }
else if ($vc_salutation=='Firma') { $selvctfa='selected'; } 
else if ($vc_salutation=='Frau_und_Herr') { $selvctfh='selected'; } 
else { $selvctno='selected'; }    
     
echo("              
       <option value $selvctno>bitte ausw&auml;hlen</option>
       <option value=Herr $selvcthr>Herr</option>
       <option value=Frau $selvctfr>Frau</option>
       <option value=Firma $selvctfa>Firma</option>
       <option value=Frau_und_Herr $selvctfh>Frau und Herr</option>
      </select>
    </td>                                       
  </tr>                
  <tr>
    <td bgcolor=$c_vc_company>Firmenname</td>
    <td bgcolor=$tcolor1><input name=vc_conn_company value='$vc_conn_company' size=32></td>
    <td bgcolor=$tcolor1><input name=vc_company value='$vc_company' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_title>Titel (Dr./Prof. etc)</td>
    <td bgcolor=$tcolor0><input name=vc_conn_title value='$vc_conn_title' size=32></td>
    <td bgcolor=$tcolor0><input name=vc_title value='$vc_title' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_surname>* Nachname / Ansprechpartner NN bei Firma</td>
    <td bgcolor=$tcolor1><input name=vc_conn_surname value='$vc_conn_surname' size=32></td>
    <td bgcolor=$tcolor1><input name=vc_surname value='$vc_surname' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_firstname>* Vorname / Ansprechpartner VN bei Firma</td>
    <td bgcolor=$tcolor0><input name=vc_conn_firstname value='$vc_conn_firstname' size=32></td>
    <td bgcolor=$tcolor0><input name=vc_firstname value='$vc_firstname' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_birthday>Geburtsdatum</td>
    <td bgcolor=$tcolor1><input name=vc_conn_birthday value='$vc_conn_birthday' size=32></td>
    <td bgcolor=$tcolor1><input name=vc_birthday value='$vc_birthday' size=32></td>
  </tr>            
  <tr>
    <td bgcolor=$c_vc_street>* Strasse</td>
    <td bgcolor=$tcolor0><input name=vc_conn_street value='$vc_conn_street' size=32></td>
    <td bgcolor=$tcolor0><input name=vc_street value='$vc_street' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_houseno>* Hausnr.</td>
    <td bgcolor=$tcolor1><input name=vc_conn_houseno value='$vc_conn_houseno' size=8></td>
    <td bgcolor=$tcolor1><input name=vc_houseno value='$vc_houseno' size=8></td>
  </tr>            


<!--
  <tr>
    <td bgcolor=$c_vc_postcode>* PLZ</td>
    <td bgcolor=$tcolor0><input name=vc_conn_postcode value='$vc_conn_postcode' size=8></td>
    <td bgcolor=$tcolor0><input name=vc_postcode value='$vc_postcode' size=8></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_city>* Ort<br>Ortsteil (wenn vorhanden)</td>
    <td bgcolor=$tcolor1>
      <input name=vc_conn_city value='$vc_conn_city' size=32><br>
      <input name=vc_conn_citysubloc value='$vc_conn_citysubloc' size=32>
    </td>
    <td bgcolor=$tcolor1>
      <input name=vc_city value='$vc_city' size=32><br>
      <input name=vc_citysubloc value='$vc_citysubloc' size=32>
    </td>
  </tr>
-->

  <tr>
    <td bgcolor=$c_vc_postcode>* PLZ</td>

    <td rowspan=2 bgcolor=$tcolor0>
    
    <select name=location_id>
");

  if ($location_id=='')
    {
    print "<option value selected>bitte ausw&auml;hlen</option>\n";
    }
  $query="select location_id,location_long from dslprov_locations";
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
           print "<option value=$tvalue$sel>$value</option>\n";
         }
       $j++;
       }
     }


echo("
    </select>



















    
    
    </td>

    <td bgcolor=$tcolor0><input name=vc_postcode value='$vc_postcode' size=8></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_city>* Ort<br>Ortsteil (wenn vorhanden)</td>
<!--
    <td bgcolor=$tcolor1>
      <input name=vc_conn_city value='$vc_conn_city' size=32><br>
      <input name=vc_conn_citysubloc value='$vc_conn_citysubloc' size=32>
    </td>
-->
    <td bgcolor=$tcolor1>
      <input name=vc_city value='$vc_city' size=32><br>
      <input name=vc_citysubloc value='$vc_citysubloc' size=32>
    </td>
  </tr>

  <tr>
    <td bgcolor=$c_vc_contact>Ansprechpartner (Vor- Nachname), falls abweichend</td>
    <td bgcolor=$tcolor0><input name=vc_conn_contactfirstname value='$vc_conn_contactfirstname' size=13><input name=vc_conn_contact value='$vc_conn_contact' size=13></td>
    <td bgcolor=$tcolor0><input name=vc_contactfirstname value='$vc_contactfirstname' size=13><input name=vc_contact value='$vc_contact' size=13></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_contactphone>* Rufnummer / Format: Vorwahl Rufnummer</td>
    <td bgcolor=$tcolor1><input name=vc_conn_contactphonepre value='$vc_conn_contactphonepre' size=6><input name=vc_conn_contactphone value='$vc_conn_contactphone' size=16></td>
    <td bgcolor=$tcolor1><input name=vc_contactphonepre value='$vc_contactphonepre' size=6><input name=vc_contactphone value='$vc_contactphone' size=16></td>
  </tr>  
  <tr>
    <td bgcolor=$tcolor0>&nbsp;<br><b>Bestelloptionen</b><br>&nbsp;</td>
    <td bgcolor=$tcolor0></td>
    <td bgcolor=$tcolor0></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_reqdeliverydate>Terminwunsch Leitung (wenn leer: so schnell wie m&ouml;glich)<br>Terminwunsch Telefonie (wenn leer identisch Ltg.)</td>
    <td bgcolor=$tcolor1>
<!--
    <input type=\"text\" id=\"datepicker\" name=vc_reqdeliverydate value='$vc_reqdeliverydate'  size=16><br>
    <input type=\"text\" id=\"datepicker\" name=vc_reqdeliverydate_voice value='$vc_reqdeliverydate_voice' size=16>
-->
    <input type=\"text\"  name=vc_reqdeliverydate value='$vc_reqdeliverydate'  size=16>Format: JJJJ-MM-DD<br>
    <input type=\"text\"  name=vc_reqdeliverydate_voice value='$vc_reqdeliverydate_voice' size=16>Format: JJJJ-MM-DD

    </td>
    <td bgcolor=$tcolor1>Vorlaufzeiten:<br>mind. 14 Tage ohne Rufnummernmitnahme<br>mind. 30 Tage f&uuml;r Rufnummernmitnahme<br>falls Wunsch <br><i>so schnell wie m&ouml;glich</i></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_taefiber>* Lage der TAE Dose (bei DSL) oder Infos zum Fiberabschluss (wenn vorhanden) bei Glas</td>
    <td bgcolor=$tcolor0><input name=vc_taefiber value='$vc_taefiber' size=32></td>
    <td bgcolor=$tcolor0></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_email>email Adresse (f&uuml;r Rechnungen)</td>
    <td bgcolor=$tcolor1><input name=vc_email value='$vc_email' size=32></td>
    <td bgcolor=$tcolor1>Rechnung per Post (gg. Aufpreis)
      <select name=invoicemail_id>
");


  $query="select * from dslprov_options_invoicemail";
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
         if ($invoicemail_id==$value)
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
    <td bgcolor=$c_evn_id>Einzelverbindungsnachweis</td>
    <td bgcolor=$tcolor0>
       <select name=evn_id>
");


  $query="select * from dslprov_options_evn";
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
         if ($evn_id==$value)
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
    <td bgcolor=$tcolor0>
    </td>
  </tr>                                                                                                        
  <tr>
    <td bgcolor=$c_hardware_id>Hardware Mitbestellung</td>
    <td bgcolor=$tcolor1>
       <select name=hardware_id>
");


  $query="select * from dslprov_options_hardware";
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
         if ($hardware_id==$value)
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
    <td bgcolor=$tcolor1>
    </td>
  </tr>
  <tr>
    <td bgcolor=$c_telregister_id>Telefonbucheintrag</td>
    <td bgcolor=$tcolor0>
       <select name=telregister_id>
");


  $query="select * from dslprov_options_telregister";
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
         if ($telregister_id==$value)
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
    <td bgcolor=$tcolor0>
       <select name=telregistertype_id>
");


  $query="select * from dslprov_options_telregistertype order by telregistertype_id";
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
         if ($telregistertype_id==$value)
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
    <td bgcolor=$c_vc_comments>Bemerkungen</td>
    <td colspan=2 bgcolor=$tcolor1><input name=vc_comments value='$vc_comments' size=64></td>
  </tr>
  
  <tr>
    <td bgcolor=$tcolor0>&nbsp;<br><b>Bankdaten</b><br>&nbsp;</td>
    <td bgcolor=$tcolor0><br>&nbsp;</td>
    <td bgcolor=$tcolor0><br>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_bankname>Geldinstitut</td>
    <td bgcolor=$tcolor1><input name=vc_bankname value='$vc_bankname' size=32></td>
    <td bgcolor=$tcolor1></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_bankaccholder>Kontoinhaber</td>
    <td bgcolor=$tcolor0><input name=vc_bankaccholder value='$vc_bankaccholder' size=32></td>                                                                                 
    <td bgcolor=$tcolor0>NEU: Sonderzeichen wie Umlaute umschreiben</td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_bankaccnumber>Kontonummer</td>
    <td bgcolor=$tcolor1><input name=vc_bankaccnumber value='$vc_bankaccnumber' size=32></td>
    <td bgcolor=$tcolor1></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_banksortcode>Bankleitzahl</td>
    <td bgcolor=$tcolor0><input name=vc_banksortcode value='$vc_banksortcode' size=32></td>
    <td bgcolor=$tcolor0></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_bankiban>IBAN</td>
    <td bgcolor=$tcolor1><input name=vc_bankiban value='$vc_bankiban' size=32></td>
    <td bgcolor=$tcolor1></td>             
  <tr>
    <td bgcolor=$c_vc_port>abgebender (bisheriger) Provider/Carrier<br>zu portierende Rufnummer(n)<br><b>nur ausf&uuml;llen bei Rufnummernmitnahme<br>(Anbieterwechselauftrag)!</b></td>
    <td colspan=2 bgcolor=$tcolor0>
    <select name=portprovider_id>
");

  if ($portprovider_id=='')
    {
    print "<option value selected>bitte ausw&auml;hlen</option>\n";
    }
  $query="select * from dslprov_portprovider";
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
         if ($portprovider_id==$value)
           {
           $sel=" selected";
           }
           
         }
       if ($j==1)
         {
         if ($tvalue!=2)  //CEASE
           {
           print "<option value=$tvalue$sel>$value</option>\n";
           }
         }
       $j++;
       }
     }


echo("
    </select>
    NUR TEST! AWA hochladen (max. 1MB): 
    <input name=upfile type=file size=50 maxlength=1048576 accept=text/*>
    <br><br>
    <table border=0><tr><td>
    ONKZ</td><td> <input name=vc_port_onkz value='$vc_port_onkz' size=10>
    </td><td>
    N1</td><td> <input name=vc_port_n1 value='$vc_port_n1' size=10>
    </td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td colspan=6>&nbsp;</td></tr><tr><td>
    N2</td><td> <input name=vc_port_n2 value='$vc_port_n2' size=10>
    </td><td>
    N3</td><td> <input name=vc_port_n3 value='$vc_port_n3' size=10>
    </td><td>
    N4</td><td> <input name=vc_port_n4 value='$vc_port_n4' size=10>
    </td></tr><tr><td>
    N5</td><td> <input name=vc_port_n5 value='$vc_port_n5' size=10>
    </td><td>
    N6</td><td> <input name=vc_port_n6 value='$vc_port_n6' size=10>
    </td><td>
    N7</td><td> <input name=vc_port_n7 value='$vc_port_n7' size=10>
    </td></tr><tr><td>
    N8</td><td> <input name=vc_port_n8 value='$vc_port_n8' size=10>
    </td><td>
    N9</td><td> <input name=vc_port_n9 value='$vc_port_n9' size=10>
    </td><td>
    N10</td><td> <input name=vc_port_n10 value='$vc_port_n10' size=10>
    </td></tr></table>
    </td>
  </tr>


  <tr>
    <td bgcolor=$tcolor0>Ordertyp</td>
    <td bgcolor=$tcolor0>
    <select name=btuserordertype_id>
");


  $query="select * from dslprov_ordertype";
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
         if ($btuserordertype_id==$value)
           {
           $sel=" selected";
           }
         }
       if ($j==1)
         {
         if ($tvalue!=2)  //CEASE
           {
           print "<option value=$tvalue$sel>$value</option>\n";
           }
         }
       $j++;
       }
     }


echo("
    </select>
    </td>
    <td bgcolor=$tcolor0></td>
  </tr>
  <tr>
    <td colspan=2><center><br><br>
    <input type=submit value='Order' name=formtype>
    </center> 
   </td>
  </tr>
</table>
</form>
</center>
");

$vc_confirmations='11111';
$sur = substr($vc_surname, 0, 1); 
$first = substr($vc_firstname, 0, 1);
$vc_initials=strtoupper($first.$sur);

$vc_btaccountcode='';
$vc_visprefnum='';
$vc_resellernotes='';

  }
else
  { 
  include("vcedit_upgrade.php");
  }
?>
