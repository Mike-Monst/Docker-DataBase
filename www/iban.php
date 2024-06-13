    <?php
include( 'login.inc.php' );
$conid = db_connect();

    
    $client = new SoapClient('https://ssl.ibanrechner.de/soap/?wsdl');
    $result = $client->calculate_iban('DE', '50010517', '648479930', 'mwerk', 'cx10006');
    print"<pre>";
    print_r($result);
    print"</pre>";

    $resiban=$result->iban;
    $resresult=$result->result;
    $resreturncode=$result->return_code;
    $resbankcode=$result->bank_code;
    $resbank=$result->bank;
    $resaccount=$result->account_number;
    $lcheck=$result->length_check;
    $acheck=$result->account_check;
    $bcheck=$result->bank_code_check;
                
    print "$resiban $resresult $resreturncode";        
            
    ?>