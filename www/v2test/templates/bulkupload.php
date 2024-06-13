<?php
$timestamp=time();
$destfile='/var/www/crm/mwerkcrm/bulks/bulkorder.'.$timestamp;
if (move_uploaded_file($bulkfile,$destfile)==0)
  {
  echo("<b class=red>i<h4>ERROR BATCH UPLOAD</h4></b>");
  echo("$bulkfile   x  $destfile<hr>");
}
else
  {
  echo("<b class=red><h4>BATCH UPLOAD SUCCESSFUL<br>YOUR ORDERS WILL BE PROCESSED</h4></b>
  <b class=red><h4>YOUR BATCH ID: $timestamp</h4></b>
  ");
  echo("<hr>");
  
  $lines = file ($destfile);

  foreach ($lines as $line_num => $line) {
    if ($line_num <> 0) {
//"AccountCode","BuyerRefNum","BuyerParty","OrderType","Title","FirstName","Initials","LastName","HouseNumber","StreetName","City","PostCode","CLI","ContactPhone","ProductName","ProductBandwidth","ProductContention","DomainName"
      chop($line);
      $line_element = explode (",", $line);
      echo "<br><b>{$line_num}</b> : " . htmlspecialchars($line) . "<br>\n";
      //print_r($line_element);
      $vc_btaccountcode=$line_element[0];
      $vc_btaccountcode=str_replace("\"", "", $btaccountcode);
      $vc_refnum=$line_element[1];
      $vc_refnum=str_replace("\"", "", $refnum);
      $vc_title=$line_element[4];
      $vc_title=str_replace("\"", "", $vc_title);
      $vc_firstname=$line_element[5];
      $vc_firstname=str_replace("\"", "", $vc_firstname);
      $vc_initials=$line_element[6];
      $vc_initials=str_replace("\"", "", $vc_initials);
      $vc_surname=$line_element[7];
      $vc_surname=str_replace("\"", "", $vc_surname);
      $vc_houseno=$line_element[8];
      $vc_houseno=str_replace("\"", "", $vc_houseno);
      $vc_street=$line_element[9];
      $vc_street=str_replace("\"", "", $vc_street);
      $vc_city=$line_element[10];
      $vc_city=str_replace("\"", "", $vc_city);
      $vc_postcode=$line_element[11];
      $vca_postcode=str_replace("\"", "", $vc_postcode);
      $vc_cli=$line_element[12];
      $vc_cli=str_replace("\"", "", $vc_cli);
      $vc_contactphone=$line_element[13];
      $vc_contactphone=str_replace("\"", "", $vc_contactphone);
      //need to get the id of followings vars from the database
      $vc_userbw=$line_element[15];
      $vc_userbw=str_replace("\"", "", $vc_userbw);
      $result=mysql_query("SELECT `userbw_id` FROM `dslprov_userbw` WHERE `userbw_value` LIKE $vc_userbw");
      $rowarray=mysql_fetch_array($result);
      $userbw_id=$rowarray[0];
      print_r($rowarray);
      
      $vc_usercr=$line_element[16];
      $vc_usercr=str_replace("\"", "", $vc_usercr);
      $result=mysql_query("SELECT `usercr_id` FROM `dslprov_usercr` WHERE `usercr_value` LIKE $vc_usercr");
      $rowarray=mysql_fetch_array($result);
      $usercr_id=$rowarray[0];
      
      $vc_userrealm=$line_element[17];
      $vc_userrealm=str_replace("\"", "", $vc_userrealm);
      $result=mysql_query("SELECT `userrealm_id` FROM `dslprov_userrealm` WHERE `userrealm_value` LIKE '$vc_userrealm'");
      $rowarray=mysql_fetch_array($result);
      $userrealm_id=$rowarray[0];
      $userrealm_id=1;
      
      $btproduct_id=0;
 
      $vca_time=time();
      if($vca_batch == $vca_time) {
        $vca_offset++;
      }
      else {
        $vca_offset=0;
      }
      $vc_batch_bt=$timestamp;
      $vc_batch_visp=$timestamp;
      
      $ordermode=1;
      $action='vcorder';
      require("templates/availcheck.php");
      require("templates/ordercheck.php");
      echo("<hr>");
      $vca_batch = floor($vca_id/100);
    }
  }

}
?>
