<?php

$serdatum=get_sertime("2017-11-27");
print $serdatum;

// dates checken

//$output = shell_exec('/home/crm/bin/vcn_availcheck.pl');

echo "<pre>$output</pre>";

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

$alertcolor=orange;


$errormessage="Keine oder falsche Eingabe im Feld ";
$errormessagetwo="Falscher Eintrag in ";
      $ordererror=0;

if ($checkmode=='vc')
  {
     get_leadtimes($vc_leadtime,$vp_leadtime);
     $vc_reqdeliverydate_checktime_new=get_sertime(get_isodate(time()+$vc_leadtime))-1;
     $vc_reqdeliverydate_checktime_port=get_sertime(get_isodate(time()+$vp_leadtime))-1;
      
     $vc_reqdeliverydateser=get_sertime($vc_reqdeliverydate);
     if ($vc_reqdeliverydateser<$vc_reqdeliverydate_checktime_new)
       {
       if (strlen($vc_reqdeliverydate)>0)
       //echo("NOK N $vc_reqdeliverydate_checktime_new P $vc_reqdeliverydate_checktime_port REQ $vc_reqdeliverydateser");
         {
         $c_vc_reqdeliverydate=$alertcolor;
         }
       }
      // $vc_reqdeliverydate=get_isodate($vc_reqdeliverydate);
      //echo("x $vc_leadtime $vp_leadtime x");

      if(checktext($product_id,"Produkt",6)) {$ordererror++; $c_product_id=$alertcolor;}
      if(checktext($productadditional_id,"Zusatzprodukt",11)) {$ordererror++; $c_product_id=$alertcolor;}
      if(checktext($productcap_id,"CAP Vorprodukt",11)) {$ordererror++; $c_productcap_id=$alertcolor;}

      if(checktext($vc_conn_salutation,"Anrede",1002)) {$ordererror++; $c_vc_salutation=$alertcolor;}
      if(checktext($vc_conn_title,"Titel",2)) {$ordererror++; $c_vc_title=$alertcolor;}
      if(checktext($vc_conn_company,"Firma",22)) {$ordererror++; $c_vc_company=$alertcolor;}
      if (checktext($vc_conn_surname,"Nachname / Ansprechpartner",1)) {$ordererror++;$c_vc_surname=$alertcolor;}
      if(checktext($vc_conn_firstname,"Vorname / Ansprechpartner",1)) {$ordererror++; $c_vc_firstname=$alertcolor;}
      if(checktext($vc_conn_birthday,"Geburtsdatum",10)) {$ordererror++; $c_vc_birthday=$alertcolor;}
      if(checktext($vc_conn_street,"Strasse",1)) {$ordererror++; $c_vc_street=$alertcolor;}
      if(checktext($vc_conn_houseno,"Hausnr.",31)) {$ordererror++; $c_vc_houseno=$alertcolor;}

//      if(checktext($vc_conn_city,"Ort",1)) {$ordererror++; $c_vc_city=$alertcolor;}
//      if(checktext($vc_conn_citysubloc,"Ortsteil",2)) {$ordererror++; $c_vc_city=$alertcolor;}
//      if(checktext($vc_conn_postcode,"PLZ",3)) {$ordererror++; $c_vc_postcode=$alertcolor;}
// NEU
      if(checktext($location_id,"Ort-Ortsteil-PLZ",31)) {$ordererror++; $c_vc_postcode=$alertcolor; $c_vc_city=$alertcolor;}


      if ((strlen($vc_conn_contact)>0)||(strlen($vc_conn_contactfirstname)>0))
        {
        if(checktext($vc_conn_contactfirstname,"Ansprechpartner Vorname",1)) {$ordererror++; $c_vc_contact=$alertcolor;}
        if(checktext($vc_conn_contact,"Ansprechpartner Nachname",1)) {$ordererror++; $c_vc_contact=$alertcolor;}
        }
      else
        {  
        if(checktext($vc_conn_contactfirstname,"Ansprechpartner Vorname",2)) {$ordererror++; $c_vc_contact=$alertcolor;}
        if(checktext($vc_conn_contact,"Ansprechpartner Nachname",2)) {$ordererror++; $c_vc_contact=$alertcolor;}
        }
      if(checktext($vc_conn_contactphonepre,"AP Vorwahl",9)) {$ordererror++; $c_vc_contactphone=$alertcolor;}
      if(checktext($vc_conn_contactphone,"AP Rufnummer",14)) {$ordererror++; $c_vc_contactphone=$alertcolor;}

   if ((strlen($vc_salutation)>0)||(strlen($vc_title)>0)||(strlen($vc_company)>0)||(strlen($vc_surname)>0)||(strlen($vc_firstname)>0)||(strlen($vc_birthday)>0)||(strlen($vc_street)>0)||(strlen($vc_houseno)>0)||(strlen($vc_city)>0)||(strlen($vc_citysubloc)>0)||(strlen($vc_postcode)>0)||(strlen($vc_contactfirstname)>0)||(strlen($vc_contact)>0)||(strlen($vc_contactphonepre)>0)||(strlen($vc_contactphone)>0))
      {
      echo("AGundRE   ");
      if(checktext($vc_salutation,"abw Anrede",1002)) {$ordererror++; $c_vc_salutation=$alertcolor;}
      if(checktext($vc_title,"abw Titel",2)) {$ordererror++; $c_vc_title=$alertcolor;}
      if(checktext($vc_company,"Firma",22)) {$ordererror++; $c_vc_company=$alertcolor;}
      if(checktext($vc_surname,"abw Nachname / Ansprechpartner",1)) {$ordererror++; $c_vc_surname=$alertcolor;}
      if(checktext($vc_firstname,"abw Vorname / Ansprechpartner",1)) {$ordererror++; $c_vc_firstname=$alertcolor;}
      if(checktext($vc_birthday,"abw Geburtsdatum",10)) {$ordererror++; $c_vc_birthday=$alertcolor;}
      if(checktext($vc_street,"abwStrasse",1)) {$ordererror++; $c_vc_street=$alertcolor;}
      if(checktext($vc_houseno,"abw Hausnr.",31)) {$ordererror++; $c_vc_houseno=$alertcolor;}
      if(checktext($vc_city,"abw Ort",1)) {$ordererror++; $c_vc_city=$alertcolor;}
      if(checktext($vc_citysubloc,"abw Ortsteil",2)) {$ordererror++; $c_vc_city=$alertcolor;}
      if(checktext($vc_postcode,"abw PLZ",3)) {$ordererror++; $c_vc_postcode=$alertcolor;}
      if ((strlen($vc_contact)>0)||(strlen($vc_contactfirstname)>0))
        {
        if(checktext($vc_contactfirstname,"abw Ansprechpartner Vorname",1)) {$ordererror++; $c_vc_contact=$alertcolor;}
        if(checktext($vc_contact,"abw Ansprechpartner Nachname",1)) {$ordererror++; $c_vc_contact=$alertcolor;}
        }
      else
        {
        if(checktext($vc_contactfirstname,"abw Ansprechpartner Vorname",2)) {$ordererror++; $c_vc_contact=$alertcolor;}
        if(checktext($vc_contact,"abw Ansprechpartner Nachname",2)) {$ordererror++; $c_vc_contact=$alertcolor;}
        }
      if(checktext($vc_contactphonepre,"abw AP Vorwahl",9)) {$ordererror++; $c_vc_contactphone=$alertcolor;}
      if(checktext($vc_contactphone,"abw AP Rufnummer",14)) {$ordererror++; $c_vc_contactphone=$alertcolor;}
      }
   else
      {
      $noagredata=1;
      }   
      
      if(checktext($vc_reqdeliverydate,"Terminwunsch",7)) {$ordererror++; $c_vc_reqdeliverydate=$alertcolor;}
      if(checktext($vc_reqdeliverydate_voice,"Terminwunsch Telefonie",10)) {$ordererror++; $c_vc_reqdeliverydate=$alertcolor;}
//      if(checktext($vc_taefiber,"TAE Fiberabschluss",21)) {$ordererror++; $c_vc_taefiber=$alertcolor;}
      
      if ((strlen($vc_email)>0))
        {
//        if(checktext($vc_email,"email Adresse",13)) {$ordererror++; $c_vc_email=$alertcolor;}
        }
      if(checktext($invoicemail_id,"Rechnung per Post",11)) {$ordererror++; $c_vc_email=$alertcolor;}

      if ((strlen($vc_email)==0)&&($invoicemail_id!=1))
        {
 //       $ordererror++; $c_vc_email=$alertcolor;
        }

      if(checktext($evn_id,"Einzelverbindungsnachweis",11)) {$ordererror++; $c_evn_id=$alertcolor;}
      if(checktext($hardware_id,"Hardware Mitbestellung",11)) {$ordererror++; $c_hardware_id=$alertcolor;}
      if(checktext($telregister_id,"Telefonbucheintrag",11)) {$ordererror++; $c_telregister_id=$alertcolor;}
      if(checktext($telregistertype_id,"Telefonbucheintrag Typ",11)) {$ordererror++; $c_telregister_id=$alertcolor;}
      if(checktext($vc_comments,"Bemerkungen",122)) {$ordererror++; $c_vc_comments=$alertcolor;}

//      if(checktext($vc_bankname,"Geldinstitut",1)) {$ordererror++; $c_vc_bankname=$alertcolor;}
//      if(checktext($vc_bankaccholder,"Kontoinhaber",1001)) {$ordererror++; $c_vc_bankaccholder=$alertcolor;}

      $checkiban=0;
      if (((strlen($vc_bankiban)>0))&&((strlen($vc_bankaccnumber)==0)&&(strlen($vc_banksortcode)==0)))
        {
        $checkiban=1;
//        if(checktext($vc_bankiban,"IBAN",8)) {$ordererror++; $c_vc_bankiban=$alertcolor;}
        }
      else
      //if ((strlen($vc_bankaccnumber)>0)||(strlen($vc_banksortcode)>0))
        {
//        if(checktext($vc_bankaccnumber,"Kontonummer",4)) {$ordererror++; $c_vc_bankaccnumber=$alertcolor;}
//        if(checktext($vc_banksortcode,"Bankleitzahl",5)) {$ordererror++; $c_vc_banksortcode=$alertcolor;}
        }

   if ((strlen($portprovider_id)>0)||(strlen($vc_port_onkz)>0)||(strlen($vc_port_n1)>0)||(strlen($vc_port_n2)>0)||(strlen($vc_port_n3)>0)||(strlen($vc_port_n4)>0)||(strlen($vc_port_n5)>0)||(strlen($vc_port_n6)>0)||(strlen($vc_port_n7)>0)||(strlen($vc_port_n8)>0)||(strlen($vc_port_n9)>0)||(strlen($vc_port_n10)>0))
      {
        //echo("PORT   ");
 //     if(checktext($portprovider_id,"Port Provider",21)) {$ordererror++; $c_vc_port=$alertcolor;}
 //     if(checktext($vc_port_onkz,"ONKZ",9)) {$ordererror++; $c_vc_port=$alertcolor;}
 //     if(checktext($vc_port_n1,"N1",14)) {$ordererror++; $c_vc_port=$alertcolor;}      
 //     if(checktext($vc_port_n2,"N2",16)) {$ordererror++; $c_vc_port=$alertcolor;}      
//      if(checktext($vc_port_n3,"N3",16)) {$ordererror++; $c_vc_port=$alertcolor;}      
//      if(checktext($vc_port_n4,"N4",16)) {$ordererror++; $c_vc_port=$alertcolor;}      
 //     if(checktext($vc_port_n5,"N5",16)) {$ordererror++; $c_vc_port=$alertcolor;}      
//      if(checktext($vc_port_n6,"N6",16)) {$ordererror++; $c_vc_port=$alertcolor;}      
  //    if(checktext($vc_port_n7,"N7",16)) {$ordererror++; $c_vc_port=$alertcolor;}      
 //     if(checktext($vc_port_n8,"N8",16)) {$ordererror++; $c_vc_port=$alertcolor;}      
 //     if(checktext($vc_port_n9,"N9",16)) {$ordererror++; $c_vc_port=$alertcolor;}      
 //     if(checktext($vc_port_n10,"N10",16)) {$ordererror++; $c_vc_port=$alertcolor;}      
      if ($vc_reqdeliverydateser<$vc_reqdeliverydate_checktime_port)
        {
        if (strlen($vc_reqdeliverydate)>0)
          {
          //echo("NOK N $vc_reqdeliverydate_checktime_new P $vc_reqdeliverydate_checktime_port REQ $vc_reqdeliverydateser");
          $c_vc_reqdeliverydate=$alertcolor;
          }
        }
      }
      if ((strlen($vc_reqdeliverydate_voice)>0)&&($vc_reqdeliverydate_voice<$vc_reqdeliverydate))
        {
        $c_vc_reqdeliverydate=$alertcolor;
        }
      

// IBAN Handling

// echo("ACHTUNG IBAN CHECK FEHLT");

if ($ordererror==0)
  {

if (($checkiban==0)&&($z==1))
  {
  $client = new SoapClient('https://ssl.ibanrechner.de/soap/?wsdl');
  $result = $client->calculate_iban('DE', "$vc_banksortcode", "$vc_bankaccnumber", 'mwerk', 'cx10006');
if ($debug)  print"<pre>";
if ($debug)  print_r($result);
if ($debug)  print"</pre>";
                    
  $resiban=$result->iban;
  $resresult=$result->result;
  $resreturncode=$result->return_code;
  $resbankcode=$result->bank_code;
  $resbank=$result->bank;
  $resaccount=$result->account_number;
  $lcheck=$result->length_check;
  $acheck=$result->account_check;
  $bcheck=$result->bank_code_check;
  
  if ($acheck=='failed')
    {
    $atxt='Kontodaten falsch';
    $c_vc_bankaccnumber=$alertcolor;
    }
  if ($bcheck=='failed')
    {
    $btxt='BLZ falsch';
    $c_vc_banksortcode=$alertcolor;
    }
  
  if ($resresult=='passed')
    {
    print "$checkiban $resiban $resresult $resreturncode";
    $vc_bankiban=$resiban;
    }                                                    
  else
    {
    $ordererror=1;
    if ($resresult!='failed')
      {
      print "<b>Kto/BLZ Check Fehler: $atxt $btxt $resresult</b><br>";
      }
    }  
                                                        
  }


if ($checkiban==1)
  {
  $client = new SoapClient('https://ssl.ibanrechner.de/soap/?wsdl');
  $result = $client->validate_iban("$vc_bankiban", 'mwerk', 'cx10006'); 
if ($debug)  print"<pre>";
if ($debug)  print_r($result);
if ($debug)  print"</pre>";
                    
  $resiban=$result->iban;
  $resresult=$result->result;
  $resreturncode=$result->return_code;
  $resbankcode=$result->bank_code;
  $resbank=$result->bank;
  $resaccount=$result->account_number;
  $lcheck=$result->length_check;
  $acheck=$result->account_check;
  $bcheck=$result->bank_code_check;
  $vc_bankbic=$result->bic_candidates[0]->bic;

  if ($resresult=='passed') 
    {
    print "$checkiban $resiban $resresult $resreturncode";
    }                                                    
  else
    {
    $ordererror=1;
    if ($resresult!='failed')
      {
      print "<b>IBAN Check Fehler: $resresult</b><br>";
      }
    $c_vc_bankiban=$alertcolor;
    }  
                                                        
  }
  
  }                                                          

// IBAN Handling Ende


// Portierungsform Handling

try {
   
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    if (
        !isset($_FILES['upfile']['error']) ||
        is_array($_FILES['upfile']['error'])
    ) {
        throw new RuntimeException('Invalid parameters.');
    }

    // Check $_FILES['upfile']['error'] value.
    switch ($_FILES['upfile']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    }

    // You should also check filesize here.
    if ($_FILES['upfile']['size'] > 1048576) {
        throw new RuntimeException('Exceeded filesize limit.');
    }

    // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
    // Check MIME Type by yourself.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($_FILES['upfile']['tmp_name']),
        array(
            'pdf' => 'application/pdf',
            //'jpg' => 'image/jpeg',
            //'png' => 'image/png',
            //'gif' => 'image/gif',
        ),
        true
    )) {
        throw new RuntimeException('Invalid file format.');
    }


    // You should name it uniquely.
    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
    // On this example, obtain safe unique name from its binary data.
    if (!move_uploaded_file(
        $_FILES['upfile']['tmp_name'],
        sprintf('/var/wwwsys/awa-dokumente/%s.%s',
            sha1_file($_FILES['upfile']['tmp_name']),
            $ext
        )
    )) {
        throw new RuntimeException('Failed to move uploaded file.');
    }

    echo 'File is uploaded successfully.';

} catch (RuntimeException $e) {

    echo $e->getMessage();

}








  if ($ordererror==0)
    {
    if (strlen($vc_reqdeliverydate_voice)==0) 
      {
      $vc_reqdeliverydate_voice=$vc_reqdeliverydate;
      }

    $vc_reqdeliverydate=get_sertime($vc_reqdeliverydate);
    $vc_reqdeliverydate_voice=get_sertime($vc_reqdeliverydate_voice);
    if ($noagredata==1)
      {
      # setze die Eintraege fuer conn Felder mit den normalen

      $vc_salutation=$vc_conn_salutation;
      $vc_title=$vc_conn_title;
      $vc_company=$vc_conn_company;
      $vc_surname=$vc_conn_surname;
      $vc_firstname=$vc_conn_firstname;
      $vc_birthday=$vc_conn_birthday;
      $vc_street=$vc_conn_street;
      $vc_houseno=$vc_conn_houseno;
//      $vc_city=$vc_conn_city;
//      $vc_citysubloc=$vc_conn_citysubloc;
//      $vc_postcode=$vc_conn_postcode;
      $readlocationfromdb=1;
        
      $vc_contactfirstname=$vc_conn_contactfirstname;
      $vc_contact=$vc_conn_contact;
      $vc_contactphonepre=$vc_conn_contactphonepre;
      $vc_contactphone=$vc_conn_contactphone;

      }  
    
    } 
  }  

if ($debug) echo("ordererror: $ordererror<br>");



function checktext($text,$descr,$mode)
  {
  $error=0;
  global $errormessage;
  global $errormessagetwo;
  global $debug;
  if ($mode==1)
    {
    //if(eregi("^[_0-9a-zA-z�������.\ ]{2,30}$",$text)==0)
    if(preg_match ("/^[a-zA-Z\x7f-\xff.\ \-&]{2,30}$/",$text)==0)    // UMLAUTE FEHLEN
      {
      $error=1;
if ($debug)      echo("<font color=red>$errormessage
<b>$descr</b></font><br>");
      }
    }
  if ($mode==1002)
    {
    //if(eregi("^[_0-9a-zA-z�������.\ ]{2,30}$",$text)==0)
    if(preg_match ("/^[a-zA-Z\x7f-\xff.\ \-&_]{2,30}$/",$text)==0)    // UMLAUTE FEHLEN
      {
      $error=1;
if ($debug)      echo("<font color=red>$errormessage
<b>$descr</b></font><br>");
      }
    }

  if ($mode==1001)
    {
    //if(eregi("^[_0-9a-zA-z�������.\ ]{2,30}$",$text)==0)
    if(preg_match ("/^[0-9a-zA-Z.\ \-]{2,30}$/",$text)==0)    // UMLAUTE FEHLEN
      {
      $error=1;
if ($debug)      echo("<font color=red>$errormessage
<b>$descr</b></font><br>");
      }
    }

  if ($mode==2)
    {
    //if(eregi("^[_0-9a-zA-z�������.\ ]{0,30}$",$text)==0)     // UMLAUTE FEHLEN
    if(preg_match ("/^[a-zA-Z\x7f-\xff.\ \-]{0,30}$/",$text)==0)
      {
      $error=1;
if ($debug)      echo("<font color=red>$errormessage
<b>$descr</b></font><br>");
      }  
    }
  if ($mode==21)
    {
    if(preg_match ("/^[0-9a-zA-Z\x7f-\xff.,\ \-]{2,30}$/",$text)==0)    // UMLAUTE FEHLEN
      {
      $error=1;
if ($debug)      echo("<font color=red>$errormessage
<b>$descr</b></font><br>");
      }
    }
  if ($mode==22)
    {
    if(preg_match ("/^[0-9a-zA-Z\x7f-\xff.\ \-&]{0,40}$/",$text)==0)    // UMLAUTE FEHLEN
      {
      $error=1;
if ($debug)      echo("<font color=red>$errormessage
<b>$descr</b></font><br>");
      }  
    }
  if ($mode==122)
    {
    if(preg_match ("/^[0-9a-zA-Z\x7f-\xff.,\ \-:]{0,250}$/",$text)==0)    // UMLAUTE FEHLEN
      {
      $error=1;
if ($debug)      echo("<font color=red>$errormessage
<b>$descr</b></font><br>");
      }  
    }

  if ($mode==31)
    {
    if(preg_match ("/^[0-9a-zA-Z\ \-]{1,8}$/",$text)==0)    // UMLAUTE FEHLEN
      {
      $error=1;
if ($debug)      echo("<font color=red>$errormessage
<b>$descr</b></font><br>");
      }
    }
  if ($mode==32)
    {
    if(preg_match ("/^[0-9a-zA-Z\ \-]{0,8}$/",$text)==0)    // UMLAUTE FEHLEN
      {
      $error=1;
if ($debug)      echo("<font color=red>$errormessage
<b>$descr</b></font><br>");
      }  
    }
    
  if ($mode==3)
    {
    if(preg_match ("/^[0-9]{5}$/",$text)==0)
      {
      $error=1;
if ($debug)      echo("<font color=red>$errormessage
<b>$descr</b></font><br>");
      }
    }
  if ($mode==4)
    {
    if(preg_match ("/^[0-9]{3,10}$/",$text)==0)
      {
      $error=1;
if ($debug)      echo("<font color=red>$errormessage
<b>$descr</b></font><br>");
      }
    }
  if ($mode==5)
    {
    if(preg_match ("/^[0-9]{8}$/",$text)==0)
      {
      $error=1;
if ($debug)      echo("<font color=red>$errormessage
<b>$descr</b></font><br>");
      }
    }
  if ($mode==6)
    {
    if(eregi("^[0-9]{1,5}$",$text)==0)
      {
      $error=1;
if ($debug)      echo("<font color=red>$errormessage
<b>$descr</b></font><br>");
      }
    }
  if ($mode==7)
    {
    if(strlen($text)!=10)
      {
      if(strlen($text)>0)
        {

      $error=1;
if ($debug)      echo("<font color=red>$errormessage
<b>$descr</b></font><br>");
        }
      }
    else
      {
      $stime=get_sertime($text);
      if ($stime==-1)
        {
        $error=1;
if ($debug)        echo("<font color=red>$errormessagetwo<b>$descr</b></font><br>");
        }
      }
    }
  if ($mode==8)
    {
    if(preg_match ("/^DE[0-9]{20}$/",$text)==0)
      {
      $error=1;
if ($debug)      echo("<font color=red>$errormessage
<b>$descr</b></font><br>");
      }
    }
  if ($mode==9)
    {
    if(preg_match ("/^0[0-9]{2,10}$/",$text)==0)
      {
      $error=1;
if ($debug)      echo("<font color=red>$errormessage
<b>$descr</b></font><br>");
      }
    }
    
  if ($mode==10)
    {
    if(strlen($text)!=10)
      {
      if(strlen($text)>0)
        {
        $error=1;
if ($debug)        echo("<font color=red>$errormessage<b>$descr</b></font><br>");
        }
      }
    else
      {
      $stime=get_sertime($text);
      if ($stime==-1)
        {
        $error=1;
if ($debug)        echo("<font color=red>$errormessagetwo<b>$descr</b></font><br>");
        }
      }
    }
  if ($mode==11)
    {
    if(eregi("^[0-9]{0,5}$",$text)==0)
      {
      $error=1;
if ($debug)      echo("<font color=red>$errormessage
<b>$descr</b></font><br>");
      }
    }
  if ($mode==12)
    {
    if(strlen($text)!=0)
      {
      if(preg_match ("/^[0-9]{5}$/",$text)==0)
        {
        $error=1;
if ($debug)        echo("<font color=red>$errormessage<b>$descr</b></font><br>");
        }
      }  
    }
  if ($mode==13)
    {
    if (preg_match('/^[^0-9][a-zA-Z0-9-_.]+([.][a-zA-Z0-9-_]+)*[@][a-zA-Z0-9-_]+([.][a-zA-Z0-9-_]+)*[.][a-zA-Z]{2,10}$/', $text)) 
      {
      //OK
      }  
    else
      {
      $error=1;
if ($debug)      echo("<font color=red>$errormessage<b>$descr</b></font><br>");
      }  
    }
 
   if ($mode==14)
    {
    if(preg_match ("/^[0-9]{3,10}$/",$text)==0)
      {
      $error=1;
if ($debug)      echo("<font color=red>$errormessage
<b>$descr</b></font><br>");
      }
    }

  if ($mode==15)
    {
    if(strlen($text)!=0)
      {
          
      if(preg_match ("/^0[0-9]{0,10}$/",$text)==0)
        {
        $error=1;
if ($debug)        echo("<font color=red>$errormessage
<b>$descr</b></font><br>");
        }
      }  
    }
   
  if ($mode==16)
    {
    if(preg_match ("/^[0-9]{0,10}$/",$text)==0)
      {
      $error=1;
if ($debug)      echo("<font color=red>$errormessage
<b>$descr</b></font><br>");
      }
    }
    
    
  return($error);
  }


?>
