<?php
$server= "dbm1.mwerk.net";                // Adresse des Datenbankservers
$user= "crmweb1";                 // Benutzername
$passwort= "7vfvg4XrVacf";

if ($isp=='gustav')
  {
  $datenbank= "crmgustav";
  }
else if ($isp=='hugo')
  {
  $datenbank= "crmhugo";
  }
else if ($isp=='werknetz')
  {
  $datenbank= "crmwerknetz";
  }
else if ($isp=='innogyhvv')
  {
  $datenbank= "crminnogyhvv";
  }
else if ($isp=='novanetz')
  {
  $datenbank= "crmnovanetz";
  }
else if ($isp=='testisp')
  {
  $datenbank= "crmtestisp";
  }
            


//$server= "localhost";
//$user= "root";
//$passwort= "cux1004";
//$datenbank= "mwerkcrm";


  $conn=mysql_pconnect($server,$user,$passwort);
  $select = mysql_select_db($datenbank,$conn);

  mysql_query("SET NAMES 'utf8'");

// common vars

//$vc_leadtime=604800;
//$vp_leadtime=604800;

$limitinterval=50;

$page_index = array (
	10	=>	"search",
	20	=>	"availcheckcommon",
	21	=>	"btavailcheckadsl",
	22	=>	"btavailchecksdsl",
	30	=>	"ordercustomer",
	31	=>	"ordercustomerbatch",
	32	=>	"ordertracking",
	33	=>	"ordereditor",
	40	=>	"exchangeorder",
	41	=>	"exchangeupgrade",
	42	=>	"exchangetracking",
	43	=>	"exchangeeditor",
	50	=>	"report",
	60	=>	"billing",
	90	=>	"configuration"

);


function toggle_color($color,$color1,$color2)
  {
  if ($color==$color2)
    {
    return($color1);
    }
  else
    {
    return($color2);
    }
  }

function get_leadtimes(&$vcl,&$vpl)
  {
  $query="select * from dslprov_rules where 1";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $vcl=$ArticleTextRow['vc_leadtime'];
  $vpl=$ArticleTextRow['vp_leadtime'];
  $vcl*=86400;
  $vpl*=86400;
  }

function rulecheck($vpok,$bw,&$btp)
  {
  $query="select * from dslprov_rules where 1";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $btpok=$ArticleTextRow['btproduct_vpok_pref1'];
  $btpno=$ArticleTextRow['btproduct_novp_pref1'];
  $btbwok=$ArticleTextRow['btproductbw_vpok_pref1'];
  $btbwno=$ArticleTextRow['btproductbw_novp_pref1'];

  if ($vpok==1)
    {
    $btp=$btpok;
    $btbw=$btbwok;
    if ($btbw==0) { $btbw=get_userbw($bw); }
    }
  else
    {
    $btp=$btpno;
    $btbw=$btbwno;
    if ($btbw==0) { $btbw=get_userbw($bw); }
    }
  $query="select btproduct_id from dslprov_btproduct where btproduct_bw='$btbw' and btproduct_short='$btp'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $btproduct_id=$ArticleTextRow['btproduct_id'];

  return($btproduct_id);

  }


function add_vchistory($id)
  {
  $actualtime=time();
  MYSQL_QUERY("update dslprov_vc set vc_statechangedate='$actualtime' where vc_id='$id'");
  MYSQL_QUERY("insert into dslprov_vchistory (vc_id,vc_visprefnum,product_id,productadditional_id,productcap_id,vc_email,invoicemail_id,hardware_id,visp_id,vc_carelevel,vc_state,vc_state_voice,vc_statechangedate) select vc_id,vc_visprefnum,product_id,productadditional_id,productcap_id,vc_email,invoicemail_id,hardware_id,visp_id,vc_carelevel,vc_state,vc_state_voice,vc_statechangedate from dslprov_vc where vc_id='$id'");
  }

function add_vphistory($id)
  {
  $actualtime=time();
  MYSQL_QUERY("update dslprov_vp set vp_statechangedate='$actualtime' where vp_id='$id'");
  MYSQL_QUERY("insert into dslprov_vphistory (vp_id,vp_id,cal_id,exchange_id,vp_vpi,vp_portres,vp_portordered,vp_portordereddate,vp_portdemand,vpbw_id,vpbwordered_id,vp_bwordereddate,vp_bwdemand,vptype_id,vp_state,vp_statechangedate,vp_orderedstate,vp_orderedstatechangedate,vp_updemandstate,vp_updemandstatechangedate,vp_preferred) select vp_id,cal_id,exchange_id,vp_vpi,vp_portres,vp_portordered,vp_portordereddate,vp_portdemand,vpbw_id,vpbwordered_id,vp_bwordereddate,vp_bwdemand,vptype_id,vp_state,vp_statechangedate,vp_orderedstate,vp_orderedstatechangedate,vp_updemandstate,vp_updemandstatechangedate,vp_preferred from dslprov_vp where vp_id='$id'");
  }


function get_isodate($serialtime)
  {
  $isodate=date("Y-m-d",$serialtime);
  return($isodate);  
  }

function get_sertime($isodatetime)
  {
  $sertime=strtotime($isodatetime);
  return($sertime);
  }

function get_sertimenull($sertime)
  {
  $isotime=get_isodate($sertime);
  $sertimenull=get_sertime($isotime);
  return($sertimenull);
  }

function get_vcfault($id)
  {
  $query="select vcfault_text from dslprov_vcfault where vcfault_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return('-');
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['vcfault_text'];
  return($value);
  }


function get_product($id)
  {
  $query="select prod_name from dslprov_product where prod_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['prod_name'];
  return($value);
  }

function get_productadditional($id)
  {
  $query="select prod_name from dslprov_productadditional where prod_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['prod_name'];
  return($value);
  }


function get_productcap($id)
  {
  $query="select btproduct_value from dslprov_productcap where btproduct_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['btproduct_value'];
  return($value);
  }

function get_userrealmmprice($id)
  {
  $query="select userrealm_mprice from dslprov_userpricing where userrealm_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['userrealm_mprice'];
  return($value);
  }
function get_userrealmiprice($id)
  {
  $query="select userrealm_iprice from dslprov_userpricing where userrealm_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['userrealm_iprice'];
  return($value);
  }

function calc_vpusage($id)
  {
  $query="select vp_portres,vp_portdemand,vpbw_id,vp_bwdemand from dslprov_vp where vp_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    $errflag=1;
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value1=$ArticleTextRow['vp_portres'];
  $value2=$ArticleTextRow['vp_portdemand'];
  if ($value1<=0)
    {
    $vp_portsperc=0;
    }
  else
    {
    $vp_portsperc=$value2/$value1;
    }

  $value3=$ArticleTextRow['vpbw_id'];
  $bwvalue=get_vpbw($value3);
  $value4=$ArticleTextRow['vp_bwdemand'];

  if ($bwvalue<=0)
    {
    $vp_bwperc=0;
    }
  else
    {
    $vp_bwperc=$value4/$bwvalue;
    }
  if ($errflag==1)
    {
    $vp_bwperc=-1;
    $vp_portsperc=-1;
    }

  MYSQL_QUERY("update dslprov_vp set vp_portsperc='$vp_portsperc',vp_bwperc='$vp_bwperc' where vp_id='$id'");

  }


function get_vptype($id)
  {
  $query="select vptype_value from dslprov_vptype where vptype_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['vptype_value'];
  return($value);
  }

function get_vpbw($id)
  {
  $query="select vpbw_value from dslprov_vpbw where vpbw_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['vpbw_value'];
  return($value);
  }

function get_vpbwid_from_userbwid($id)
  {
  $query="select userbw_value from dslprov_userbw where userbw_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['userbw_value'];

  $query="select vpbw_id from dslprov_vpbw where vpbw_value='$value'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['vpbw_id'];

  return($value);

  }


function get_capproduct($id)
  {
  $query="select btproduct_value from dslprov_productcap where btproduct_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['btproduct_value'];
  return($value);
  }

function get_btproductshort($id)
  {
  $query="select btproduct_short from dslprov_btproduct where btproduct_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['btproduct_short'];
  return($value);
  }

function get_btproductbw($id)
  {
  $query="select btproduct_bw from dslprov_btproduct where btproduct_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['btproduct_bw'];
  return($value);
  }

function get_btproducttype($id)
  {
  $query="select btproduct_type from dslprov_btproduct where btproduct_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['btproduct_type'];
  return($value);
  }

function get_vispproduct($id)
  {
  $query="select vispproduct_value from dslprov_vispproduct where vispproduct_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['vispproduct_value'];
  return($value);
  }


function get_btuserorderstate($id)
  {
  $query="select btuserorderstate_value from dslprov_btuserorderstate where btuserorderstate_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['btuserorderstate_value'];
  return($value);
  }

function get_btuserordertype($id)
  {
  $query="select btuserordertype_value from dslprov_btuserordertype where btuserordertype_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['btuserordertype_value'];
  return($value);
  }

function get_btuserordertypeid($id)
  {
  $query="select btuserordertype_id from dslprov_vc where vc_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['btuserordertype_id'];
  return($value);
  }

function get_btvporderstate($id)
  {
  $query="select btvporderstate_value from dslprov_btvporderstate where btvporderstate_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['btvporderstate_value'];
  return($value);
  }

function get_btvpordertype($id)
  {
  $query="select btvpordertype_value from dslprov_btvpordertype where btvpordertype_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['btvpordertype_value'];
  return($value);
  }

function get_vcstate($id)
  {
  $query="select vcstate_value from dslprov_vcstate where vcstate_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['vcstate_value'];
  return($value);
  }

function get_vpstate($id)
  {
  $query="select vpstate_value from dslprov_vpstate where vpstate_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['vpstate_value'];
  return($value);
  }
function get_vpdsuk($id)
  {
  $query="select vp_dsuk from dslprov_vp where vp_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['vp_dsuk'];
  return($value);
  }

function get_calname($id)
  {
  $query="select cal_name from dslprov_cal where cal_id='$id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $value=$ArticleTextRow['cal_name'];
  return($value);
  }

function bt_adsl_checker($checker_input, $checker_type) {
        // these vars are common configuration options
        $checker_user = 'O/M306687';
        $checker_pass = 'tfu8700s';
        $checker_version = '7';
        $checker_site = 'http://www.adslchecker.bt.com/pls/adsl/adslchecker_xml';
        // generate the URL
        $checker_url = $checker_site . '.' . $checker_type . '?Username=' . $checker_user . '00&Password=' . $checker_pass . 'n&Version=' .'
&Input=' . $checker_input;
        #'https://www.adslchecker.bt.com/pls/adsl/adslchecker_xml.telno?Username=O/M30668700&Password=tfu8700sn&Version=7&Input=01635278102'
;
        /* FIXME:set error_reporting from E_WARNING to E_ERROR not to show users SSL Errors. This is a bug with the current PHP implementati
on. Once it is fixed this should be removed.*/
        error_reporting(1);

        if (!$checker_data = implode("", file($checker_url))) {
                echo "BT not accessible. FIXME What has to be done, if availchecker is called in a batch.";
        };
        if (!$checker_parser = xml_parser_create()) {
                echo "Could not open XML parser. FIXME What has to be done, if availchecker is caled in a batch";
        };
        if (!xml_parse_into_struct($checker_parser, $checker_data, $checker_vals, $checker_index)) {
                echo "Availchecker data from BT was not valid.\n $checker_url\n";
        };

        xml_parser_free($checker_parser);

        $checker_result = array();

        foreach ($checker_vals as $checker_val){
                switch ($checker_val['type']) {
                        case 'cdata:':
                                break;
                        case 'complete':
                                $checker_result[$checker_val['tag']] .= trim($checker_val['value']);
                                break;
                        case 'open':
                                break;
                        case 'close':
                                break;
                }
        }
        //unset everything, which is not longer needed
        unset($checker_user);
        unset($checker_pass);
        unset($checker_version);
        unset($checker_site);
        unset($checker_input);
        unset($checker_type);
        unset($checker_parser);
        unset($checker_vals);
        unset($checker_val);

        // set error reporting to E_WARNING again
        error_reporting(2);

        return $checker_result;
}


function bt_sdsl_checker($checker_input, $checker_type) {
        // these vars are common configuration options
        $checker_version = '2';
        $checker_site = 'http://www.adslchecker.bt.com/pls/sdsl/SDSLChecker.welcome?';
        // generate the URL
        $checker_url = $checker_site . 'Version=' . $checker_version . '&ReturnType=XML&' . $checker_type . '=' . $checker_input . '&SP_Name=test';
//      http://www.adslchecker.bt.com/pls/sdsl/SDSLChecker.welcome?Version=2&ReturnType=XML&TelNo=01635278102&SP_Name=test
        /* FIXME:set error_reporting from E_WARNING to E_ERROR not to show users SSL Errors. This is a bug with the current PHP implementation. Once it is fixed this should be removed.*/
        error_reporting(1);

        if (!$checker_data = implode("", file($checker_url))) {
                echo "BT not accessible. FIXME What has to be done, if availchecker is called in a batch.";
        };
        if (!$checker_parser = xml_parser_create()) {
                echo "Could not open XML parser. FIXME What has to be done, if availchecker is caled in a batch";
        };
        if (!xml_parse_into_struct($checker_parser, $checker_data, $checker_vals, $checker_index)) {
                echo "Availchecker data from BT was not valid.\n $checker_url\n";
        };

        xml_parser_free($checker_parser);

        $checker_result = array();

        foreach ($checker_vals as $checker_val){
                switch ($checker_val['type']) {
                        case 'cdata:':
                                break;
                        case 'complete':
                                $checker_result[$checker_val['tag']] .= trim($checker_val['value']);
                                break;
                        case 'open':
                                break;
                        case 'close':
                                break;
                }
        }

        //unset everything, which is not longer needed
        unset($checker_version);
        unset($checker_site);
        unset($checker_input);
        unset($checker_type);
        unset($checker_parser);
        unset($checker_vals);
        unset($checker_val);

        // set error reporting to E_WARNING again
        error_reporting(2);

        return $checker_result;
}

function bt_dsl_checker_input_parser ( $input ) {
        if (preg_match('/^[0-9]+$/',$input) & strlen($input) >= 9) {
                $result='telno';
        }
        elseif (preg_match('/^[a-z0-9\ ]+$/i',$input) & strlen($input)>=3 & strlen($input)<=8 ) {
                $result='postcode';
        }
        return $result;
}


?>
