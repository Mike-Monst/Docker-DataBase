<?php

//$isp="hugo";

$avail_city_coded=str_replace(" ","+",$avail_city);
$avail_str_coded=str_replace(" ","+",$avail_str);
$avail_nr_coded=str_replace(" ","+",$avail_nr);

echo "$isp:$avail_str_coded:$avail_nr_coded:$avail_postcode:$avail_city_coded";
$output = shell_exec("/var/www/crm/bin/vcn_availcheck.pl $isp:$avail_str_coded:$avail_nr_coded:$avail_postcode:$avail_city_coded");

echo $output;

chop($output);

if ($output == 99999)
  {
  $vca_errorid=1;
  $output='ERROR';
  }
else
  {
  $vca_errorid=0;
  $prod = explode("|", $output);
  $countprod=count($prod)-1;
  //echo $countprod;
  print"<br><br><b>Verf&uuml;gbare Vorprodukte:<br>";
  for ($i=0;$i < $countprod;$i++)
    {
    $prodteile = explode(";", $prod[$i]);
    print "$prodteile[0]<br>";
    }
  print"</b><br>";  
  }

// eigene Felder
$vca_id=(time()*100)+$vca_offset;


$vca_checkmode=$ordermode;  // 0 check 1 order
  
  //MYSQL_QUERY("INSERT INTO dslprov_vcavail VALUES ('$vca_id','$vca_checkmode','$isp','$avail_str','$avail_nr','$avail_postcode','$avail_city','$vca_errorid','$output')");
  //MYSQL_QUERY("INSERT INTO dslprov_vcavail VALUES ('$vca_id','$vca_cli','$vca_user','$vca_errorid','$vca_inputtype','$vca_fixedrate','$vca_rateadaptive','$vca_exchangecode','$vca_exchangename','$vca_reasoncode','$vca_readydate','$vca_exchangestate','$vca_trigger','$vca_rtpc','$vca_postcode','$vca_caphome','$vca_capoffice','$vca_suggmesg','$vca_supplmesg','$vca_checkmode')");  


$vca_availreasoncode='BTOK';
echo ("<h4>Availcheckcode: $vca_availreasoncode $vca_errorid</h4>");

?>
