<?php

$isp='innogyhvv';
//$isp='hugo';

require("config.inc.php");

    $query="select vc_visprefnum,vc_bankiban from dslprov_vc where vc_bankbic = '' and vc_state>25";
    $cresult=mysql_query($query);
    $number=mysql_num_rows($cresult);
     for ($i=0;$i < mysql_num_rows($cresult);$i++)
       {
       $row = mysql_fetch_row($cresult);
       $j=0;
       print_r("\n$row[0] X $row[1] ");
       $vc_bankiban=$row[1];
       $vc_vispref=$row[0];

// $vc_bankiban='DE17586915000009101318';
  $client = new SoapClient('https://ssl.ibanrechner.de/soap/?wsdl');
    $result = $client->validate_iban("$vc_bankiban", 'mwerk', 'cx10006');
//    print_r($result);
    
    $resbic=$result->bic_candidates[0]->bic;
    
    
    print_r("$resbic \n");

    $resiban=$result->iban;
    $resresult=$result->result;
    $resreturncode=$result->return_code;
    $resbankcode=$result->bank_code;
    $resbank=$result->bank;
                $resaccount=$result->account_number;
                  $lcheck=$result->length_check;
                    $acheck=$result->account_check;
                      $bcheck=$result->bank_code_check;
                      
                        if ($resresult=='passed')
                            {
                                print "OK\n";
                                    }
                                      else
                                          {
                                                                            }
                                                                            

       MYSQL_QUERY("UPDATE `dslprov_vc` SET `vc_bankbic` = '$resbic' WHERE `dslprov_vc`.`vc_visprefnum` = $vc_vispref;"); 
       }

                                                                            
?>                                                                            