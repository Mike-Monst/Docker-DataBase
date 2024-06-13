<?php

$server="localhost";
$user= "crmweb1";                 // Benutzername
$passwort= "7vfvg4XrVacf";

  $datenbank= "crmnovanetz";
  $conn=mysql_pconnect($server,$user,$passwort);
  $select = mysql_select_db($datenbank,$conn);





//$number=1;
  if ($number>0)
    {
    echo("<h4>Inventory Error: CLI double</h4><br>");
    $vca_availreasoncode='T-CLI';
    }
  else
    {
  }


// echo("SELECT b.vcfault_id,b.vcfault_text  FROM `dslprov_vc` a,`dslprov_vcfault` b WHERE `vc_errorcode` != 0 and  a.vc_errorcode & b.vcfault_id and vc_id=$vc_id");
//$qfault="SELECT b.vcfault_id,b.vcfault_text  FROM `dslprov_vc` a,`dslprov_vcfault` b WHERE `vc_errorcode` != 0 and  a.vc_errorcode & b.vcfault_id and vc_id=$vc_id;";
//$rfault=mysql_query($qfault);
//echo("<table>");
//  for ($fi=0;$fi < mysql_num_rows($rfault);$fi++)
//    {
//    $frow = mysql_fetch_row($rfault);
//    $fj=0;
//    foreach ($frow as $fvalue)
//      {
//      echo("<tr><td>$fvalue</td></tr>");
//echo(" -> $fvalue "); 
//      }
//    }
//echo("</table>");

$queryl="select * from dslprov_locations where location_id LIKE '1'";
$resultl=mysql_query($queryl);
$numberl=mysql_num_rows($resultl);
$rowarray=mysql_fetch_array($resultl);
                        
$vc_conn_city=$rowarray['location_city'];
$vc_conn_citysubloc=$rowarray['location_citysubloc'];
$vc_conn_postcode=$rowarray['location_postcode'];
$ltype=$rowarray['location_type'];

echo("$vc_conn_city");


?>
