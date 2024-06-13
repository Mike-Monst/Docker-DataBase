<?php 
    echo "Miguel";
    $client = new SoapClient('https://ssl.ibanrechner.de/soap/?wsdl');
    $result = $client->validate_iban("$vc_bankiban", 'mwerk', 'cx10006'); 
    echo "$result";
    echo "$client";
?>