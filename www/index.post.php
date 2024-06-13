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
if ($_POST['benutzer'] == 'abmelden') { resetUser(); }
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


$changeinfo = ( ! empty( $_POST[ 'changeinfo' ] ) ) ? $_POST[ 'changeinfo' ] : false;
if (strlen($changeinfo)>0)
  {
  // DB
  MYSQL_QUERY("UPDATE `dslprov_vc` SET vc_confirmations=1 WHERE vc_visprefnum=$changeinfo;");
  }
$resetstate1 = ( ! empty( $_POST[ 'resetstate1' ] ) ) ? $_POST[ 'resetstate1' ] : false;
if (strlen($resetstate1)>0)
  {
  // DB
  MYSQL_QUERY("UPDATE `dslprov_vc` SET vc_state=22,vc_state_voice=22 WHERE vc_visprefnum=$resetstate1;");
  }
$resetstate3 = ( ! empty( $_POST[ 'resetstate3' ] ) ) ? $_POST[ 'resetstate3' ] : false;
if (strlen($resetstate3)>0)
  {
  // DB
  MYSQL_QUERY("UPDATE `dslprov_vc` SET vc_state=22,vc_state_voice=22 WHERE vc_visprefnum=$resetstate3;");
  }
$setprod = ( ! empty( $_POST[ 'setprod' ] ) ) ? $_POST[ 'setprod' ] : false;
$syncdl = ( ! empty( $_POST[ 'syncdl' ] ) ) ? $_POST[ 'syncdl' ] : false;
$syncup = ( ! empty( $_POST[ 'syncup' ] ) ) ? $_POST[ 'syncup' ] : false;
$attdl = ( ! empty( $_POST[ 'attdl' ] ) ) ? $_POST[ 'attdl' ] : false;
$attup = ( ! empty( $_POST[ 'attup' ] ) ) ? $_POST[ 'attup' ] : false;

$setprodkrm = ( ! empty( $_POST[ 'setprodkrm' ] ) ) ? $_POST[ 'setprodkrm' ] : false;

$setproddate = ( ! empty( $_POST[ 'setproddate' ] ) ) ? $_POST[ 'setproddate' ] : false;
$stparts=explode(".",$setproddate);
$setproddate=$stparts[2].'.'.$stparts[1].'.'.$stparts[0];
echo("$setprod $setproddate");
if (strlen($setprod)>0)
  {
  // DB
  MYSQL_QUERY("UPDATE `dslprov_vc` SET vc_state=30,vc_state_voice=30,vc_productiondate='$setproddate' WHERE vc_visprefnum=$setprod;");
  }
if (strlen($setprodkrm)>0)
  {
  // DB
  MYSQL_QUERY("UPDATE `dslprov_vc` SET vc_state=31,vc_state_voice=31,vc_productiondate='$setproddate' WHERE vc_visprefnum=$setprodkrm;");
  }
  
// $name = test_input($_POST["name"]);   FRAUD pruefen fuer alle variablen

echo("page $page");

$page = ( ! empty( $_GET[ 'page' ] ) ) ? $_GET[ 'page' ] : false;
$action = ( ! empty( $_GET[ 'action' ] ) ) ? $_GET[ 'action' ] : false;

echo("page $page");

if ($page =='')
  {
  $page = ( ! empty( $_POST[ 'page' ] ) ) ? $_POST[ 'page' ] : false;
  $action = ( ! empty( $_POST[ 'action' ] ) ) ? $_POST[ 'action' ] : false;
  }

echo("page $page");

$avail_str = ( ! empty( $_POST[ 'avail_str' ] ) ) ? $_POST[ 'avail_str' ] : false;
$avail_nr = ( ! empty( $_POST[ 'avail_nr' ] ) ) ? $_POST[ 'avail_nr' ] : false;
$avail_postcode = ( ! empty( $_POST[ 'avail_postcode' ] ) ) ? $_POST[ 'avail_postcode' ] : false;
$avail_city = ( ! empty( $_POST[ 'avail_city' ] ) ) ? $_POST[ 'avail_city' ] : false;

// OLD
$vc_cli = ( ! empty( $_POST[ 'vc_cli' ] ) ) ? $_POST[ 'vc_cli' ] : false;
$userbw_id = ( ! empty( $_POST[ 'userbw_id' ] ) ) ? $_POST[ 'userbw_id' ] : false;
$usercr_id = ( ! empty( $_POST[ 'usercr_id' ] ) ) ? $_POST[ 'usercr_id' ] : false;
$userrealm_id = ( ! empty( $_POST[ 'userrealm_id' ] ) ) ? $_POST[ 'userrealm_id' ] : false;

//NEW
$vc_visprefnum = ( ! empty( $_POST[ 'vc_visprefnum' ] ) ) ? $_POST[ 'vc_visprefnum' ] : false;
$vc_state = ( ! empty( $_POST[ 'vc_state' ] ) ) ? $_POST[ 'vc_state' ] : false;
$vc_state_voice = ( ! empty( $_POST[ 'vc_state_voice' ] ) ) ? $_POST[ 'vc_state_voice' ] : false;
$limit = ( ! empty( $_POST[ 'limit' ] ) ) ? $_POST[ 'limit' ] : false;
$vc_orderdate = ( ! empty( $_POST[ 'vc_orderdate' ] ) ) ? $_POST[ 'vc_orderdate' ] : false;
$orderdatefrom = ( ! empty( $_POST[ 'orderdatefrom' ] ) ) ? $_POST[ 'orderdatefrom' ] : false;
$orderdateto = ( ! empty( $_POST[ 'orderdateto' ] ) ) ? $_POST[ 'orderdateto' ] : false;
$vc_commitdate = ( ! empty( $_POST[ 'vc_commitdate' ] ) ) ? $_POST[ 'vc_commitdate' ] : false;
$commitdatefrom = ( ! empty( $_POST[ 'commitdatefrom' ] ) ) ? $_POST[ 'commitdatefrom' ] : false;
$commitdateto = ( ! empty( $_POST[ 'commitdateto' ] ) ) ? $_POST[ 'commitdateto' ] : false;
$vc_commitdate2 = ( ! empty( $_POST[ 'vc_commitdate2' ] ) ) ? $_POST[ 'vc_commitdate2' ] : false;
$commitdate2from = ( ! empty( $_POST[ 'commitdate2from' ] ) ) ? $_POST[ 'commitdate2from' ] : false;
$commitdate2to = ( ! empty( $_POST[ 'commitdate2to' ] ) ) ? $_POST[ 'commitdate2to' ] : false;
$vc_commitdate3 = ( ! empty( $_POST[ 'vc_commitdate3' ] ) ) ? $_POST[ 'vc_commitdate3' ] : false;
$commitdate3from = ( ! empty( $_POST[ 'commitdate3from' ] ) ) ? $_POST[ 'commitdate3from' ] : false;
$commitdate3to = ( ! empty( $_POST[ 'commitdate3to' ] ) ) ? $_POST[ 'commitdate3to' ] : false;
$vc_installationdate = ( ! empty( $_POST[ 'vc_installationdate' ] ) ) ? $_POST[ 'vc_installationdate' ] : false;
$installationdatefrom = ( ! empty( $_POST[ 'installationdatefrom' ] ) ) ? $_POST[ 'installationdatefrom' ] : false;
$installationsdateto = ( ! empty( $_POST[ 'installationsdateto' ] ) ) ? $_POST[ 'installationsdateto' ] : false;
$vc_canceldate = ( ! empty( $_POST[ 'vc_canceldate' ] ) ) ? $_POST[ 'vc_canceldate' ] : false;
$canceldatefrom = ( ! empty( $_POST[ 'canceldatefrom' ] ) ) ? $_POST[ 'canceldatefrom' ] : false;
$canceldateto = ( ! empty( $_POST[ 'canceldateto' ] ) ) ? $_POST[ 'canceldateto' ] : false;
$vc_productiondate = ( ! empty( $_POST[ 'vc_productiondate' ] ) ) ? $_POST[ 'vc_productiondate' ] : false;
$productiondatefrom = ( ! empty( $_POST[ 'productiondatefrom' ] ) ) ? $_POST[ 'productiondatefrom' ] : false;
$productiondateto = ( ! empty( $_POST[ 'productiondateto' ] ) ) ? $_POST[ 'productiondateto' ] : false;
$reqdeliverydatefrom = ( ! empty( $_POST[ 'reqdeliverydatefrom' ] ) ) ? $_POST[ 'reqdeliverydatefrom' ] : false;
$reqdeliverydateto = ( ! empty( $_POST[ 'reqdeliverydateto' ] ) ) ? $_POST[ 'reqdeliverydateto' ] : false;

$location_id = ( ! empty( $_POST[ 'location_id' ] ) ) ? $_POST[ 'location_id' ] : false;

$vc_batch_visp  = ( ! empty( $_POST[ 'vc_batch_visp' ] ) ) ? $_POST[ 'vc_batch_visp' ] : false;

// Voice

$product_id = ( ! empty( $_POST[ 'product_id' ] ) ) ? $_POST[ 'product_id' ] : false;
$productadditional_id = ( ! empty( $_POST[ 'productadditional_id' ] ) ) ? $_POST[ 'productadditional_id' ] : false;
$productcap_id = ( ! empty( $_POST[ 'productcap_id' ] ) ) ? $_POST[ 'productcap_id' ] : false;
$vc_salutation = ( ! empty( $_POST[ 'vc_salutation' ] ) ) ? $_POST[ 'vc_salutation' ] : false;
$vc_title = ( ! empty( $_POST[ 'vc_title' ] ) ) ? $_POST[ 'vc_title' ] : false;
$vc_surname = ( ! empty( $_POST[ 'vc_surname' ] ) ) ? $_POST[ 'vc_surname' ] : false;
$vc_firstname = ( ! empty( $_POST[ 'vc_firstname' ] ) ) ? $_POST[ 'vc_firstname' ] : false;
$vc_company = ( ! empty( $_POST[ 'vc_company' ] ) ) ? $_POST[ 'vc_company' ] : false;
$vc_birthday = ( ! empty( $_POST[ 'vc_birthday' ] ) ) ? $_POST[ 'vc_birthday' ] : false;
$vc_street = ( ! empty( $_POST[ 'vc_street' ] ) ) ? $_POST[ 'vc_street' ] : false;
$vc_houseno = ( ! empty( $_POST[ 'vc_houseno' ] ) ) ? $_POST[ 'vc_houseno' ] : false;
$vc_city = ( ! empty( $_POST[ 'vc_city' ] ) ) ? $_POST[ 'vc_city' ] : false;
$vc_citysubloc = ( ! empty( $_POST[ 'vc_citysubloc' ] ) ) ? $_POST[ 'vc_citysubloc' ] : false;
$vc_postcode = ( ! empty( $_POST[ 'vc_postcode' ] ) ) ? $_POST[ 'vc_postcode' ] : false;
$vc_contactfirstname = ( ! empty( $_POST[ 'vc_contactfirstname' ] ) ) ? $_POST[ 'vc_contactfirstname' ] : false;
$vc_contact = ( ! empty( $_POST[ 'vc_contact' ] ) ) ? $_POST[ 'vc_contact' ] : false;
$vc_contactphone = ( ! empty( $_POST[ 'vc_contactphone' ] ) ) ? $_POST[ 'vc_contactphone' ] : false;
$vc_contactphonepre = ( ! empty( $_POST[ 'vc_contactphonepre' ] ) ) ? $_POST[ 'vc_contactphonepre' ] : false;

$vc_conn_salutation = ( ! empty( $_POST[ 'vc_conn_salutation' ] ) ) ? $_POST[ 'vc_conn_salutation' ] : false;
$vc_conn_title = ( ! empty( $_POST[ 'vc_conn_title' ] ) ) ? $_POST[ 'vc_conn_title' ] : false;
$vc_conn_surname = ( ! empty( $_POST[ 'vc_conn_surname' ] ) ) ? $_POST[ 'vc_conn_surname' ] : false;
$vc_conn_firstname = ( ! empty( $_POST[ 'vc_conn_firstname' ] ) ) ? $_POST[ 'vc_conn_firstname' ] : false;
$vc_conn_company = ( ! empty( $_POST[ 'vc_conn_company' ] ) ) ? $_POST[ 'vc_conn_company' ] : false;
$vc_conn_birthday = ( ! empty( $_POST[ 'vc_conn_birthday' ] ) ) ? $_POST[ 'vc_conn_birthday' ] : false;
$vc_conn_street = ( ! empty( $_POST[ 'vc_conn_street' ] ) ) ? $_POST[ 'vc_conn_street' ] : false;
$vc_conn_houseno = ( ! empty( $_POST[ 'vc_conn_houseno' ] ) ) ? $_POST[ 'vc_conn_houseno' ] : false;
$vc_conn_city = ( ! empty( $_POST[ 'vc_conn_city' ] ) ) ? $_POST[ 'vc_conn_city' ] : false;
$vc_conn_citysubloc = ( ! empty( $_POST[ 'vc_conn_citysubloc' ] ) ) ? $_POST[ 'vc_conn_citysubloc' ] : false;
$vc_conn_postcode = ( ! empty( $_POST[ 'vc_conn_postcode' ] ) ) ? $_POST[ 'vc_conn_postcode' ] : false;
$vc_conn_contactfirstname = ( ! empty( $_POST[ 'vc_conn_contactfirstname' ] ) ) ? $_POST[ 'vc_conn_contactfirstname' ] : false;
$vc_conn_contact = ( ! empty( $_POST[ 'vc_conn_contact' ] ) ) ? $_POST[ 'vc_conn_contact' ] : false;
$vc_conn_contactphone = ( ! empty( $_POST[ 'vc_conn_contactphone' ] ) ) ? $_POST[ 'vc_conn_contactphone' ] : false;
$vc_conn_contactphonepre = ( ! empty( $_POST[ 'vc_conn_contactphonepre' ] ) ) ? $_POST[ 'vc_conn_contactphonepre' ] : false;

$vc_reqdeliverydate = ( ! empty( $_POST[ 'vc_reqdeliverydate' ] ) ) ? $_POST[ 'vc_reqdeliverydate' ] : false;
$vc_reqdeliverydate_voice = ( ! empty( $_POST[ 'vc_reqdeliverydate_voice' ] ) ) ? $_POST[ 'vc_reqdeliverydate_voice' ] : false;
$vc_taefiber = ( ! empty( $_POST[ 'vc_taefiber' ] ) ) ? $_POST[ 'vc_taefiber' ] : false; 
$vc_email = ( ! empty( $_POST[ 'vc_email' ] ) ) ? $_POST[ 'vc_email' ] : false;
$invoicemail_id = ( ! empty( $_POST[ 'invoicemail_id' ] ) ) ? $_POST[ 'invoicemail_id' ] : false;
$evn_id = ( ! empty( $_POST[ 'evn_id' ] ) ) ? $_POST[ 'evn_id' ] : false;
$hardware_id = ( ! empty( $_POST[ 'hardware_id' ] ) ) ? $_POST[ 'hardware_id' ] : false;
$telregister_id = ( ! empty( $_POST[ 'telregister_id' ] ) ) ? $_POST[ 'telregister_id' ] : false;
$telregistertype_id = ( ! empty( $_POST[ 'telregistertype_id' ] ) ) ? $_POST[ 'telregistertype_id' ] : false;
$vc_comments = ( ! empty( $_POST[ 'vc_comments' ] ) ) ? $_POST[ 'vc_comments' ] : false;
$vc_bankname = ( ! empty( $_POST[ 'vc_bankname' ] ) ) ? $_POST[ 'vc_bankname' ] : false;
$vc_bankaccholder = ( ! empty( $_POST[ 'vc_bankaccholder' ] ) ) ? $_POST[ 'vc_bankaccholder' ] : false;
$vc_bankaccnumber = ( ! empty( $_POST[ 'vc_bankaccnumber' ] ) ) ? $_POST[ 'vc_bankaccnumber' ] : false;
$vc_banksortcode = ( ! empty( $_POST[ 'vc_banksortcode' ] ) ) ? $_POST[ 'vc_banksortcode' ] : false;
$vc_bankiban = ( ! empty( $_POST[ 'vc_bankiban' ] ) ) ? $_POST[ 'vc_bankiban' ] : false;
$portprovider_id = ( ! empty( $_POST[ 'portprovider_id' ] ) ) ? $_POST[ 'portprovider_id' ] : false;
$vc_port_onkz = ( ! empty( $_POST[ 'vc_port_onkz' ] ) ) ? $_POST[ 'vc_port_onkz' ] : false;
$vc_port_n1 = ( ! empty( $_POST[ 'vc_port_n1' ] ) ) ? $_POST[ 'vc_port_n1' ] : false;
$vc_port_n2 = ( ! empty( $_POST[ 'vc_port_n2' ] ) ) ? $_POST[ 'vc_port_n2' ] : false;
$vc_port_n3 = ( ! empty( $_POST[ 'vc_port_n3' ] ) ) ? $_POST[ 'vc_port_n3' ] : false;
$vc_port_n4 = ( ! empty( $_POST[ 'vc_port_n4' ] ) ) ? $_POST[ 'vc_port_n4' ] : false;
$vc_port_n5 = ( ! empty( $_POST[ 'vc_port_n5' ] ) ) ? $_POST[ 'vc_port_n5' ] : false;
$vc_port_n6 = ( ! empty( $_POST[ 'vc_port_n6' ] ) ) ? $_POST[ 'vc_port_n6' ] : false;
$vc_port_n7 = ( ! empty( $_POST[ 'vc_port_n7' ] ) ) ? $_POST[ 'vc_port_n7' ] : false;
$vc_port_n8 = ( ! empty( $_POST[ 'vc_port_n8' ] ) ) ? $_POST[ 'vc_port_n8' ] : false;
$vc_port_n9 = ( ! empty( $_POST[ 'vc_port_n9' ] ) ) ? $_POST[ 'vc_port_n9' ] : false;
$vc_port_n10 = ( ! empty( $_POST[ 'vc_port_n10' ] ) ) ? $_POST[ 'vc_port_n10' ] : false;


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
          <a href=index.php?page=4&action=orderinstallation>CAP installiert(27)</a> &nbsp; > 
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
          <a href=index.php?page=4&action=orderinstallation>CAP installiert(27)</a> &nbsp; > 
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
