<?php
$write=1;
if ((($action=='vcorder')||($action=='vcorderform')||($action=='vcupgrade')||($action=='vcupgradeconfirm'))&&($write==1))
  {
  $newaction='vcorder';
if ($action=='vcupgradeconfirm')
  {
  $newaction='vcupgradeconfirm';
  }
// date("d.m.y H:i",$time)
if ($vc_reqdeliverydate=='')
  {
//  get_leadtimes($vc_leadtime,$vp_leadtime);
//  $vc_reqdeliverydate=time()+$vc_leadtime;
//  $vc_reqdeliverydate=get_isodate($vc_reqdeliverydate);
  }


if ($action=='vcupgrade')
  {
  $newaction='vcupgradeconfirm';
  $query="select * from dslprov_vc where vc_id LIKE '$vc_id'";
// echo("xxx $vc_id");
  $vcupgradeid=$vc_id;
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  $rowarray=mysql_fetch_array($result);


  $visp_id=$rowarray['visp_id'];
  $vc_migkey=$rowarray['vc_migkey'];

  $product_id=$rowarray['product_id'];
  $productadditional_id=$rowarray['productadditional_id'];

  $gee_id=$rowarray['gee_id'];

  $location_id=$rowarray['loc_id'];
  $vc_visprefnum=$rowarray['vc_visprefnum'];
  $vc_salutation=$rowarray['vc_salutation'];
  $vc_title=$rowarray['vc_title'];
  $vc_company=$rowarray['vc_company'];
  $vc_surname=$rowarray['vc_surname'];
  $vc_firstname=$rowarray['vc_firstname'];
  $vc_birthday=$rowarray['birthday'];
  $vc_houseno=$rowarray['vc_houseno'];
  $vc_street=$rowarray['vc_street'];
  $vc_city=$rowarray['vc_city'];
  $vc_city_subloc=$rowarray['vc_city_subloc'];
  $vc_postcode=$rowarray['vc_postcode'];
  $vc_conn_salutation=$rowarray['vc_conn_salutation'];
  $vc_conn_title=$rowarray['vc_conn_title'];
  $vc_conn_company=$rowarray['vc_conn_company'];
  $vc_conn_surname=$rowarray['vc_conn_surname'];
  $vc_conn_firstname=$rowarray['vc_conn_firstname'];
  $vc_conn_birthday=$rowarray['birthday'];
  $vc_conn_houseno=$rowarray['vc_conn_houseno'];
  $vc_conn_street=$rowarray['vc_conn_street'];
  $vc_conn_city=$rowarray['vc_conn_city'];
  $vc_conn_city_subloc=$rowarray['vc_conn_city_subloc'];
  $vc_conn_postcode=$rowarray['vc_conn_postcode'];
  $vc_conn_contact=$rowarray['vc_conn_contact'];
  $vc_conn_contactfirstname=$rowarray['vc_conn_contactfirstname'];
  $vc_contact=$rowarray['vc_contact'];
  $vc_contactfirstname=$rowarray['vc_contactfirstname'];

  $vc_conn_contactphonepre=$rowarray['vc_conn_contactphonepre'];
  $vc_conn_contactphone=$rowarray['vc_conn_contactphone'];
  $vc_contactphonepre=$rowarray['vc_contactphonepre'];
  $vc_contactphone=$rowarray['vc_contactphone'];

  $vc_orderdate=$rowarray['vc_orderdate'];
  $xvc_reqdeliverydate=$rowarray['vc_reqdeliverydate'];
  $xvc_reqdeliverydate_voice=$rowarray['vc_reqdeliverydate_voice'];
if ($xvc_reqdeliverydate==0)
  {
  $vc_reqdeliverydate='';
  }
else 
  {
  $vc_reqdeliverydate=get_isodate_f($xvc_reqdeliverydate);
  }  
if ($xvc_reqdeliverydate_voice==0)
  {
  $vc_reqdeliverydate_voice='';
  }
else 
  {
  $vc_reqdeliverydate_voice=get_isodate_f($xvc_reqdeliverydate_voice);
  }  

  $vc_productiondate=$rowarray['vc_productiondate'];
  $vc_notes=$rowarray['vc_notes'];
  $vc_resellernotes=$rowarray['vc_resellernotes'];
  $vc_carelevel=$rowarray['vc_carelevel'];
  $userbw_id=$rowarray['userbw_id'];
  $usercr_id=$rowarray['usercr_id'];
  $userrealm_id=$rowarray['userrealm_id'];
  $vc_cbuk=$rowarray['vc_cbuk'];
  $vc_taefiber=$rowarray['vc_taefiber'];
  $vc_email=$rowarray['vc_email'];
  $invoicemail_id=$rowarray['invoicemail_id'];
  $evn_id=$rowarray['evn_id'];
  $hardware_id=$rowarray['hardware_id'];
  $telregister_id=$rowarray['telregister_id'];
  $telregistertype_id=$rowarray['telregistertype_id'];
  $vc_comments=$rowarray['vc_comments'];
  $vc_bankname=$rowarray['vc_bankname'];
  $vc_bankaccholder=$rowarray['vc_bankaccholder'];
  $vc_bankaccnumber=$rowarray['vc_bankaccnumber'];
  $vc_banksortcode=$rowarray['vc_banksortcode'];
  $vc_bankiban=$rowarray['vc_bankiban'];
  $vc_bankbic=$rowarray['vc_bankbic'];
  $portprovider_id=$rowarray['portprovider_id'];
  $vc_port_onkz=$rowarray['vc_port_onkz'];
  $vc_port_n1=$rowarray['vc_port_n1'];
  $vc_port_n2=$rowarray['vc_port_n2'];
  $vc_port_n3=$rowarray['vc_port_n3'];
  $vc_port_n4=$rowarray['vc_port_n4'];
  $vc_port_n5=$rowarray['vc_port_n5'];
  $vc_port_n6=$rowarray['vc_port_n6'];
  $vc_port_n7=$rowarray['vc_port_n7'];
  $vc_port_n8=$rowarray['vc_port_n8'];
  $vc_port_n9=$rowarray['vc_port_n9'];
  $vc_port_n10=$rowarray['vc_port_n10'];
  
  $vc_state=$rowarray['vc_state'];
  echo("xxx $vc_state");

  // NEU 11.18
  $vc_housetype=$rowarray['vc_housetype'];
  $foreign_customer_id=$rowarray['foreign_customer_id'];
  $vc_bankaccholderpre=$rowarray['vc_bankaccholderpre'];
  $vc_bankaccholderstr=$rowarray['vc_bankaccholderstr'];
  $vc_bankaccholdernr=$rowarray['vc_bankaccholdernr'];
  $vc_bankaccholderzip=$rowarray['vc_bankaccholderzip'];
  $vc_bankaccholdercity=$rowarray['vc_bankaccholdercity'];
  $vc_check_sepa=$rowarray['vc_check_sepa'];
  $vc_check_agb=$rowarray['vc_check_agb'];
  $vc_check_widerruf=$rowarray['vc_check_widerruf'];
  $vc_check_schufa=$rowarray['vc_check_schufa'];
  $vc_check_optintel=$rowarray['vc_check_optintel'];
  $vc_check_optinemail=$rowarray['vc_check_optinemail'];
  $vc_check_optinmail=$rowarray['vc_check_optinmail'];
  $gee_owner_name=$rowarray['gee_owner_name'];
  $gee_contact_company=$rowarray['gee_contact_company'];
  $gee_contact_name=$rowarray['gee_contact_name'];
  $gee_contact_str=$rowarray['gee_contact_str'];
  $gee_contact_zip=$rowarray['gee_contact_zip'];
  $gee_contact_city=$rowarray['gee_contact_city'];
  $gee_contact_tel=$rowarray['gee_contact_tel'];
  $gee_contact_email=$rowarray['gee_contact_email'];
  $gee_flur=$rowarray['gee_flur'];
  $vc_docname_contract=$rowarray['vc_docname_contract'];
  $vc_docname_awa=$rowarray['vc_docname_awa'];
  $vc_docname_gee=$rowarray['vc_docname_gee'];

  $vc_tbname=$rowarray['vc_tbname'];
  $vc_tbfirstname=$rowarray['vc_tbfirstname'];
  $vc_tbwiderspruch=$rowarray['vc_tbwiderspruch'];

  $vc_billingtype=$rowarray['vc_billingtype'];
  $vc_contact_email=$rowarray['vc_contact_email'];









  }

  
  

if (($action!='vcorder')&&($action!='vcupgradeconfirm'))
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
$c_vc_housetype=$tcolor1;
$c_foreign_customer_id=$tcolor0;
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
$c_vc_bankaccholderpre=$tcolor0;
$c_vc_bankaccholderstr=$tcolor1;
$c_vc_bankaccholdernr=$tcolor0;
$c_vc_bankaccholderzip=$tcolor1;
$c_vc_bankaccholdercity=$tcolor0;
$c_vc_check_sepa=$tcolor1;
$c_vc_check_agb=$tcolor0;
$c_vc_check_widerruf=$tcolor1;
$c_vc_check_schufa=$tcolor0;
$c_vc_check_optintel=$tcolor1;
$c_vc_check_optinemail=$tcolor0;
$c_vc_check_optinmail=$tcolor1;
$c_gee_owner_name=$tcolor0;
$c_gee_contact_company=$tcolor1;
$c_gee_contact_name=$tcolor0;
$c_gee_contact_str=$tcolor1;
$c_gee_contact_zip=$tcolor0;
$c_gee_contact_city=$tcolor1;
$c_gee_contact_tel=$tcolor0;
$c_gee_contact_email=$tcolor1;
$c_gee_flur=$tcolor0;
$c_vc_docname_contract=$tcolor1;
$c_vc_docname_awa=$tcolor0;
$c_vc_docname_gee=$tcolor1;
$c_vc_tbname=$tcolor1;
$c_vc_tbfirstname=$tcolor0;
$c_vc_tbwiderspruch=$tcolor1;
$c_vc_contact_email=$tcolor0;



  }


if ($vc_state>41)
  {
  echo("NO EDIT - ORDER IN PROCESS");
  }
else
  {

$str_automatisch='';
if ($vc_visprefnum == '')
  {
  $vc_state=20;
  $str_automatisch="wird automatisch erzeugt";
  }


echo("

<center>
<FORM method=GET>
<input type=hidden name=page value=3>
<input type=hidden name=action value=$newaction>
<input type=hidden name=vc_id value=$vc_id>
<input type=hidden name=vc_visprefnum value=$vc_visprefnum>
<input type=hidden name=vc_state value=$vc_state>
<input type=hidden name=usercr_id value=1>
<table border=0>
  <tr>
    <td bgcolor=$tcolor0><b>Auftragsnummer</b><br>&nbsp;</td>
    <td bgcolor=$tcolor0>$str_automatisch $vc_visprefnum<br>&nbsp;</td>
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
    <td bgcolor=$c_evn_id>Grundstueckseigentuemergenehmigung</td>
    <td bgcolor=$tcolor0>
       <select name=gee_id>
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
         if ($gee_id==$value)
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
    <td bgcolor=$tcolor0>Partner ID
       <select name=visp_id>
       <option value=0 selected>---</option>
");


  $query="select visp_id,visp_name from dslprov_visp";
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
         if ($visp_id==$value)
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
    <td bgcolor=$c_evn_id>Nachverdichtung NVD</td>
    <td bgcolor=$tcolor0>
       <select name=vc_migkey>
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
         if ($vc_migkey==$value)
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
else if ($vc_conn_salutation=='Frau und Herr') { $selvcctfh='selected'; } 
else if ($vc_conn_salutation=='Familie') { $selvcctfam='selected'; } 
else { $selvcctno='selected'; }    
     
echo("              
       <option value $selvcctno>bitte ausw&auml;hlen</option>
       <option value=Herr $selvccthr>Herr</option>
       <option value=Frau $selvcctfr>Frau</option>
       <option value=Firma $selvcctfa>Firma</option>
       <option value=Frau_und_Herr $selvcctfh>Frau und Herr</option>       
       <option value=Familie $selvcctfam>Familie</option>       
       </select>
    </td>
    <td bgcolor=$tcolor0>
      <select name=vc_salutation>
     ");
     
if ($vc_salutation=='Herr') { $selvcthr='selected'; }
else if ($vc_salutation=='Frau') { $selvctfr='selected'; }
else if ($vc_salutation=='Firma') { $selvctfa='selected'; } 
else if ($vc_salutation=='Frau und Herr') { $selvctfh='selected'; } 
else if ($vc_salutation=='Familie') { $selvctfam='selected'; } 
else { $selvctno='selected'; }    
     
echo("              
       <option value $selvctno>bitte ausw&auml;hlen</option>
       <option value=Herr $selvcthr>Herr</option>
       <option value=Frau $selvctfr>Frau</option>
       <option value=Firma $selvctfa>Firma</option>
       <option value=Frau_und_Herr $selvctfh>Frau und Herr</option>
       <option value=Familie $selvctfam>Familie</option>
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
    <td bgcolor=$c_vc_surname>* Nachname / Ansprechpartner NN oder XXX bei Firma</td>
    <td bgcolor=$tcolor1><input name=vc_conn_surname value='$vc_conn_surname' size=32></td>
    <td bgcolor=$tcolor1><input name=vc_surname value='$vc_surname' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_firstname>* Vorname / Ansprechpartner VN oder XXX bei Firma</td>
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
  $query="select location_id,location_long from dslprov_locations order by location_long;";
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
    <td bgcolor=$c_vc_housetype>Haustyp</td>
    <td bgcolor=$tcolor1>
       <select name=vc_housetype>
     ");
     
if ($vc_housetype=='Einfamilienhaus') { $selvcctefh='selected'; }
else if ($vc_housetype=='Mehrfamilienhaus') { $selvcctmfh='selected'; }
else { $selvccthno='selected'; }    
     
echo("              
       <option value $selvccthno>bitte ausw&auml;hlen</option>
       <option value=Einfamilienhaus $selvcctefh>Einfamilienhaus</option>
       <option value=Mehrfamilienhaus $selvcctmfh>Mehrfamilienhaus</option>
       </select>
    </td>
    <td bgcolor=$tcolor1>
    </td>                                       
  </tr>                
  
  <tr>
    <td bgcolor=$c_foreign_customer_id>vorh. Kundennummer z.B. Strom/Gas</td>
    <td bgcolor=$tcolor0><input name=foreign_customer_id value='$foreign_customer_id' size=32></td>
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
    <td bgcolor=$c_vc_contact_email>email Adresse Kontakt (opt.)</td>
    <td bgcolor=$tcolor0><input name=vc_contact_email value='$vc_contact_email' size=32></td>
    <td bgcolor=$tcolor0></td>
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
    <td bgcolor=$c_vc_tbname>Telefonbuch Name</td>
    <td bgcolor=$tcolor1><input name=vc_tbname value='$vc_tbname' size=32></td>
    <td bgcolor=$tcolor1></td>    
  </tr>
  <tr>
    <td bgcolor=$c_vc_tbfirstname>Telefonbuch Vorname</td>
    <td bgcolor=$tcolor0><input name=vc_tbfirstname value='$vc_tbfirstname' size=32></td>
    <td bgcolor=$tcolor0></td>    
  </tr>

  <tr>
    <td bgcolor=$c_vc_tbwiderspruch>TB Widerspruch Inverssuche</td>
    <td bgcolor=$tcolor1>
       <select name=vc_tbwiderspruch>
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
         if ($vc_tbwiderspruch==$value)
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
    <td bgcolor=$tcolor0>Sonderzeichen wie Umlaute umschreiben</td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_bankaccholderpre>Kontoinhaber Vorname</td>
    <td bgcolor=$tcolor1><input name=vc_bankaccholderpre value='$vc_bankaccholderpre' size=32></td>
    <td bgcolor=$tcolor1>Sonderzeichen wie Umlaute umschreiben</td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_bankaccholderstr>Kontoinhaber Strasse</td>
    <td bgcolor=$tcolor0><input name=vc_bankaccholderstr value='$vc_bankaccholderstr' size=32></td>
    <td bgcolor=$tcolor0></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_bankaccholdernr>Kontoinhaber Hausnummer</td>
    <td bgcolor=$tcolor1><input name=vc_bankaccholdernr value='$vc_bankaccholdernr' size=32></td>
    <td bgcolor=$tcolor1></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_bankaccholderzip>Kontoinhaber PLZ</td>
    <td bgcolor=$tcolor0><input name=vc_bankaccholderzip value='$vc_bankaccholderzip' size=32></td>
    <td bgcolor=$tcolor0></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_bankaccholdercity>Kontoinhaber Ort</td>
    <td bgcolor=$tcolor1><input name=vc_bankaccholdercity value='$vc_bankaccholdercity' size=32></td>
    <td bgcolor=$tcolor1></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_bankaccnumber>Kontonummer</td>
    <td bgcolor=$tcolor0><input name=vc_bankaccnumber value='$vc_bankaccnumber' size=32></td>
    <td bgcolor=$tcolor0></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_banksortcode>Bankleitzahl</td>
    <td bgcolor=$tcolor1><input name=vc_banksortcode value='$vc_banksortcode' size=32></td>
    <td bgcolor=$tcolor1></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_bankiban>IBAN</td>
    <td bgcolor=$tcolor0><input name=vc_bankiban value='$vc_bankiban' size=32></td>
    <td bgcolor=$tcolor0>Zahlungsart: 
      <select name=vc_billingtype>
     ");
     
if ($vc_billingtype=='DEBIT') { $selvcdeb='selected'; }
else if ($vc_billingtype=='INVOICE') { $selvcinv='selected'; }
     

echo("              
       <option value=DEBIT $selvcdeb>SEPA LS</option>
       <option value=INVOICE $selvcinv>RECHNUNG</option>
      </select>
    </td>                                       

  </tr>
");


$innogy=1;
// ALTER INNOGY BLOCK
if ($innogy==1)
  {


echo("

  <tr>
    <td bgcolor=$c_vc_check_sepa>SEPA Unterschrift vorhanden</td>
    <td bgcolor=$tcolor1>
       <select name=vc_check_sepa>
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
         if ($vc_check_sepa==$value)
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
    <td bgcolor=$c_vc_check_agb>Vertrag AGB Unterschrift vorhanden</td>
    <td bgcolor=$tcolor0>
       <select name=vc_check_agb>
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
         if ($vc_check_agb==$value)
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
    <td bgcolor=$c_vc_check_widerruf>Vertrag Widerruf Unterschrift vorhanden</td>
    <td bgcolor=$tcolor1>
       <select name=vc_check_widerruf>
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
         if ($vc_check_widerruf==$value)
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
    <td bgcolor=$c_vc_check_schufa>Schufa Einwilligung vorhanden</td>
    <td bgcolor=$tcolor0>
       <select name=vc_check_schufa>
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
         if ($vc_check_schufa==$value)
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
    <td bgcolor=$c_vc_check_optintel>Optin Kontakt telefonisch</td>
    <td bgcolor=$tcolor1>
       <select name=vc_check_optintel>
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
         if ($vc_check_optintel==$value)
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
    <td bgcolor=$c_vc_check_optinemail>Optin Kontakt Email</td>
    <td bgcolor=$tcolor0>
       <select name=vc_check_optinemail>
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
         if ($vc_check_optinemail==$value)
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
    <td bgcolor=$c_vc_check_optinmail>Optin Kontakt Post</td>
    <td bgcolor=$tcolor1>
       <select name=vc_check_optinmail>
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
         if ($vc_check_optinmail==$value)
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
    <td bgcolor=$c_gee_owner_name>GEE Eigent&uuml;mer</td>
    <td bgcolor=$tcolor0><input name=gee_owner_name value='$gee_owner_name' size=32></td>                                                                                 
    <td bgcolor=$tcolor0></td>
  </tr>
  <tr>
    <td bgcolor=$c_gee_contact_company>GEE Kontakt Firma</td>
    <td bgcolor=$tcolor1><input name=gee_contact_company value='$gee_contact_company' size=32></td>
    <td bgcolor=$tcolor1></td>
  </tr>
  <tr>
    <td bgcolor=$c_gee_contact_name>GEE Kontakt Name</td>
    <td bgcolor=$tcolor0><input name=gee_contact_name value='$gee_contact_name' size=32></td>
    <td bgcolor=$tcolor0></td>
  </tr>
  <tr>
    <td bgcolor=$c_gee_contact_str>GEE Kontakt Strasse Hausnummer</td>
    <td bgcolor=$tcolor1><input name=gee_contact_str value='$gee_contact_str' size=32></td>
    <td bgcolor=$tcolor1></td>
  </tr>
  <tr>
    <td bgcolor=$c_gee_contact_zip>GEE Kontakt PLZ</td>
    <td bgcolor=$tcolor0><input name=gee_contact_zip value='$gee_contact_zip' size=32></td>
    <td bgcolor=$tcolor0></td>
  </tr>
  <tr>
    <td bgcolor=$c_gee_contact_city>GEE Kontakt Ort</td>
    <td bgcolor=$tcolor1><input name=gee_contact_city value='$gee_contact_city' size=32></td>
    <td bgcolor=$tcolor1></td>
  </tr>
  <tr>
    <td bgcolor=$c_gee_contact_tel>GEE Kontakt Telefon</td>
    <td bgcolor=$tcolor0><input name=gee_contact_tel value='$gee_contact_tel' size=32></td>
    <td bgcolor=$tcolor0></td>
  </tr>
  <tr>
    <td bgcolor=$c_gee_contact_email>GEE Kontakt Email</td>
    <td bgcolor=$tcolor1><input name=gee_contact_email value='$gee_contact_email' size=32></td>
    <td bgcolor=$tcolor1></td>
  </tr>
  <tr>
    <td bgcolor=$c_gee_flur>GEE Flur</td>
    <td bgcolor=$tcolor0><input name=gee_flur value='$gee_flur' size=32></td>
    <td bgcolor=$tcolor0></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_docname_contract>Filename Vertrag</td>
    <td bgcolor=$tcolor1><input name=vc_docname_contract value='$vc_docname_contract' size=32></td>
    <td bgcolor=$tcolor1></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_docname_awa>Filename AWA</td>
    <td bgcolor=$tcolor0><input name=vc_docname_awa value='$vc_docname_awa' size=32></td>
    <td bgcolor=$tcolor0></td>
  </tr>
  <tr>
    <td bgcolor=$c_vc_docname_gee>Filename GEE</td>
    <td bgcolor=$tcolor1><input name=vc_docname_gee value='$vc_docname_gee' size=32></td>
    <td bgcolor=$tcolor1></td>
  </tr>

");


} // Innogy


echo("  
  
  
  <tr>
    <td bgcolor=$c_vc_port>abgebender (bisheriger) Provider/Carrier<br>zu portierende Rufnummer(n)<br><b>nur ausf&uuml;llen bei Rufnummernmitnahme<br>(Anbieterwechselauftrag)!</b></td>
    <td colspan=2 bgcolor=$tcolor0>
    <select name=portprovider_id>
");

  if ($portprovider_id=='')
    {
    print "<option value selected>bitte ausw&auml;hlen</option>\n";
    }
  $query="select * from dslprov_portprovider order by portprovider_id";
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
    </form>
    ");


if (($vc_state<23)&&($action == 'vcupgrade'))
  {
  $cancelaction='cancel';
  $cancelsubmit='Storno';
  if ($vc_state!=5)
    {
echo("    
<br><br><br><br>
<FORM method=GET>
<input type=hidden name=page value=3>
<input type=hidden name=action value=$cancelaction>
<input type=hidden name=vc_id value=$vc_id>
<input type=hidden name=vc_visprefnum value=$vc_visprefnum>
<input type=hidden name=vc_state value=$vc_state>
<input type=hidden name=usercr_id value=1>
    <input type=submit value=$cancelsubmit name=formtype>
    </form>
    ");
    }
  }

if ((($vc_state==30)||($vc_state==31))&&($action == 'vcupgrade'))
  {
  $naction='terminate';
  $nsubmit='Kündigung';
  
//  $actdate= new DateTime('2000-01-01');
//  $canceldate=$actdate->format('Y-m-d H:i:s');
$canceldate=date('d.m.Y', strtotime('+10 days'));


echo("    
<br><br><br><br>
<FORM method=GET>
<input type=hidden name=page value=3>
<input type=hidden name=action value=$naction>
<input type=hidden name=vc_id value=$vc_id>
<input type=hidden name=vc_visprefnum value=$vc_visprefnum>
<input type=hidden name=vc_state value=$vc_state>
<input type=hidden name=usercr_id value=1>
K&uuml;ndigung zum: <input name=setcanceldate value='$canceldate' size=10><br>
    <input type=submit value=$nsubmit name=formtype>
    </form>
    ");
  }


if ((($vc_state==30)||($vc_state==31))&&($action == 'vcupgrade'))
  {
  $naction='productchange';
  $nsubmit='Produktwechsel';

$pchangedate=date('d.m.Y', strtotime('first day of next month'));

echo("    
<br>
<FORM method=GET>
<input type=hidden name=page value=3>
<input type=hidden name=action value=$naction>
<input type=hidden name=vc_id value=$vc_id>
<input type=hidden name=vc_visprefnum value=$vc_visprefnum>
<input type=hidden name=vc_state value=$vc_state>
<input type=hidden name=product_id value=$product_id>
<input type=hidden name=usercr_id value=1>
Produktwechsel zum: <input name=setpchangedate value='$pchangedate' size=10> auf 
    <select name=product_id_change>
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
    </select><br>

    <input type=submit value=$nsubmit name=formtype>
    </form>
    ");
  }




echo("
    </center> 
   </td>
  </tr>
</table>
</center>
");

$vc_confirmations='11111';
$sur = substr($vc_surname, 0, 1); 
$first = substr($vc_firstname, 0, 1);
$vc_initials=strtoupper($first.$sur);

$vc_btaccountcode='';
$vc_visprefnum='';
$vc_resellernotes='';


  }  // if vc_state

  }
else
  { 
  include("vcedit_upgrade.php");
  }




?>
