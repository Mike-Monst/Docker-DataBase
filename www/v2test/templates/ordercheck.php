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


if ($readlocationfromdb==1)
  {
  $vc_city=$vc_conn_city;
  $vc_citysubloc=$vc_conn_citysubloc;
  $vc_postcode=$vc_conn_postcode;
  }                                                                        



// TEST  MYSQL_QUERY("INSERT INTO `crmgustav`.`dslprov_vcfault` VALUES ('10', 'xxxxxxxxx');");

//                                          (`vc_id`, `enterdate`, `vp_id`, `vc_vci`, `vc_batch_bt`, `vc_batch_visp`, `vc_cbuk`, `vc_btaccountcode`, `vc_refnum`, `vc_visprefnum`, `btuserordertype_id`, `btuserorderstate_id`, `vc_availreasoncode`, `productcap_id`, `vispproduct_id`, `product_id`, `productadditional_id`, `vc_title`, `vc_surname`, `vc_firstname`, `vc_birthday`, `vc_houseno`, `vc_street`, `vc_city`, `vc_postcode`, `vc_cli`, `vc_contact`, `vc_contactphone`, `vc_conn_title`, `vc_conn_surname`, `vc_conn_firstname`, `vc_conn_birthday`, `vc_conn_street`, `vc_conn_houseno`, `vc_conn_postcode`, `vc_conn_city`, `vc_conn_contact`, `vc_conn_contactphone`, `vc_email`, `vc_taefiber`, `invoicemail_id`, `evn_id`, `hardware_id`, `telregister_id`, `telregistertype_id`, `vc_comments`, `vc_bankname`, `vc_bankaccholder`, `vc_bankaccnumber`, `vc_banksortcode`, `vc_bankiban`, `vc_port_onkz`, `vc_port_n1`, `vc_port_n2`, `vc_port_n3`, `vc_port_n4`, `vc_port_n5`, `vc_port_n6`, `vc_port_n7`, `vc_port_n8`, `vc_port_n9`, `vc_port_n10`, `vc_orderdate`, `vc_reqdeliverydate`, `vc_commitdate`, `vc_installationdate`, `vc_canceldate`, `vc_productiondate`, `vc_notes`, `vc_resellernotes`, `userbw_id`, `usercr_id`, `userrealm_id`, `visp_id`, `domain1_id`, `domain2_id`, `domain3_id`, `vc_carelevel`, `vc_confirmations`, `ip`, `vc_user`, `vc_state`, `vc_statechangedate`, `vc_deleted`, `vc_deleteddate`, `vcfault_id`, `vc_migkey`) 

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


echo"INSERT INTO `crmgustav`.`dslprov_vc` VALUES ('$vca_id', '$enterdate', '$location_id', '$asap', '$vc_batch_bt', '$vc_batch_visp', '', '$vc_btaccountcode', '$vc_refnum', '$vc_visprefnum', '$btuserordertype_id', '0','$vca_availreasoncode', '$productcap_id', '$vispproduct_id', '$product_id', '$productadditional_id', '$vc_salutation', '$vc_title', '$vc_company', '$vc_surname', '$vc_firstname', '$vc_birthday', '$vc_houseno', '$vc_street', '$vc_city','$vc_citysubloc', '$vc_postcode', '$vc_cli', '$vc_contactfirstname', '$vc_contact', '$vc_contactphonepre', '$vc_contactphone', '$vc_conn_salutation', '$vc_conn_title', '$vc_conn_company', '$vc_conn_surname', '$vc_conn_firstname', '$vc_conn_birthday', '$vc_conn_street', '$vc_conn_houseno', '$vc_conn_postcode','$vc_conn_city','$vc_conn_citysubloc', '$vc_conn_contactfirstname', '$vc_conn_contact', '$vc_conn_contactphonepre', '$vc_conn_contactphone', '$vc_email', '$vc_taefiber', '$invoicemail_id', '$evn_id', '$hardware_id', '$telregister_id', '$telregistertype_id', '$vc_comments', '$vc_bankname', '$vc_bankaccholder','$vc_bankaccnumber', '$vc_banksortcode', '$vc_bankiban','$vc_bankbic', '$portprovider_id', '$vc_port_onkz', '$vc_port_n1', '$vc_port_n2', '$vc_port_n3', '$vc_port_n4', '$vc_port_n5', '$vc_port_n6', '$vc_port_n7', '$vc_port_n8', '$vc_port_n9', '$vc_port_n10','$vc_orderdate','$vc_reqdeliverydate','0','0','0','0', '0', '0','$vc_orderdate_voice','$vc_reqdeliverydate_voice','0','0','0','0', '0', '0', '$vc_notes','$vc_resellernotes','$userbw_id','$usercr_id','$userrealm_id','$visp_id','$domain1_id','$domain2_id','$domain3_id','$vc_carelevel','$vc_confirmations','ip','$vca_user','$vc_state','$enterdate','$vc_state','$enterdate','1','$enterdate','0','0','0','$vc_migkey');";

MYSQL_QUERY("INSERT INTO `dslprov_vc` VALUES ('$vca_id', '$enterdate', '$location_id', '$asap', '$vc_batch_bt', '$vc_batch_visp', '', '$vc_btaccountcode', '$vc_refnum', '$vc_visprefnum', '$btuserordertype_id', '0','$vca_availreasoncode', '$btproduct_id','$productcap_id', '$vispproduct_id', '$product_id', '$productadditional_id', '$vc_salutation', '$vc_title', '$vc_company', '$vc_surname', '$vc_firstname', '$vc_birthday', '$vc_houseno', '$vc_street', '$vc_city','$vc_citysubloc', '$vc_postcode', '$vc_cli', '$vc_contactfirstname', '$vc_contact', '$vc_contactphonepre', '$vc_contactphone',  '$vc_conn_salutation', '$vc_conn_title', '$vc_conn_company', '$vc_conn_surname', '$vc_conn_firstname', '$vc_conn_birthday', '$vc_conn_street', '$vc_conn_houseno', '$vc_conn_postcode','$vc_conn_city','$vc_conn_citysubloc', '$vc_conn_contactfirstname', '$vc_conn_contact', '$vc_conn_contactphonepre', '$vc_conn_contactphone', '$vc_email', '$vc_taefiber', '$invoicemail_id', '$evn_id', '$hardware_id', '$telregister_id', '$telregistertype_id', '$vc_comments', '$vc_bankname', '$vc_bankaccholder','$vc_bankaccnumber', '$vc_banksortcode', '$vc_bankiban','$vc_bankbic', '$portprovider_id', '$vc_port_onkz', '$vc_port_n1', '$vc_port_n2', '$vc_port_n3', '$vc_port_n4', '$vc_port_n5', '$vc_port_n6', '$vc_port_n7', '$vc_port_n8', '$vc_port_n9', '$vc_port_n10','$vc_orderdate','$vc_reqdeliverydate','0','0','0','0', '0', '0','$vc_orderdate_voice','$vc_reqdeliverydate_voice','0','0','0','0', '0', '0', '$vc_notes','$vc_resellernotes','$userbw_id','$usercr_id','$userrealm_id','$visp_id','$domain1_id','$domain2_id','$domain3_id','$vc_carelevel','$vc_confirmations','ip','$vca_user','$vc_state','$enterdate','$vc_state','$enterdate','1','$enterdate','0','0','0','$vc_migkey','0','0','0','0','0','DEBIT','','0','0');");


// OLD      MYSQL_QUERY("INSERT INTO dslprov_vc VALUES ('$vca_id','$enterdate','$vp_id','0','$vc_batch_bt','$vc_batch_visp','','$vc_btaccountcode','$vc_refnum','$vc_visprefnum','$btuserordertype_id','0','$vca_availreasoncode','$btproduct_id','$vispproduct_id','$vc_title','$vc_surname','$vc_firstname','$vc_initials','$vc_premisesname','$vc_houseno','$vc_street','$vc_city','$vca_postcode','$vca_cli','$vca_exchangecode','$vc_contactphone','$vc_orderdate','$vc_reqdeliverydate','0','0','0','0','$vc_notes','$vc_resellernotes','$userbw_id','$usercr_id','$userrealm_id','$visp_id','$domain1_id','$domain2_id','$domain3_id','$vc_carelevel','$vc_confirmations','ip','$vca_user','$vc_state','$enterdate','0','0','0','$vc_migkey')");


      add_vchistory($vca_id);
      }
    }


// --> BTOK ENDE
  }
  if ($debug) echo ("$vca_availreasoncode<br>"); 
?>