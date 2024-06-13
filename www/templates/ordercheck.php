<?php
//$vc_reqdeliverydate=date("d.m.y",time()+604800);

if (($vca_availreasoncode=='BTOK')||($action=='vpdeliveredconf'))
  {
// --> BTOK
  
// vcstate:
// <=10 : not to be used in calc
//
//  1 : pending_bterror
//  5 : cancelled
//  6 : rejected
//  9 : ceased

// >10 : to be used in cli double
//
//  11: new
//  12: pending (bw,crsum BW upgrade)
//  13: reserved

// >20 : to be used in calc
//
//  21: pending (ports Port upgrade)
//  22: orderprepare
//  23: ordered
//  24: committed (commitdate BT)
//  25: installed (installdate BT)
//  26: vci issued (prod BT)
//  27: productive (configured)
//  31: cease prepare

      // DB double cli check

//    $query="select * from dslprov_vc where vc_cli LIKE '$vca_cli' AND vc_state >10";
//    $result=mysql_query($query);
//    $number=mysql_num_rows($result);

$vc_state_actual=$vc_state;


echo("VVVV $visp_id");


$number=0;
  if ($number>0)
    {
    echo("<h4>Inventory Error: CLI double</h4><br>");
    $vca_availreasoncode='T-CLI';
    }
  else
    {

$vpstatechange=0;

// ORDER
        $batchid='';
        $vc_btaccountcode='';
        $vc_state=22;
        if ($ordermode==1) echo("<h4>Inventory Check OK: ORDER PREPARE</h4><br>");
        $vca_availreasoncode="T-OK";

        $vc_state=22;
        $vp_id=0;



    if ($ordermode==1)
      {
      $enterdate=time();
      echo("$enterdate");
      if (($vc_state==22)&&($btuserordertype_id==5)) // Manual Provide
        {
        $vc_state=23;  
        }


echo("SELECT b.vcfault_id,b.vcfault_text  FROM `dslprov_vc` a,`dslprov_vcfault` b WHERE `vc_errorcode` != 0 and  a.vc_errorcode & b.vcfault_id and vc_id=$vc_id");
$qfault="SELECT b.vcfault_id,b.vcfault_text  FROM `dslprov_vc` a,`dslprov_vcfault` b WHERE `vc_errorcode` != 0 and  a.vc_errorcode & b.vcfault_id and vc_id=$vc_id;";
$rfault=mysql_query($qfault);
//echo("<table>");
  for ($fi=0;$fi < mysql_num_rows($rfault);$fi++)
    {
    $frow = mysql_fetch_row($rfault);
    $fj=0;
    foreach ($frow as $fvalue)
      {
//      echo("<tr><td>$fvalue</td></tr>");
echo(" -> $fvalue "); 
      }
    }
//echo("</table>");

$queryl="select * from dslprov_locations where location_id LIKE '$location_id'";
$resultl=mysql_query($queryl);
$numberl=mysql_num_rows($resultl);
$rowarray=mysql_fetch_array($resultl);
                        
$vc_conn_city=$rowarray['location_city'];
$vc_conn_citysubloc=$rowarray['location_citysubloc'];
$vc_conn_postcode=$rowarray['location_postcode'];
$ltype=$rowarray['location_type'];






// Vorprovider
$vc_btaccountcode=$rowarray['location_provider'];

if (strcmp($ltype,'preorder')==0)
  {
  $vc_state=21;
  }

// erlaubte fehlende Daten
if ($oecode>0)
  {
  $vc_state=20;
  }

echo("ORDERCHECK VCSTATE $vc_state CONTRACTDUR $vc_contract_duration");

if ($readlocationfromdb==1)
  {
  $vc_city=$vc_conn_city;
  $vc_citysubloc=$vc_conn_citysubloc;
  $vc_postcode=$vc_conn_postcode;
  }                                                                        



// TEST  MYSQL_QUERY("INSERT INTO `crmgustav`.`dslprov_vcfault` VALUES ('10', 'xxxxxxxxx');");

//                                          (`vc_id`, `enterdate`, `vp_id`, `vc_vci`, `vc_batch_bt`, `vc_batch_visp`, `vc_cbuk`, `vc_btaccountcode`, `vc_refnum`, `vc_visprefnum`, `btuserordertype_id`, `btuserorderstate_id`, `vc_availreasoncode`, `productcap_id`, `vispproduct_id`, `product_id`, `productadditional_id`, `vc_title`, `vc_surname`, `vc_firstname`, `vc_birthday`, `vc_houseno`, `vc_street`, `vc_city`, `vc_postcode`, `vc_cli`, `vc_contact`, `vc_contactphone`, `vc_conn_title`, `vc_conn_surname`, `vc_conn_firstname`, `vc_conn_birthday`, `vc_conn_street`, `vc_conn_houseno`, `vc_conn_postcode`, `vc_conn_city`, `vc_conn_contact`, `vc_conn_contactphone`, `vc_email`, `vc_taefiber`, `invoicemail_id`, `evn_id`, `hardware_id`, `telregister_id`, `telregistertype_id`, `vc_comments`, `vc_bankname`, `vc_bankaccholder`, `vc_bankaccnumber`, `vc_banksortcode`, `vc_bankiban`, `vc_port_onkz`, `vc_port_n1`, `vc_port_n2`, `vc_port_n3`, `vc_port_n4`, `vc_port_n5`, `vc_port_n6`, `vc_port_n7`, `vc_port_n8`, `vc_port_n9`, `vc_port_n10`, `vc_orderdate`, `vc_reqdeliverydate`, `vc_commitdate`, `vc_installationdate`, `vc_canceldate`, `vc_productiondate`, `vc_notes`, `vc_contact_email`, `userbw_id`, `usercr_id`, `userrealm_id`, `visp_id`, `domain1_id`, `domain2_id`, `domain3_id`, `vc_carelevel`, `vc_confirmations`, `ip`, `vc_user`, `vc_state`, `vc_statechangedate`, `vc_deleted`, `vc_deleteddate`, `vcfault_id`, `vc_migkey`) 

if (strlen($vc_reqdeliverydate)>0)
  {
  $asap=0;
  }
else
  {
  $asap=1;
  $vc_reqdeliverydate=0;
  }  
if (strlen($vc_reqdeliverydate_voice)==0)
  {
  $vc_reqdeliverydate_voice=0;
  }

$vc_salutation=str_replace("_"," ",$vc_salutation);
$vc_conn_salutation=str_replace("_"," ",$vc_conn_salutation);

if ($action=='vcorder')
  {
  echo ("$action INSERT");
  //echo"INSERT INTO `crmgustav`.`dslprov_vc` VALUES ('$vca_id', '$enterdate', '$location_id', '$asap', '$vc_batch_bt', '$vc_batch_visp', '', '$vc_btaccountcode', '$vc_refnum', '$vc_visprefnum', '$btuserordertype_id', '0','$vca_availreasoncode', '$productcap_id', '$vispproduct_id', '$product_id', '$productadditional_id', '$vc_salutation', '$vc_title', '$vc_company', '$vc_surname', '$vc_firstname', '$vc_birthday', '$vc_houseno', '$vc_street', '$vc_city','$vc_citysubloc', '$vc_postcode', '$vc_cli', '$vc_contactfirstname', '$vc_contact', '$vc_contactphonepre', '$vc_contactphone', '$vc_conn_salutation', '$vc_conn_title', '$vc_conn_company', '$vc_conn_surname', '$vc_conn_firstname', '$vc_conn_birthday', '$vc_conn_street', '$vc_conn_houseno', '$vc_conn_postcode','$vc_conn_city','$vc_conn_citysubloc', '$vc_conn_contactfirstname', '$vc_conn_contact', '$vc_conn_contactphonepre', '$vc_conn_contactphone', '$vc_email', '$vc_taefiber', '$invoicemail_id', '$evn_id', '$hardware_id', '$telregister_id', '$telregistertype_id', '$vc_comments', '$vc_bankname', '$vc_bankaccholder','$vc_bankaccnumber', '$vc_banksortcode', '$vc_bankiban','$vc_bankbic', '$portprovider_id', '$vc_port_onkz', '$vc_port_n1', '$vc_port_n2', '$vc_port_n3', '$vc_port_n4', '$vc_port_n5', '$vc_port_n6', '$vc_port_n7', '$vc_port_n8', '$vc_port_n9', '$vc_port_n10','$vc_orderdate','$vc_reqdeliverydate','0','0','0','0', '0', '0','$vc_orderdate_voice','$vc_reqdeliverydate_voice','0','0','0','0', '0', '0', '$vc_notes','$vc_contact_email','$userbw_id','$usercr_id','$userrealm_id','$visp_id','$domain1_id','$domain2_id','$domain3_id','$vc_carelevel','$vc_confirmations','ip','$vca_user','$vc_state','$enterdate','$vc_state','$enterdate','1','$enterdate','0','0','0','$vc_migkey');";


  $vc_contract_duration=24;
  if ($isp=='werknetz')
    {
    $vc_contract_duration=36;
    }
  if ($isp=='gustav')
    {
    $vc_contract_duration=0;
    if ($product_id>5)
      {
      if ($product_id<10)
        {
        $vc_contract_duration=24;
        }
      }
    }
  if ($isp=='hugo')
    {
    $vc_contract_duration=0;
    }


  MYSQL_QUERY("INSERT INTO `dslprov_vc` VALUES ('$vca_id', '$enterdate', '$location_id', '$asap', '$vc_batch_bt', '$vc_batch_visp', '', '$vc_btaccountcode', '$vc_refnum', '$vc_visprefnum', '$btuserordertype_id', '0','$vca_availreasoncode', '$btproduct_id','$productcap_id', '$vispproduct_id', '$product_id', '$productadditional_id', '$vc_salutation', '$vc_title', '$vc_company', '$vc_surname', '$vc_firstname', '$vc_birthday', '$vc_houseno', '$vc_street', '$vc_city','$vc_citysubloc', '$vc_postcode', '$vc_cli', '$vc_contactfirstname', '$vc_contact', '$vc_contactphonepre', '$vc_contactphone',  '$vc_conn_salutation', '$vc_conn_title', '$vc_conn_company', '$vc_conn_surname', '$vc_conn_firstname', '$vc_conn_birthday', '$vc_conn_street', '$vc_conn_houseno', '$vc_conn_postcode','$vc_conn_city','$vc_conn_citysubloc', '$vc_conn_contactfirstname', '$vc_conn_contact', '$vc_conn_contactphonepre', '$vc_conn_contactphone', '$vc_email', '$vc_taefiber', '$invoicemail_id', '$evn_id', '$hardware_id', '$telregister_id', '$telregistertype_id', '$vc_comments', '$vc_bankname', '$vc_bankaccholder','$vc_bankaccnumber', '$vc_banksortcode', '$vc_bankiban','$vc_bankbic', '$portprovider_id', '$vc_port_onkz', '$vc_port_n1', '$vc_port_n2', '$vc_port_n3', '$vc_port_n4', '$vc_port_n5', '$vc_port_n6', '$vc_port_n7', '$vc_port_n8', '$vc_port_n9', '$vc_port_n10','$vc_orderdate','$vc_reqdeliverydate','0','0','0','0', '0', '0','$vc_orderdate_voice','$vc_reqdeliverydate_voice','0','0','0','0', '0', '0', '$vc_notes','$vc_contact_email','$userbw_id','$usercr_id','$userrealm_id','$visp_id','$vc_contract_duration','$domain2_id','$domain3_id','$vc_carelevel','$vc_confirmations','ip','$vca_user','$vc_state','$enterdate','$vc_state','$enterdate','1','$enterdate','0','0','0','$vc_migkey','0','0','0','0','0','$vc_billingtype','$oecode','0','0','$gee_id','0','$foreign_customer_id','$vc_housetype','$vc_bankaccholderpre','$vc_bankaccholderstr','$vc_bankaccholdernr','$vc_bankaccholderzip','$vc_bankaccholdercity','$vc_check_sepa','$vc_check_schufa','$vc_check_agb','$vc_check_widerruf','$vc_check_optintel','$vc_check_optinemail','$vc_check_optinmail','0','$vc_docname_contract','$vc_docname_awa','$vc_docname_gee','$vc_tbwiderspruch','$gee_owner_name','$gee_flur','$gee_contact_company','$gee_contact_name','$gee_contact_str','$gee_contact_city','$gee_contact_zip','$gee_contact_tel','$gee_contact_email','$vc_tbname','$vc_tbfirstname','','','','','','','','');");
  
  //OLD OKT18  MYSQL_QUERY("INSERT INTO `dslprov_vc` VALUES ('$vca_id', '$enterdate', '$location_id', '$asap', '$vc_batch_bt', '$vc_batch_visp', '', '$vc_btaccountcode', '$vc_refnum', '$vc_visprefnum', '$btuserordertype_id', '0','$vca_availreasoncode', '$btproduct_id','$productcap_id', '$vispproduct_id', '$product_id', '$productadditional_id', '$vc_salutation', '$vc_title', '$vc_company', '$vc_surname', '$vc_firstname', '$vc_birthday', '$vc_houseno', '$vc_street', '$vc_city','$vc_citysubloc', '$vc_postcode', '$vc_cli', '$vc_contactfirstname', '$vc_contact', '$vc_contactphonepre', '$vc_contactphone',  '$vc_conn_salutation', '$vc_conn_title', '$vc_conn_company', '$vc_conn_surname', '$vc_conn_firstname', '$vc_conn_birthday', '$vc_conn_street', '$vc_conn_houseno', '$vc_conn_postcode','$vc_conn_city','$vc_conn_citysubloc', '$vc_conn_contactfirstname', '$vc_conn_contact', '$vc_conn_contactphonepre', '$vc_conn_contactphone', '$vc_email', '$vc_taefiber', '$invoicemail_id', '$evn_id', '$hardware_id', '$telregister_id', '$telregistertype_id', '$vc_comments', '$vc_bankname', '$vc_bankaccholder','$vc_bankaccnumber', '$vc_banksortcode', '$vc_bankiban','$vc_bankbic', '$portprovider_id', '$vc_port_onkz', '$vc_port_n1', '$vc_port_n2', '$vc_port_n3', '$vc_port_n4', '$vc_port_n5', '$vc_port_n6', '$vc_port_n7', '$vc_port_n8', '$vc_port_n9', '$vc_port_n10','$vc_orderdate','$vc_reqdeliverydate','0','0','0','0', '0', '0','$vc_orderdate_voice','$vc_reqdeliverydate_voice','0','0','0','0', '0', '0', '$vc_notes','$vc_contact_email','$userbw_id','$usercr_id','$userrealm_id','$visp_id','$domain1_id','$domain2_id','$domain3_id','$vc_carelevel','$vc_confirmations','ip','$vca_user','$vc_state','$enterdate','$vc_state','$enterdate','1','$enterdate','0','0','0','$vc_migkey','0','0','0','0','0','$vc_billingtype','','0','0','$gee_id','0','','','','','','','','0','0','0','0','0','0','0','0','','','','0');");
  // OLD SEP18 MYSQL_QUERY("INSERT INTO `dslprov_vc` VALUES ('$vca_id', '$enterdate', '$location_id', '$asap', '$vc_batch_bt', '$vc_batch_visp', '', '$vc_btaccountcode', '$vc_refnum', '$vc_visprefnum', '$btuserordertype_id', '0','$vca_availreasoncode', '$btproduct_id','$productcap_id', '$vispproduct_id', '$product_id', '$productadditional_id', '$vc_salutation', '$vc_title', '$vc_company', '$vc_surname', '$vc_firstname', '$vc_birthday', '$vc_houseno', '$vc_street', '$vc_city','$vc_citysubloc', '$vc_postcode', '$vc_cli', '$vc_contactfirstname', '$vc_contact', '$vc_contactphonepre', '$vc_contactphone',  '$vc_conn_salutation', '$vc_conn_title', '$vc_conn_company', '$vc_conn_surname', '$vc_conn_firstname', '$vc_conn_birthday', '$vc_conn_street', '$vc_conn_houseno', '$vc_conn_postcode','$vc_conn_city','$vc_conn_citysubloc', '$vc_conn_contactfirstname', '$vc_conn_contact', '$vc_conn_contactphonepre', '$vc_conn_contactphone', '$vc_email', '$vc_taefiber', '$invoicemail_id', '$evn_id', '$hardware_id', '$telregister_id', '$telregistertype_id', '$vc_comments', '$vc_bankname', '$vc_bankaccholder','$vc_bankaccnumber', '$vc_banksortcode', '$vc_bankiban','$vc_bankbic', '$portprovider_id', '$vc_port_onkz', '$vc_port_n1', '$vc_port_n2', '$vc_port_n3', '$vc_port_n4', '$vc_port_n5', '$vc_port_n6', '$vc_port_n7', '$vc_port_n8', '$vc_port_n9', '$vc_port_n10','$vc_orderdate','$vc_reqdeliverydate','0','0','0','0', '0', '0','$vc_orderdate_voice','$vc_reqdeliverydate_voice','0','0','0','0', '0', '0', '$vc_notes','$vc_contact_email','$userbw_id','$usercr_id','$userrealm_id','$visp_id','$domain1_id','$domain2_id','$domain3_id','$vc_carelevel','$vc_confirmations','ip','$vca_user','$vc_state','$enterdate','$vc_state','$enterdate','1','$enterdate','0','0','0','$vc_migkey','0','0','0','0','0','$vc_billingtype','','0','0','$gee_id','0');");

  // OLD APR18 MYSQL_QUERY("INSERT INTO `dslprov_vc` VALUES ('$vca_id', '$enterdate', '$location_id', '$asap', '$vc_batch_bt', '$vc_batch_visp', '', '$vc_btaccountcode', '$vc_refnum', '$vc_visprefnum', '$btuserordertype_id', '0','$vca_availreasoncode', '$btproduct_id','$productcap_id', '$vispproduct_id', '$product_id', '$productadditional_id', '$vc_salutation', '$vc_title', '$vc_company', '$vc_surname', '$vc_firstname', '$vc_birthday', '$vc_houseno', '$vc_street', '$vc_city','$vc_citysubloc', '$vc_postcode', '$vc_cli', '$vc_contactfirstname', '$vc_contact', '$vc_contactphonepre', '$vc_contactphone',  '$vc_conn_salutation', '$vc_conn_title', '$vc_conn_company', '$vc_conn_surname', '$vc_conn_firstname', '$vc_conn_birthday', '$vc_conn_street', '$vc_conn_houseno', '$vc_conn_postcode','$vc_conn_city','$vc_conn_citysubloc', '$vc_conn_contactfirstname', '$vc_conn_contact', '$vc_conn_contactphonepre', '$vc_conn_contactphone', '$vc_email', '$vc_taefiber', '$invoicemail_id', '$evn_id', '$hardware_id', '$telregister_id', '$telregistertype_id', '$vc_comments', '$vc_bankname', '$vc_bankaccholder','$vc_bankaccnumber', '$vc_banksortcode', '$vc_bankiban','$vc_bankbic', '$portprovider_id', '$vc_port_onkz', '$vc_port_n1', '$vc_port_n2', '$vc_port_n3', '$vc_port_n4', '$vc_port_n5', '$vc_port_n6', '$vc_port_n7', '$vc_port_n8', '$vc_port_n9', '$vc_port_n10','$vc_orderdate','$vc_reqdeliverydate','0','0','0','0', '0', '0','$vc_orderdate_voice','$vc_reqdeliverydate_voice','0','0','0','0', '0', '0', '$vc_notes','$vc_contact_email','$userbw_id','$usercr_id','$userrealm_id','$visp_id','$domain1_id','$domain2_id','$domain3_id','$vc_carelevel','$vc_confirmations','ip','$vca_user','$vc_state','$enterdate','$vc_state','$enterdate','1','$enterdate','0','0','0','$vc_migkey','0','0','0','0','0','$vc_billingtype','','0','0');");

  // OLD      MYSQL_QUERY("INSERT INTO dslprov_vc VALUES ('$vca_id','$enterdate','$vp_id','0','$vc_batch_bt','$vc_batch_visp','','$vc_btaccountcode','$vc_refnum','$vc_visprefnum','$btuserordertype_id','0','$vca_availreasoncode','$btproduct_id','$vispproduct_id','$vc_title','$vc_surname','$vc_firstname','$vc_initials','$vc_premisesname','$vc_houseno','$vc_street','$vc_city','$vca_postcode','$vca_cli','$vca_exchangecode','$vc_contactphone','$vc_orderdate','$vc_reqdeliverydate','0','0','0','0','$vc_notes','$vc_contact_email','$userbw_id','$usercr_id','$userrealm_id','$visp_id','$domain1_id','$domain2_id','$domain3_id','$vc_carelevel','$vc_confirmations','ip','$vca_user','$vc_state','$enterdate','0','0','0','$vc_migkey')");
  }
else
  {
  echo("CHECK CHANGE BILLING DATA");

  $inputdata = array(
    "vc_company"=>$vc_company,
    "vc_salutation"=>$vc_salutation,
    "vc_firstname"=>$vc_firstname,
    "vc_surname"=>$vc_surname,
    "vc_street"=>$vc_street,
    "vc_houseno"=>$vc_houseno,
    "vc_postcode"=>$vc_postcode,
    "vc_city"=>$vc_city,
    "vc_email"=>$vc_email,
);

  $query="SELECT vc_company,vc_salutation,vc_firstname,vc_surname,vc_street,vc_houseno,vc_postcode,vc_city,vc_email from dslprov_vc where vc_visprefnum='$vc_visprefnum'";
  echo("$query\n");
  $result = mysql_query($query);

  $row = mysql_fetch_row($result);

  $changes = false;

  $index = 0;
  foreach($inputdata as $value) {
    echo "\n";
    echo $row[$index];
    echo " <---> ";
    echo $value;
    echo "\n";

    if($row[$index] != $value) {
      $changes = true;
    }

    $index = $index + 1;
  }

  if($changes) {
    echo "\nUPDATE SQL\n";
    // $query = "UPDATE dslprov_vc SET vc_company = '" . $inputdata['vc_company'] . "',vc_salutation = '" . $inputdata['vc_salutation'] . "',vc_firstname = '" . $inputdata['vc_firstname'] . "',vc_surname = '" . $inputdata['vc_surname'] . "',vc_street = '" . $inputdata['vc_street'] . "',vc_houseno = '" . $inputdata['vc_houseno'] . "',vc_postcode = '" . $inputdata['vc_postcode'] . "',vc_city = '" . $inputdata['vc_city'] . "',vc_email = '" . $inputdata['vc_email'] . "',vc_state_billing = '12' WHERE vc_visprefnum = '$vc_visprefnum' and vc_state_billing = '11'";
    $query = "UPDATE dslprov_vc SET vc_state_billing = '12' WHERE vc_visprefnum = '$vc_visprefnum' and vc_state_billing = '11'";
    print "$query\n";
    $result = mysql_query($query);
    print($result);
  }





  echo ("$action UPDATE $vc_visprefnum $vc_id VCCONF $vc_confirmations");  
 MYSQL_QUERY("UPDATE `dslprov_vc` SET  visp_id='$visp_id',vc_migkey='$vc_migkey',vc_errorcode='$oecode',loc_id='$location_id', asap_id='$asap', product_id='$product_id', productadditional_id='$productadditional_id', vc_salutation='$vc_salutation', vc_title='$vc_title', vc_company='$vc_company', vc_surname='$vc_surname', vc_firstname='$vc_firstname', vc_birthday='$vc_birthday', vc_houseno='$vc_houseno', vc_street='$vc_street', vc_city='$vc_city', vc_citysubloc='$vc_citysubloc', vc_postcode='$vc_postcode', vc_contactfirstname='$vc_contactfirstname', vc_contact='$vc_contact', vc_contactphonepre='$vc_contactphonepre', vc_contactphone='$vc_contactphone',  vc_conn_salutation='$vc_conn_salutation', vc_conn_title='$vc_conn_title', vc_conn_company='$vc_conn_company', vc_conn_surname='$vc_conn_surname', vc_conn_firstname='$vc_conn_firstname', vc_conn_birthday='$vc_conn_birthday', vc_conn_street='$vc_conn_street', vc_conn_houseno='$vc_conn_houseno', vc_conn_postcode='$vc_conn_postcode', vc_conn_city='$vc_conn_city', vc_conn_citysubloc='$vc_conn_citysubloc', vc_conn_contactfirstname='$vc_conn_contactfirstname', vc_conn_contact='$vc_conn_contact', vc_conn_contactphonepre='$vc_conn_contactphonepre', vc_conn_contactphone='$vc_conn_contactphone', vc_email='$vc_email', vc_taefiber='$vc_taefiber', invoicemail_id='$invoicemail_id', evn_id='$evn_id', hardware_id='$hardware_id', telregister_id='$telregister_id', telregistertype_id='$telregistertype_id', vc_comments='$vc_comments', vc_bankname='$vc_bankname', vc_bankaccholder='$vc_bankaccholder', vc_bankaccnumber='$vc_bankaccnumber', vc_banksortcode='$vc_banksortcode', vc_bankiban='$vc_bankiban', vc_bankbic='$vc_bankbic', portprovider_id='$portprovider_id', vc_port_onkz='$vc_port_onkz', vc_port_n1='$vc_port_n1', vc_port_n2='$vc_port_n2', vc_port_n3='$vc_port_n3', vc_port_n4='$vc_port_n4', vc_port_n5='$vc_port_n5', vc_port_n6='$vc_port_n6', vc_port_n7='$vc_port_n7', vc_port_n8='$vc_port_n8', vc_port_n9='$vc_port_n9', vc_port_n10='$vc_port_n10', vc_reqdeliverydate='$vc_reqdeliverydate',vc_reqdeliverydate_voice='$vc_reqdeliverydate_voice',gee_id='$gee_id',foreign_customer_id='$foreign_customer_id',vc_housetype='$vc_housetype',vc_bankaccholderpre='$vc_bankaccholderpre',vc_bankaccholderstr='$vc_bankaccholderstr',vc_bankaccholdernr='$vc_bankaccholdernr',vc_bankaccholderzip='$vc_bankaccholderzip',vc_bankaccholdercity='$vc_bankaccholdercity',vc_check_sepa='$vc_check_sepa',vc_check_schufa='$vc_check_schufa',vc_check_agb='$vc_check_agb',vc_check_widerruf='$vc_check_widerruf',vc_check_optintel='$vc_check_optintel',vc_check_optinemail='$vc_check_optinemail',vc_check_optinmail='$vc_check_optinmail',vc_docname_contract='$vc_docname_contract',vc_docname_awa='$vc_docname_awa',vc_docname_gee='$vc_docname_gee',gee_owner_name='$gee_owner_name',gee_flur='$gee_flur',gee_contact_company='$gee_contact_company',gee_contact_name='$gee_contact_name',gee_contact_str='$gee_contact_str',gee_contact_city='$gee_contact_city',gee_contact_zip='$gee_contact_zip',gee_contact_tel='$gee_contact_tel',gee_contact_email='$gee_contact_email',vc_tbname='$vc_tbname',vc_tbfirstname='$vc_tbfirstname',vc_tbwiderspruch='$vc_tbwiderspruch',vc_billingtype='$vc_billingtype',vc_contact_email='$vc_contact_email' WHERE vc_id=$vc_id;");
  if ($btuserordertype_id==3)
    {
     // Reprov neuer Status

 MYSQL_QUERY("UPDATE `dslprov_vc` SET  vc_state='$vc_state',vc_state_voice='$vc_state',vc_confirmations=(vc_confirmations & 2),vc_salesreported=0,vc_cbuk='REPROV' WHERE vc_id=$vc_id;");
 MYSQL_QUERY("delete FROM dslprov_vc_subscribernumbers WHERE subscriber_visprefnum=$vc_visprefnum;");
 MYSQL_QUERY("delete FROM dslprov_vc_line WHERE line_number=$vc_visprefnum;");
 
    
    }

if ($vc_state_actual==20)
  {
  // nur bei unvollst. Vorbestellungen
 MYSQL_QUERY("UPDATE `dslprov_vc` SET vc_state='$vc_state',vc_state_voice='$vc_state' WHERE vc_id=$vc_id;");
  }

// MYSQL_QUERY("UPDATE `dslprov_vc` SET  vc_errorcode='$oecode',loc_id='$location_id', asap_id='$asap', product_id='$product_id', productadditional_id='$productadditional_id', vc_salutation='$vc_salutation', vc_title='$vc_title', vc_company='$vc_company', vc_surname='$vc_surname', vc_firstname='$vc_firstname', vc_birthday='$vc_birthday', vc_houseno='$vc_houseno', vc_street='$vc_street', vc_city='$vc_city', vc_citysubloc='$vc_citysubloc', vc_postcode='$vc_postcode', vc_contactfirstname='$vc_contactfirstname', vc_contact='$vc_contact', vc_contactphonepre='$vc_contactphonepre', vc_contactphone='$vc_contactphone',  vc_conn_salutation='$vc_conn_salutation', vc_conn_title='$vc_conn_title', vc_conn_company='$vc_conn_company', vc_conn_surname='$vc_conn_surname', vc_conn_firstname='$vc_conn_firstname', vc_conn_birthday='$vc_conn_birthday', vc_conn_street='$vc_conn_street', vc_conn_houseno='$vc_conn_houseno', vc_conn_postcode='$vc_conn_postcode', vc_conn_city='$vc_conn_city', vc_conn_citysubloc='$vc_conn_citysubloc', vc_conn_contactfirstname='$vc_conn_contactfirstname', vc_conn_contact='$vc_conn_contact', vc_conn_contactphonepre='$vc_conn_contactphonepre', vc_conn_contactphone='$vc_conn_contactphone', vc_email='$vc_email', vc_taefiber='$vc_taefiber', invoicemail_id='$invoicemail_id', evn_id='$evn_id', hardware_id='$hardware_id', telregister_id='$telregister_id', telregistertype_id='$telregistertype_id', vc_comments='$vc_comments', vc_bankname='$vc_bankname', vc_bankaccholder='$vc_bankaccholder', vc_bankaccnumber='$vc_bankaccnumber', vc_banksortcode='$vc_banksortcode', vc_bankiban='$vc_bankiban', vc_bankbic='$vc_bankbic', portprovider_id='$portprovider_id', vc_port_onkz='$vc_port_onkz', vc_port_n1='$vc_port_n1', vc_port_n2='$vc_port_n2', vc_port_n3='$vc_port_n3', vc_port_n4='$vc_port_n4', vc_port_n5='$vc_port_n5', vc_port_n6='$vc_port_n6', vc_port_n7='$vc_port_n7', vc_port_n8='$vc_port_n8', vc_port_n9='$vc_port_n9', vc_port_n10='$vc_port_n10', vc_reqdeliverydate='$vc_reqdeliverydate',vc_reqdeliverydate_voice='$vc_reqdeliverydate_voice',gee_id='$gee_id' WHERE vc_id=$vc_id;");
//echo"UPDATE `dslprov_vc` SET  loc_id='$location_id', asap_id='$asap', product_id='$product_id', productadditional_id='$productadditional_id', vc_salutation='$vc_salutation', vc_title='$vc_title', vc_company='$vc_company', vc_surname='$vc_surname', vc_firstname='$vc_firstname', vc_birthday='$vc_birthday', vc_houseno='$vc_houseno', vc_street='$vc_street', vc_city='$vc_city', vc_citysubloc='$vc_citysubloc', vc_postcode='$vc_postcode', vc_contactfirstname='$vc_contactfirstname', vc_contact='$vc_contact', vc_contactphonepre='$vc_contactphonepre', vc_contactphone='$vc_contactphone',  vc_conn_salutation='$vc_conn_salutation', vc_conn_title='$vc_conn_title', vc_conn_company='$vc_conn_company', vc_conn_surname='$vc_conn_surname', vc_conn_firstname='$vc_conn_firstname', vc_conn_birthday='$vc_conn_birthday', vc_conn_street='$vc_conn_street', vc_conn_houseno='$vc_conn_houseno', vc_conn_postcode='$vc_conn_postcode', vc_conn_city='$vc_conn_city', vc_conn_citysubloc='$vc_conn_citysubloc', vc_conn_contactfirstname='$vc_conn_contactfirstname', vc_conn_contact='$vc_conn_contact', vc_conn_contactphonepre='$vc_conn_contactphonepre', vc_conn_contactphone='$vc_conn_contactphone', vc_email='$vc_email', vc_taefiber='$vc_taefiber', invoicemail_id='$invoicemail_id', evn_id='$evn_id', hardware_id='$hardware_id', telregister_id='$telregister_id', telregistertype_id='$telregistertype_id', vc_comments='$vc_comments', vc_bankname='$vc_bankname', vc_bankaccholder='$vc_bankaccholder', vc_bankaccnumber='$vc_bankaccnumber', vc_banksortcode='$vc_banksortcode', vc_bankiban='$vc_bankiban', vc_bankbic='$vc_bankbic', portprovider_id='$portprovider_id', vc_port_onkz='$vc_port_onkz', vc_port_n1='$vc_port_n1', vc_port_n2='$vc_port_n2', vc_port_n3='$vc_port_n3', vc_port_n4='$vc_port_n4', vc_port_n5='$vc_port_n5', vc_port_n6='$vc_port_n6', vc_port_n7='$vc_port_n7', vc_port_n8='$vc_port_n8', vc_port_n9='$vc_port_n9', vc_port_n10='$vc_port_n10', vc_reqdeliverydate='$vc_reqdeliverydate',vc_reqdeliverydate_voice='$vc_reqdeliverydate_voice',gee_id='$gee_id' WHERE vc_id=$vc_id;";
  }

if ($action=='vcorder')
  {    
  add_vchistory($vca_id);
  }
else
  {    
  add_vchistory($vc_id);
  }
  

      }
    }


// --> BTOK ENDE
  }
  if ($debug) echo ("$vca_availreasoncode<br>"); 
?>
