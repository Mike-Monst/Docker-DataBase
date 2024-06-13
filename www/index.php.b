<?php

// Session Login Handling Start
// Erzwingen das Session-Cookies benutzt werden und die SID nicht per URL transportiert wird
$cisp = ( ! empty( $_POST[ 'cisp' ] ) ) ? $_POST[ 'cisp' ] : false;
if (strlen($cisp)>0)
  {
//  echo("x $cisp");
  }
ini_set( 'session.use_only_cookies', '1' );
ini_set( 'session.use_trans_sid', '0' );

session_start();
include( 'login.inc.php' );
$conid = db_connect();

if (!checkUser( $conid )) { resetUser(); }
if ($_GET['benutzer'] == 'abmelden') { resetUser(); }
// Session Login Handling Ende
    $selfurl=$_SERVER['PHP_SELF'];
    $loggedinuser=$_SESSION['loggedinuser'];
    $isp=$_SESSION['isp'];
    if (strlen($cisp)>0)
      {
      $_SESSION['isp']=$cisp;
      $isp=$cisp;
      }

$debug=0;

  require("config.inc.php");


//  $tmode=1;

  if ($tmode!=1)
    {
    include("templates/header.php");
    }


$upfile = ( ! empty( $_POST[ 'upfile' ] ) ) ? $_POST[ 'upfile' ] : false;


$changeinfo = ( ! empty( $_GET[ 'changeinfo' ] ) ) ? $_GET[ 'changeinfo' ] : false;
if (strlen($changeinfo)>0)
  {
  // DB
  MYSQL_QUERY("UPDATE `dslprov_vc` SET vc_confirmations=1 WHERE vc_visprefnum=$changeinfo;");
  }
$resetstate1 = ( ! empty( $_GET[ 'resetstate1' ] ) ) ? $_GET[ 'resetstate1' ] : false;
if (strlen($resetstate1)>0)
  {
  // DB
  MYSQL_QUERY("UPDATE `dslprov_vc` SET vc_state=22,vc_state_voice=22 WHERE vc_visprefnum=$resetstate1;");
  }
$resetstate3 = ( ! empty( $_GET[ 'resetstate3' ] ) ) ? $_GET[ 'resetstate3' ] : false;
if (strlen($resetstate3)>0)
  {
  // DB
  MYSQL_QUERY("UPDATE `dslprov_vc` SET vc_state=22,vc_state_voice=22 WHERE vc_visprefnum=$resetstate3;");
  }
$setprod = ( ! empty( $_GET[ 'setprod' ] ) ) ? $_GET[ 'setprod' ] : false;
$syncdl = ( ! empty( $_GET[ 'syncdl' ] ) ) ? $_GET[ 'syncdl' ] : false;
$syncup = ( ! empty( $_GET[ 'syncup' ] ) ) ? $_GET[ 'syncup' ] : false;
$attdl = ( ! empty( $_GET[ 'attdl' ] ) ) ? $_GET[ 'attdl' ] : false;
$attup = ( ! empty( $_GET[ 'attup' ] ) ) ? $_GET[ 'attup' ] : false;

$setprodkrm = ( ! empty( $_GET[ 'setprodkrm' ] ) ) ? $_GET[ 'setprodkrm' ] : false;

$setproddate = ( ! empty( $_GET[ 'setproddate' ] ) ) ? $_GET[ 'setproddate' ] : false;
$stparts=explode(".",$setproddate);
$setproddate=$stparts[2].'.'.$stparts[1].'.'.$stparts[0];

$setrepair = ( ! empty( $_GET[ 'setrepair' ] ) ) ? $_GET[ 'setrepair' ] : false;
$setrepairdate = ( ! empty( $_GET[ 'setrepairdate' ] ) ) ? $_GET[ 'setrepairdate' ] : false;
$strparts=explode(".",$setrepairdate);
$setrepairdate=$strparts[2].'.'.$strparts[1].'.'.$strparts[0];
$setrepairtime = ( ! empty( $_GET[ 'setrepairtime' ] ) ) ? $_GET[ 'setrepairtime' ] : false;

$setnewreq = ( ! empty( $_GET[ 'setnewreq' ] ) ) ? $_GET[ 'setnewreq' ] : false;
$setnewreqdate = ( ! empty( $_GET[ 'setnewreqdate' ] ) ) ? $_GET[ 'setnewreqdate' ] : false;
$stnrparts=explode(".",$setnewreqdate);
$setnewreqdate=$stnrparts[2].'.'.$stnrparts[1].'.'.$stnrparts[0];


$setrdd = ( ! empty( $_GET[ 'setrdd' ] ) ) ? $_GET[ 'setrdd' ] : false;
$setrdddate = ( ! empty( $_GET[ 'setrdddate' ] ) ) ? $_GET[ 'setrdddate' ] : false;
$strddparts=explode(".",$setrdddate);
$setrdddate=$strddparts[2].'.'.$strddparts[1].'.'.$strddparts[0];



echo("$setprod $setproddate $setnewreq $setnewreqdate");
if (strlen($setprod)>0)
  {
  // DB
  MYSQL_QUERY("UPDATE `dslprov_vc` SET vc_state=30,vc_state_voice=30,vc_productiondate='$setproddate',bwsyncdl=$syncdl,bwsyncup=$syncup,bwattdl=$attdl,bwattup=$attup WHERE vc_visprefnum=$setprod;");
  }
if (strlen($setprodkrm)>0)
  {
  // DB
  MYSQL_QUERY("UPDATE `dslprov_vc` SET vc_state=31,vc_state_voice=31,vc_productiondate='$setproddate',bwsyncdl=1,bwsyncup=1,bwattdl=1,bwattup=1 WHERE vc_visprefnum=$setprodkrm;");
  }
if (strlen($setrepair)>0)
  {
  // DB
  MYSQL_QUERY("UPDATE `dslprov_vc` SET vc_state=27,vc_state_voice=27,vc_newreqdate='$setrepairdate',vc_newreqtime='$setrepairtime',vc_errorcode='REPAIR' WHERE vc_visprefnum=$setrepair;");
  }
if (strlen($setnewreq)>0)
  {
  // DB
//echo ("DA");
  MYSQL_QUERY("UPDATE `dslprov_vc` SET vc_state=27,vc_state_voice=27,vc_newreqdate='$setnewreqdate',vc_errorcode='NEWREQ' WHERE vc_visprefnum=$setnewreq;");
  }
  
// $name = test_input($_GET["name"]);   FRAUD pruefen fuer alle variablen

$page = ( ! empty( $_GET[ 'page' ] ) ) ? $_GET[ 'page' ] : false;
$action = ( ! empty( $_GET[ 'action' ] ) ) ? $_GET[ 'action' ] : false;

if ($page =='')
  {
  $page = ( ! empty( $_POST[ 'page' ] ) ) ? $_POST[ 'page' ] : false;
  $action = ( ! empty( $_POST[ 'action' ] ) ) ? $_POST[ 'action' ] : false;
  }



$avail_str = ( ! empty( $_GET[ 'avail_str' ] ) ) ? $_GET[ 'avail_str' ] : false;
$avail_nr = ( ! empty( $_GET[ 'avail_nr' ] ) ) ? $_GET[ 'avail_nr' ] : false;
$avail_postcode = ( ! empty( $_GET[ 'avail_postcode' ] ) ) ? $_GET[ 'avail_postcode' ] : false;
$avail_city = ( ! empty( $_GET[ 'avail_city' ] ) ) ? $_GET[ 'avail_city' ] : false;

// OLD
$vc_cli = ( ! empty( $_GET[ 'vc_cli' ] ) ) ? $_GET[ 'vc_cli' ] : false;
$userbw_id = ( ! empty( $_GET[ 'userbw_id' ] ) ) ? $_GET[ 'userbw_id' ] : false;
$usercr_id = ( ! empty( $_GET[ 'usercr_id' ] ) ) ? $_GET[ 'usercr_id' ] : false;
$userrealm_id = ( ! empty( $_GET[ 'userrealm_id' ] ) ) ? $_GET[ 'userrealm_id' ] : false;

//NEW
$vc_visprefnum = ( ! empty( $_GET[ 'vc_visprefnum' ] ) ) ? $_GET[ 'vc_visprefnum' ] : false;
$vc_state = ( ! empty( $_GET[ 'vc_state' ] ) ) ? $_GET[ 'vc_state' ] : false;
$vc_state_voice = ( ! empty( $_GET[ 'vc_state_voice' ] ) ) ? $_GET[ 'vc_state_voice' ] : false;
$limit = ( ! empty( $_GET[ 'limit' ] ) ) ? $_GET[ 'limit' ] : false;
$vc_orderdate = ( ! empty( $_GET[ 'vc_orderdate' ] ) ) ? $_GET[ 'vc_orderdate' ] : false;
$orderdatefrom = ( ! empty( $_GET[ 'orderdatefrom' ] ) ) ? $_GET[ 'orderdatefrom' ] : false;
$orderdateto = ( ! empty( $_GET[ 'orderdateto' ] ) ) ? $_GET[ 'orderdateto' ] : false;
$vc_commitdate = ( ! empty( $_GET[ 'vc_commitdate' ] ) ) ? $_GET[ 'vc_commitdate' ] : false;
$commitdatefrom = ( ! empty( $_GET[ 'commitdatefrom' ] ) ) ? $_GET[ 'commitdatefrom' ] : false;
$commitdateto = ( ! empty( $_GET[ 'commitdateto' ] ) ) ? $_GET[ 'commitdateto' ] : false;
$vc_commitdate2 = ( ! empty( $_GET[ 'vc_commitdate2' ] ) ) ? $_GET[ 'vc_commitdate2' ] : false;
$commitdate2from = ( ! empty( $_GET[ 'commitdate2from' ] ) ) ? $_GET[ 'commitdate2from' ] : false;
$commitdate2to = ( ! empty( $_GET[ 'commitdate2to' ] ) ) ? $_GET[ 'commitdate2to' ] : false;
$vc_commitdate3 = ( ! empty( $_GET[ 'vc_commitdate3' ] ) ) ? $_GET[ 'vc_commitdate3' ] : false;
$commitdate3from = ( ! empty( $_GET[ 'commitdate3from' ] ) ) ? $_GET[ 'commitdate3from' ] : false;
$commitdate3to = ( ! empty( $_GET[ 'commitdate3to' ] ) ) ? $_GET[ 'commitdate3to' ] : false;
$vc_installationdate = ( ! empty( $_GET[ 'vc_installationdate' ] ) ) ? $_GET[ 'vc_installationdate' ] : false;
$installationdatefrom = ( ! empty( $_GET[ 'installationdatefrom' ] ) ) ? $_GET[ 'installationdatefrom' ] : false;
$installationsdateto = ( ! empty( $_GET[ 'installationsdateto' ] ) ) ? $_GET[ 'installationsdateto' ] : false;
$vc_canceldate = ( ! empty( $_GET[ 'vc_canceldate' ] ) ) ? $_GET[ 'vc_canceldate' ] : false;
$canceldatefrom = ( ! empty( $_GET[ 'canceldatefrom' ] ) ) ? $_GET[ 'canceldatefrom' ] : false;
$canceldateto = ( ! empty( $_GET[ 'canceldateto' ] ) ) ? $_GET[ 'canceldateto' ] : false;
$vc_productiondate = ( ! empty( $_GET[ 'vc_productiondate' ] ) ) ? $_GET[ 'vc_productiondate' ] : false;
$productiondatefrom = ( ! empty( $_GET[ 'productiondatefrom' ] ) ) ? $_GET[ 'productiondatefrom' ] : false;
$productiondateto = ( ! empty( $_GET[ 'productiondateto' ] ) ) ? $_GET[ 'productiondateto' ] : false;
$reqdeliverydatefrom = ( ! empty( $_GET[ 'reqdeliverydatefrom' ] ) ) ? $_GET[ 'reqdeliverydatefrom' ] : false;
$reqdeliverydateto = ( ! empty( $_GET[ 'reqdeliverydateto' ] ) ) ? $_GET[ 'reqdeliverydateto' ] : false;

$location_id = ( ! empty( $_GET[ 'location_id' ] ) ) ? $_GET[ 'location_id' ] : false;

$vc_batch_visp  = ( ! empty( $_GET[ 'vc_batch_visp' ] ) ) ? $_GET[ 'vc_batch_visp' ] : false;

// Voice

$product_id = ( ! empty( $_GET[ 'product_id' ] ) ) ? $_GET[ 'product_id' ] : false;
$productadditional_id = ( ! empty( $_GET[ 'productadditional_id' ] ) ) ? $_GET[ 'productadditional_id' ] : false;
$productcap_id = ( ! empty( $_GET[ 'productcap_id' ] ) ) ? $_GET[ 'productcap_id' ] : false;
$vc_salutation = ( ! empty( $_GET[ 'vc_salutation' ] ) ) ? $_GET[ 'vc_salutation' ] : false;
$vc_title = ( ! empty( $_GET[ 'vc_title' ] ) ) ? $_GET[ 'vc_title' ] : false;
$vc_surname = ( ! empty( $_GET[ 'vc_surname' ] ) ) ? $_GET[ 'vc_surname' ] : false;
$vc_firstname = ( ! empty( $_GET[ 'vc_firstname' ] ) ) ? $_GET[ 'vc_firstname' ] : false;
$vc_company = ( ! empty( $_GET[ 'vc_company' ] ) ) ? $_GET[ 'vc_company' ] : false;
$vc_birthday = ( ! empty( $_GET[ 'vc_birthday' ] ) ) ? $_GET[ 'vc_birthday' ] : false;
$vc_street = ( ! empty( $_GET[ 'vc_street' ] ) ) ? $_GET[ 'vc_street' ] : false;
$vc_houseno = ( ! empty( $_GET[ 'vc_houseno' ] ) ) ? $_GET[ 'vc_houseno' ] : false;
$vc_city = ( ! empty( $_GET[ 'vc_city' ] ) ) ? $_GET[ 'vc_city' ] : false;
$vc_citysubloc = ( ! empty( $_GET[ 'vc_citysubloc' ] ) ) ? $_GET[ 'vc_citysubloc' ] : false;
$vc_postcode = ( ! empty( $_GET[ 'vc_postcode' ] ) ) ? $_GET[ 'vc_postcode' ] : false;
$vc_contactfirstname = ( ! empty( $_GET[ 'vc_contactfirstname' ] ) ) ? $_GET[ 'vc_contactfirstname' ] : false;
$vc_contact = ( ! empty( $_GET[ 'vc_contact' ] ) ) ? $_GET[ 'vc_contact' ] : false;
$vc_contactphone = ( ! empty( $_GET[ 'vc_contactphone' ] ) ) ? $_GET[ 'vc_contactphone' ] : false;
$vc_contactphonepre = ( ! empty( $_GET[ 'vc_contactphonepre' ] ) ) ? $_GET[ 'vc_contactphonepre' ] : false;

$vc_conn_salutation = ( ! empty( $_GET[ 'vc_conn_salutation' ] ) ) ? $_GET[ 'vc_conn_salutation' ] : false;
$vc_conn_title = ( ! empty( $_GET[ 'vc_conn_title' ] ) ) ? $_GET[ 'vc_conn_title' ] : false;
$vc_conn_surname = ( ! empty( $_GET[ 'vc_conn_surname' ] ) ) ? $_GET[ 'vc_conn_surname' ] : false;
$vc_conn_firstname = ( ! empty( $_GET[ 'vc_conn_firstname' ] ) ) ? $_GET[ 'vc_conn_firstname' ] : false;
$vc_conn_company = ( ! empty( $_GET[ 'vc_conn_company' ] ) ) ? $_GET[ 'vc_conn_company' ] : false;
$vc_conn_birthday = ( ! empty( $_GET[ 'vc_conn_birthday' ] ) ) ? $_GET[ 'vc_conn_birthday' ] : false;
$vc_conn_street = ( ! empty( $_GET[ 'vc_conn_street' ] ) ) ? $_GET[ 'vc_conn_street' ] : false;
$vc_conn_houseno = ( ! empty( $_GET[ 'vc_conn_houseno' ] ) ) ? $_GET[ 'vc_conn_houseno' ] : false;
$vc_conn_city = ( ! empty( $_GET[ 'vc_conn_city' ] ) ) ? $_GET[ 'vc_conn_city' ] : false;
$vc_conn_citysubloc = ( ! empty( $_GET[ 'vc_conn_citysubloc' ] ) ) ? $_GET[ 'vc_conn_citysubloc' ] : false;
$vc_conn_postcode = ( ! empty( $_GET[ 'vc_conn_postcode' ] ) ) ? $_GET[ 'vc_conn_postcode' ] : false;
$vc_conn_contactfirstname = ( ! empty( $_GET[ 'vc_conn_contactfirstname' ] ) ) ? $_GET[ 'vc_conn_contactfirstname' ] : false;
$vc_conn_contact = ( ! empty( $_GET[ 'vc_conn_contact' ] ) ) ? $_GET[ 'vc_conn_contact' ] : false;
$vc_conn_contactphone = ( ! empty( $_GET[ 'vc_conn_contactphone' ] ) ) ? $_GET[ 'vc_conn_contactphone' ] : false;
$vc_conn_contactphonepre = ( ! empty( $_GET[ 'vc_conn_contactphonepre' ] ) ) ? $_GET[ 'vc_conn_contactphonepre' ] : false;

$vc_reqdeliverydate = ( ! empty( $_GET[ 'vc_reqdeliverydate' ] ) ) ? $_GET[ 'vc_reqdeliverydate' ] : false;
$vc_reqdeliverydate_voice = ( ! empty( $_GET[ 'vc_reqdeliverydate_voice' ] ) ) ? $_GET[ 'vc_reqdeliverydate_voice' ] : false;
$vc_taefiber = ( ! empty( $_GET[ 'vc_taefiber' ] ) ) ? $_GET[ 'vc_taefiber' ] : false; 
$vc_email = ( ! empty( $_GET[ 'vc_email' ] ) ) ? $_GET[ 'vc_email' ] : false;
$invoicemail_id = ( ! empty( $_GET[ 'invoicemail_id' ] ) ) ? $_GET[ 'invoicemail_id' ] : false;
$evn_id = ( ! empty( $_GET[ 'evn_id' ] ) ) ? $_GET[ 'evn_id' ] : false;
$hardware_id = ( ! empty( $_GET[ 'hardware_id' ] ) ) ? $_GET[ 'hardware_id' ] : false;
$telregister_id = ( ! empty( $_GET[ 'telregister_id' ] ) ) ? $_GET[ 'telregister_id' ] : false;
$telregistertype_id = ( ! empty( $_GET[ 'telregistertype_id' ] ) ) ? $_GET[ 'telregistertype_id' ] : false;
$vc_comments = ( ! empty( $_GET[ 'vc_comments' ] ) ) ? $_GET[ 'vc_comments' ] : false;
$vc_bankname = ( ! empty( $_GET[ 'vc_bankname' ] ) ) ? $_GET[ 'vc_bankname' ] : false;
$vc_bankaccholder = ( ! empty( $_GET[ 'vc_bankaccholder' ] ) ) ? $_GET[ 'vc_bankaccholder' ] : false;
$vc_bankaccnumber = ( ! empty( $_GET[ 'vc_bankaccnumber' ] ) ) ? $_GET[ 'vc_bankaccnumber' ] : false;
$vc_banksortcode = ( ! empty( $_GET[ 'vc_banksortcode' ] ) ) ? $_GET[ 'vc_banksortcode' ] : false;
$vc_bankiban = ( ! empty( $_GET[ 'vc_bankiban' ] ) ) ? $_GET[ 'vc_bankiban' ] : false;
$portprovider_id = ( ! empty( $_GET[ 'portprovider_id' ] ) ) ? $_GET[ 'portprovider_id' ] : false;
$vc_port_onkz = ( ! empty( $_GET[ 'vc_port_onkz' ] ) ) ? $_GET[ 'vc_port_onkz' ] : false;
$vc_port_n1 = ( ! empty( $_GET[ 'vc_port_n1' ] ) ) ? $_GET[ 'vc_port_n1' ] : false;
$vc_port_n2 = ( ! empty( $_GET[ 'vc_port_n2' ] ) ) ? $_GET[ 'vc_port_n2' ] : false;
$vc_port_n3 = ( ! empty( $_GET[ 'vc_port_n3' ] ) ) ? $_GET[ 'vc_port_n3' ] : false;
$vc_port_n4 = ( ! empty( $_GET[ 'vc_port_n4' ] ) ) ? $_GET[ 'vc_port_n4' ] : false;
$vc_port_n5 = ( ! empty( $_GET[ 'vc_port_n5' ] ) ) ? $_GET[ 'vc_port_n5' ] : false;
$vc_port_n6 = ( ! empty( $_GET[ 'vc_port_n6' ] ) ) ? $_GET[ 'vc_port_n6' ] : false;
$vc_port_n7 = ( ! empty( $_GET[ 'vc_port_n7' ] ) ) ? $_GET[ 'vc_port_n7' ] : false;
$vc_port_n8 = ( ! empty( $_GET[ 'vc_port_n8' ] ) ) ? $_GET[ 'vc_port_n8' ] : false;
$vc_port_n9 = ( ! empty( $_GET[ 'vc_port_n9' ] ) ) ? $_GET[ 'vc_port_n9' ] : false;
$vc_port_n10 = ( ! empty( $_GET[ 'vc_port_n10' ] ) ) ? $_GET[ 'vc_port_n10' ] : false;


$bulkfile = ( ! empty( $_POST[ 'bulkfile' ] ) ) ? $_POST[ 'bulkfile' ] : false;





  if ($page=='') $page=1;

  $uri=getenv("REQUEST_URI");
//$uri = $_SERVER['REQUEST_URI'];
//  echo("x $uri");


if ($debug) echo("PAGE $page<br>");

  $tcolor0='#dddddd';
  $tcolor1='#eeeeee';
  $tcolorblue='#0066bb';
  $tcolorred='#ff0000';
  $time=time();
  $sertimenull=get_sertimenull($time);

  //  echo("$time $sertimenull");

$remotehostip=$_SERVER['REMOTE_ADDR'];
// $remotehostip=$HTTP_CLIENT_IP;
if ($remotehostip=='') {$remotehostip=$REMOTE_HOST;}
if ($remotehostip=='') {$remotehostip=$REMOTE_ADDR;}
$agnt=$_SERVER['HTTP_USER_AGENT'];
$refr=$_SERVER['HTTP_USER_AGENT'];
$forw=$_SERVER['HTTP_USER_AGENT'];

  $logstring="$time:uri:$uri:addr:$remotehostip:agnt:$HTTP_USER_AGENT:refr:$HTTP_REFERER:forw:$HTTP_X_FORWARDED_FOR:\n";

  $fp=fopen('log/bbmp.pi','a+');
  fputs($fp,$logstring);
  fclose($fp);


  if ($tmode!=1)
    {
    navi($page,$tcolor0,$tcolor1,$tcolorblue);
    echo
    ("
    <table cellspacing=1 cellpadding=5 border=0 width=758 bgcolor=$tcolorblue>
    <tr>
    <td style=font-size:0pt; bgcolor=#FFFFFF>
    <table cellspacing=0 cellpadding=10 border=0 width=100%>
    <tr>
    <td valign=middle>
    ");
    echo("<table border=0><tr><td><h5><a align=right href=# onclick=history.back();return false>< Zur&uuml;ck</a>&nbsp;&nbsp;<a href=index.php?page=99>> Hilfe</a>&nbsp;&nbsp;<a href=$selfurl?benutzer=abmelden>> Logout ($loggedinuser)</a></h5>");
    echo("</td><td><h5><form id=loginform method=post action=$selfurl><select name=cisp onchange=formsubmit(this.form)><option value=$isp selected>anderen Dienst ausw&auml;hlen: <option value=gustav>gustav internet (Glasfaser Endkunden)</option><option value=hugo>hugo internet (VDSL Endkunden)</option><option value=werknetz>werknetz internet (Glasfaser Business)</option></select></form></h5></td></tr></table>");
#onchange=alert(this.value)
#onchange=location.href=$selfurl + this.options[this.selectedIndex].value;
    }

  if ($page==1)
    {
    echo("<h5>Search : &nbsp;&nbsp;<i>> <a href=index.php?page=1>Suche</a> &nbsp; > <a href=index.php?page=1&action=vchistoryform>Auftrag Historie</a></i></h5>");
    if (($action=='searchvc')||($action=='searchvc_cal')||($action=='searchvc_ex')||($action=='searchvc_vp'))
      {
      echo("<h3>> Suche</h3><center>");
      include("templates/vclist.php");
      }
    else if ($action=='vchistory')
      {
      echo("<h3>> Auftrag Historie</h3><center>");
      include("templates/vchistorylist.php");
      }
    else if ($action=='vchistoryform')
      {
      echo("<h3>> Auftrag Historie</h3><center>");
      include("templates/vchistoryform.php");
      }
    else if ($action=='searchcal_perc')
      {
      echo("<h3>> Suche</h3><center>");
      include("templates/config_cal.php");
      }
    else if ($action!='')
      {
      echo("<h3>> Suche</h3><center>");
      include("templates/vplist.php");
      }
    else
      {
      echo("<h3>> Suche</h3><center>");
      include("templates/searchform.php");
      }
    }
  else if ($page==2)
    {
    echo("<h3>Availability Check</h3><center>");
    if (($action=='availcheck')&($vc_postcode!=''))
      {
      echo("<iframe width=468 height=500 scrolling=yes frameborder=0 src=https://www.adslchecker.bt.com/pls/adsl/adslchecker_xml.postcode?Username=O/M30668700&Password=tfu8700sn&Version=7&Input=$vc_postcode>");
      }
    if (($action=='availcheck')&&($avail_str!=''))
      {
      //echo("<iframe width=468 height=500 scrolling=yes frameborder=0 src=https://www.adslchecker.bt.com/pls/adsl/adslchecker_xml.telno?Username=O/M30668700&Password=tfu8700sn&Version=7&Input=$vc_cli>");
      $ordermode=0;
      if ($debug) echo("AVAILCHECK<br>");
      require("templates/availcheck.php");
      if ($debug) echo("ORDERCHECK<br>");
      require("templates/ordercheck.php");
      }
    else
      {
      include("templates/availcheckform.php");
      }
    echo("</center>");
    }
  else if ($page==3)
    {
        echo("<h5>Order Management : &nbsp;&nbsp;<i>> <a href=index.php?page=3>Bestellformular</a> &nbsp; > <a href=index.php?page=4>Bestellungen - alle</a> &nbsp; > 
          <a href=index.php?page=4&action=cancelled>Storno(5)</a> &nbsp; > 
          <a href=index.php?page=4&action=preorder>Vorbestellungen(21)</a> &nbsp; > 
          <a href=index.php?page=4&action=orderedopen>bereit &Uuml;bergabe(22)</a> &nbsp; > 
          <a href=index.php?page=4&action=ordertracking>im CAP Prozess(23-25)</a> &nbsp; > 
          <a href=index.php?page=4&action=orderinstdate>mit Bereitstellungstermin(26)</a> &nbsp; > 
          <a href=index.php?page=4&action=orderreinstallation>neuer Termin(27)</a> &nbsp; > 
          <a href=index.php?page=4&action=orderinstallationday>Offene(28)</a> &nbsp; > 
          <a href=index.php?page=4&action=orderinstallation>CAP installiert(29)</a> &nbsp; > 
          <a href=index.php?page=4&action=orderprod>Produktion(30)</a> &nbsp; > 
          <a href=index.php?page=4&action=exceptions>Fehler(k5)</a></i></h5>");
    echo("<h3>> Order - Auftrag anlegen/bearbeiten</h3><center>");
    if ($action=='')
      {
      $action='vcorderform';
      }
    if ($action=='vcorder')
      {
      if ($debug) echo("CHECKDATA<br>");
      $checkmode='vc';
      include("templates/checkformdata.php");
      }
    if (($ordererror==0)&&($action=='vcorder'))
      {
      $ordermode=1;
      if ($debug) echo("AVAILCHECK<br>");
      require("templates/availcheck.php");
      if ($debug) echo("ORDERCHECK<br>");
      require("templates/ordercheck.php");
      }
    else if ($action=='vcupgradeconf')
      {
      require("templates/vcupgradeconf.php");
      }
    else if ($action=='delete')
      {
      require("templates/vcdelete.php");
      }
    else
      {
      //$action='vcorderform';
      include("templates/vcedit.php");
      }
    }
  else if ($page==4)
    {
    echo("<h5>Order Management : &nbsp;&nbsp;<i>> <a href=index.php?page=3>Bestellformular</a> &nbsp; > <a href=index.php?page=4>Bestellungen - alle</a> &nbsp; > 
          <a href=index.php?page=4&action=cancelled>Storno(5)</a> &nbsp; > 
          <a href=index.php?page=4&action=preorder>Vorbestellungen(21)</a> &nbsp; > 
          <a href=index.php?page=4&action=orderedopen>bereit &Uuml;bergabe(22)</a> &nbsp; > 
          <a href=index.php?page=4&action=ordertracking>im CAP Prozess(23-25)</a> &nbsp; > 
          <a href=index.php?page=4&action=orderinstdate>mit Bereitstellungstermin(26)</a> &nbsp; > 
          <a href=index.php?page=4&action=orderreinstallation>neuer Termin(27)</a> &nbsp; > 
          <a href=index.php?page=4&action=orderinstallationday>Offene(28)</a> &nbsp; > 
          <a href=index.php?page=4&action=orderinstallation>CAP installiert(29)</a> &nbsp; > 
          <a href=index.php?page=4&action=orderprod>Produktion(30)</a> &nbsp; > 
          <a href=index.php?page=4&action=exceptions>Fehler(k5)</a></i></h5>");
    if ($action=='ordertracking')
      {
      echo("<h3>> Bestellungen im CAP Prozess</h3><center>");
      }
    else if ($action=='exceptions')
      {
      echo("<h3>> Fehler</h3><center>");
      }
    else if ($action=='preorder')
      {
      echo("<h3>> Vorbestellungen</h3><center>");
      }
    else if ($action=='orderinstdate')
      {
      echo("<h3>> Bestellungen mit Bereitstellungstermin</h3><center>");
      }
    else if ($action=='orderreinstallation')
      {
      echo("<h3>> Bestellungen mit neuem Termin / neue Anfahrt TAM</h3><center>");
      }
    else if ($action=='orderinstallationday')
      {
      echo("<h3>> Bestellungen mit aktuellem Installationstag</h3><center>");
      }
    else if ($action=='orderinstallation')
      {
      echo("<h3>> Bestellungen CAP installiert</h3><center>");
      }
    else if ($action=='orderprod')
      {
      echo("<h3>> Bestellungen produktiv</h3><center>");
      }
    else if ($action=='cancelled')
      {
      echo("<h3>> Storno</h3><center>");
      }
    else if ($action=='orderedopen')
      {
      echo("<h3>> Bestellungen bereit zur &Uuml;bergabe</h3><center>");
      include("templates/sendvcxmlorderform.php");
      }
    else
      {
      echo("<h3>> Bestellungen alle</h3><center>");
      }
    include("templates/vclist.php");
    }


  else if ($page=='9')
    {
        echo("<h5>Billing : &nbsp;&nbsp;<i>> <a href=index.php?page=9>Billing Report</a> &nbsp; > <a href=index.php?page=9&action=configpricesform>Pricing</a></i></h5>");

    if ($action=='billingreport')
      {
      if ($tmode!=1) { echo("<h3>> Billing Report</h3><center>"); }
      include("templates/billingreport.php");
      $report_type='BILLING';
      if ($tmode!=1) { include("templates/repoptions.php"); }
      }
    else if ($action=='configprices')
      {
      echo("<h3>> Pricing</h3><center>");
      include("templates/config_price.php");
      }
    else if ($action=='configpricesform')
      {
      echo("<h3>> Pricing</h3><center>");
      include("templates/config_priceform.php");
      }
    else
      {
      echo("<h3>> Billing Report</h3><center>");
      if ($action=='saveconfig')
        {
        echo('<h4>Billing Configuration Saved.</h4>');
        include("templates/repsaveconfig.php");
        }
      include("templates/billingform.php");
      }
    }

  else if ($page=='10')
    {
    echo("<h5>Order Management : &nbsp;&nbsp;<i>> <a href=index.php?page=3>Order</a> &nbsp; > <a href=index.php?page=10>Batch Order</a> &nbsp; > <a href=index.php?page=4>Orders Pending</a> &nbsp; > <a href=index.php?page=4&action=ordertracking>Order Tracking</a> &nbsp; > <a href=index.php?page=4&action=exceptions>Exception Handling</a></i></h5>");
    echo("<h3>> Customer Batch Order</h3><center>");
    if ($action=='bulkorder')
      {
      include("templates/bulkupload.php");
      }
    else
      {
      include("templates/bulkform.php");
      }
    }
  else if ($page==12)
    {
    if ($tmode!=1) { echo("<h5>Reports : &nbsp;&nbsp;<i>> <a href=index.php?page=20&action=customerreport>Customer Report</a> &nbsp; > <a href=index.php?page=20&action=capacityreport>Capacity Report</a> &nbsp; > <a href=index.php?page=20&action=managereports>Manage Reports</a> &nbsp; > <a href=index.php?page=13>Quality Report</a></i></h5>"); }
    echo("<h3>> Last 14 days Orders</h3><center>");
    $action='last3';
    include("templates/vclist.php");
    }
  else if ($page==13)
    {
    if ($tmode!=1) { echo("<h5>Reports : &nbsp;&nbsp;<i>> <a href=index.php?page=20&action=customerreport>Customer Report</a> &nbsp; > <a href=index.php?page=20&action=capacityreport>Capacity Report</a> &nbsp; > <a href=index.php?page=20&action=managereports>Manage Reports</a> &nbsp; > <a href=index.php?page=13>Quality Report</a></i></h5>"); }
    echo("<h3>> Quality Report</h3><center>");
    if ($action=='qualreport')
      {
      include("templates/qualreport.php");
      }
    else
      {
      include("templates/qualform.php");
      }

    }

  else if ($page==11)
    {
    echo("<h5>Config : &nbsp;&nbsp;<i>> <a href=index.php?page=11&action=rules>Configure Rules</a></i></h5>");
    if ($action=='rules')
      {
      echo("<h3>> Configure Rules</h3><center>");
      include("templates/ruleform.php");
      }
    else if ($action=='saverules')
      {
      echo("<h3>> Configure Rules</h3><center>");
      include("templates/rulesave.php");
      }
    else 
      {
      echo("<h3>> Configure Rules</h3><center>");
      include("templates/ruleform.php");
      }

    }
  if ($page==20)
    {
    if ($tmode!=1) { echo("<h5>Reports : &nbsp;&nbsp;<i>> <a href=index.php?page=20&action=customerreport>Customer Report</a> &nbsp; > <a href=index.php?page=20&action=capacityreport>Capacity Report</a> &nbsp; > <a href=index.php?page=20&action=managereports>Manage Reports</a> &nbsp; > <a href=index.php?page=13>Quality Report</a></i></h5>"); }
    if ($action=='searchvc')
      {
      if ($tmode!=1) { echo("<h3>> Customer Report</h3><center>"); }
      include("templates/vclist.php");
      $report_type='CUSTOMER';
      if ($tmode!=2) { include("templates/repoptions.php"); }
      }
    else if (($action=='searchvp_cal')||($action=='searchvp_state')||($action=='searchvp_bwperc')||($action=='searchvp_portsperc'))
      {
      if ($tmode!=1) { echo("<h3>> Capacity Report</h3><center>"); }
      include("templates/vplist.php");
      $report_type='CAPACITY';
      if ($tmode!=1) { include("templates/repoptions.php"); }
      }
    else if ($action=='searchcal_perc')
      {
      if ($tmode!=1) { echo("<h3>> Capacity Report</h3><center>"); }
      include("templates/config_cal.php");
      $report_type='CAPACITY';
      if ($tmode!=1) { include("templates/repoptions.php"); }
      }
    else if (($action=='customerreport')||($action==''))
      {
      echo("<h3>> Customer Report</h3><center>");
      include("templates/repcustsearchform.php");
      }
    else if ($action=='capacityreport')
      {
      echo("<h3>> Capacity Report</h3><center>");
      include("templates/repcapsearchform.php");
      }
    else if ($action=='managereports')
      {
      echo("<h3>> Manage Reports</h3><center>");
      include("templates/replist.php");
      }
    else if ($action=='deleterep')
      {
      echo("<h3>> Manage Reports</h3><center>");
      include("templates/repdelete.php");
      }
    else
      {
      if ($action=='saveconfig')
        {
        echo('<h4>Report Configuration Saved.</h4>');
        include("templates/repsaveconfig.php");
        }
      //include("templates/reportingfakesearchform.php");
      }
    }

   if ($page==30)
    {
        echo("<h5>Reports : &nbsp;&nbsp;<i>> <a href=index.php?page=20>Customer Report</a> &nbsp; > <a href=index.php?page=12>Last 14 days  orders</a> &nbsp; > <a href=index.php?page=13>Quality Report</a></i></h5>");

    echo("<h3>> Dashboard</h3><center>");
      include("templates/dashboard.php");
    }
   if ($page==31)
    {
    echo("<h5>Order Management : &nbsp;&nbsp;<i>> <a href=index.php?page=3>Order</a> &nbsp; > <a href=index.php?page=10>Batch Order</a> &nbsp; > <a href=index.php?page=4>Orders Pending</a> &nbsp; > <a href=index.php?page=4&action=ordertracking>Order Tracking</a> &nbsp; > <a href=index.php?page=4&action=exceptions>Exception Handling</a></i></h5>");

    echo("<h3>> BT XML Order</h3><center>");
    include("templates/sendvcxmlorder.php");
    }
   if ($page==99)
    {
    echo("<h3>> Help</h3><center>");
    include("templates/help.php");
    }
   
    if ($tmode!=1)
      {  
      include("templates/footer.php");
      }
  
    function check_email($email)
      {
      if(eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,4}$",$email))
        {
        return(1);
        }
      else
        {
        return(2);
        }
      }
  
  

  function test_input($data)
    {
    $data = trim($data);               // newlines, spaces, tabs weg
    $data = stripslashes($data);       // backslashes weg
    $data = htmlspecialchars($data);   // html klammern wegen attacks weg
    return $data;
    }

  function navi($page,$col0,$col1,$col2)

  {
  echo
  ("
  <table border=0 cellspacing=0 cellpadding=0>
  <tr>
  <td width=12>&nbsp;</td>
  ");

  navibox('Search',1,$page,$col0,$col1,$col2);
  navibox('Availability Check',2,$page,$col0,$col1,$col2);
  navibox('Order Management',3,$page,$col0,$col1,$col2);
//  navibox('Capacity Management',5,$page,$col0,$col1,$col2);
  navibox('Reports',20,$page,$col0,$col1,$col2);
  navibox('Billing',9,$page,$col0,$col1,$col2);
  navibox('Configuration',11,$page,$col0,$col1,$col2);

  echo
  ("
  </tr>
  <tr>
  <td colspan=18 bgcolor=$col2><img width=1 height=1></td>
  </tr>
  </table>
  <br>
  ");

  }

function navibox($text,$page,$link,$col0,$col1,$col2)
  {
  if ($page==$link)
    {
    $link=0;
    }
  else
    {
    $link=1;
    }


  if ($link==1)
    {
    echo
    ("
    <td bgcolor=$col0 align=center width=80 nowrap style=cursor:pointer;cursor:hand;>
    <a href=index.php?page=$page>
    <font size=-1>$text</font></a></td>
    <td width=12>&nbsp;</td>
    ");
    }
  else
    {
    echo("
    <td bgcolor=$col2 align=center width=90 nowrap style=cursor:pointer;cursor:hand;>
    <span class=table0>
    <b>$text</b></span></td>
    <td width=12>&nbsp;</td>
    ");
    }
  }



?>
