<?
// https aufruf

// aus dem availchecker zu lesen:


$vca_errorid=0;
$vca_cli=$vc_cli;  // input
$vca_inputtype='telno';
$vca_fixedrate='G';
$vca_rateadaptive='G';
$vca_exchangecode='XXXXX';
$vca_exchangename='XXXXXXXXXXXXXXX';
$vca_reasoncode='Z';
$vca_readydate='00-00-0000';
$vca_exchangestate='E';
$vca_trigger=0;
$vca_rtpc='Y';
#$vca_postcode='XXX XXX';
$vca_caphome='00-00-0000';
$vca_capoffice='00-00-0000';
$vca_suggmesg='BLA';
$vca_supplmesg='BLA2';


// MAIN
$checker_input=$vca_cli;
$checker_input = preg_replace('/\ /', '', $checker_input); /* input must not contain any whitspaces */
$checker_input = preg_replace('/\"/', '', $checker_input); /* input must not contain any quotation marks from batch */
//echo "$checker_input\n";
$checker_type = bt_dsl_checker_input_parser($checker_input);
//echo "$checker_type\n";
//$checker_result = bt_adsl_checker($checker_input, $checker_type);
//echo "<pre>";
//echo "<hr>";

// result raw output
#print_r($checker_result);

// query for local check

$query = 'SELECT `exchange_id` FROM `dslprov_btcliranges` WHERE `cliranges_from` <= \'' . $checker_input . '\' AND `cliranges_to` >= \'' . $checker_input. '\'';
$result = mysql_query("$query");
$number = mysql_num_rows($result);
$text = mysql_fetch_array($result);
#print_r($text);
$vca_exchangecode=$text['exchange_id'];
#echo "<table>\n";
#while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
#   echo "\t<tr>\n";
#   foreach ($line as $col_value) {
#       echo "\t\t<td>$col_value</td>\n";
#   }
#   echo "\t</tr>\n";
#}
#echo "</table>\n";

if ($number == 0 ) {
	echo "<h3>This is not a valid phonenumber. Please check and try again</h3>";
	$vca_errorid = 9;
}
else {
	$query = "SELECT * FROM `dslprov_btexchange` WHERE `exchange_id` LIKE '$vca_exchangecode'";
	$result = mysql_query("$query");
	$number = mysql_num_rows($result);
	$line = mysql_fetch_array($result);
#	print_r($line);

	$vca_exchangecode=$line['exchange_id'];
	$vca_exchangename=$line['exchange_name'];
	$vca_readydate=$line['exchange_targetdatecomm'];
	if ($line['exchange_acceptorders'] == 'Yes') {
		$vca_reasoncode='Z';
		$vca_exchangestate='E';
	}
	else {
		$vca_reasoncode='P';
		$vca_exchangestate='P';
	}
	echo"<h3>$checker_input</h3><h3>$vca_exchangecode</h3><h4>Friendly Exchangename: $vca_exchangename</h4><br>";
}
//echo "<hr>";

//print_r ($checker_result);

echo "</pre>";

// eigene Felder
$vca_id=(time()*100)+$vca_offset;
$vca_user='BIOSTEL';
$vca_availreasoncode='BT-';

$vca_checkmode=$ordermode;  // 0 check 1 order
  
  MYSQL_QUERY("INSERT INTO dslprov_vcavail VALUES ('$vca_id','$vca_cli','$vca_user','$vca_errorid','$vca_inputtype','$vca_fixedrate','$vca_rateadaptive','$vca_exchangecode','$vca_exchangename','$vca_reasoncode','$vca_readydate','$vca_exchangestate','$vca_trigger','$vca_rtpc','$vca_postcode','$vca_caphome','$vca_capoffice','$vca_suggmesg','$vca_supplmesg','$vca_checkmode')");  

if ($vca_errorid!=0)
  {
  $vca_availreasoncode="B-$vca_errorid";
  }
else
  {
  if ($vca_rateadaptive=='R')
    {
    $vca_availreasoncode='B-V';
    }
  else
    {
    if ($vca_exchangestate!='E')
      {
      if ($vca_readydate!='')
        {
        $vca_availreasoncode="B-$vca_exchangestate:$vca_readydate";
        }
      else
        {
        $vca_availreasoncode="B-$vca_exchangestate";
        }
      }
    else
      {
      if ($vca_reasoncode=='Z')
        {
        $vca_availreasoncode='BTOK';
        }
      else if (($vca_reasoncode=='A')||($vca_reasoncode=='P'))
        {
        $vca_availreasoncode='B-I';
        }
      else
        {
        $vca_availreasoncode='B-C';
        }
      }
    }
  }


echo ("<h4>Availcheckcode: $vca_availreasoncode</h4>");

?>
