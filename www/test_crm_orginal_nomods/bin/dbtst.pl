#!/usr/bin/perl

$vca_id=0;
open(CNT,">dbtst.sql") || die "Error";
while($vca_id<10000)
  {
  $vca_exchangecode="X".$vca_id;
  $vp_id=950000-$vca_id;
#  print CNT "INSERT INTO dslprov_vc VALUES ('$vca_id','$vp_id','0','$batch_id','','$vc_btaccountcode','$vc_refnum','$vc_visprefnum','$btuserordertype_id','0','$vca_availreasoncode','$btproduct_id','$vispproduct_id','$vc_title','$vc_surname','$vc_firstname','$vc_initials','$vc_premisesname','$vc_houseno','$vc_street','$vc_city','$vca_postcode','$vca_cli','$vc_contactphone','$vc_orderdate','$vc_reqdeliverydate','0','0','0','0','$vc_notes','$vc_resellernotes','$userbw_id','$usercr_id','$userrealm_id','$vc_carelevel','$vc_confirmations','$vca_user','$vc_state','0','0','0');\n";
        print CNT "INSERT INTO dslprov_vp VALUES ('$vp_id','$cal_id','$vca_exchangecode','0','1','0','','$vp_portres','0','','1','$vpbw_id','0','','$vp_bwdemand','$vptype_id','','','','','','','$vp_state','$vp_statechangedate','0','','$vp_updemandstate','$vp_updemandstatechangedate','0','','1');\n";


  $vca_id++;
  }
close(CNT);



