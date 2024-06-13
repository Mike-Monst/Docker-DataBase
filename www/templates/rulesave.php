<?php
echo("<h4>RULES HAVE BEEN SAVED.</h4><br>");

  MYSQL_QUERY("update dslprov_rules set btproduct_vpok_pref1='$btproduct_vpok_pref1',btproduct_vpok_pref2='$btproduct_vpok_pref2',btproduct_vpok_pref3='$btproduct_vpok_pref3',btproductbw_vpok_pref1='$btproductbw_vpok_pref1',btproductbw_vpok_pref2='$btproductbw_vpok_pref2',btproductbw_vpok_pref3='$btproductbw_vpok_pref3',btproduct_novp_pref1='$btproduct_novp_pref1',btproduct_novp_pref2='$btproduct_novp_pref2',btproduct_novp_pref3='$btproduct_novp_pref3',btproductbw_novp_pref1='$btproductbw_novp_pref1',btproductbw_novp_pref2='$btproductbw_novp_pref2',btproductbw_novp_pref3='$btproductbw_novp_pref3',vc_leadtime='$vc_leadtime',vp_leadtime='$vp_leadtime' where 1");


?>
