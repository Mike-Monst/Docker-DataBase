<?


  require("config.inc.php");


//  $tmode=1;

  if ($tmode!=1)
    {
    include("templates/header.php");
    }
$page = ( ! empty( $_GET[ 'page' ] ) ) ? $_GET[ 'page' ] : false;
$action = ( ! empty( $_GET[ 'action' ] ) ) ? $_GET[ 'action' ] : false;

  if ($page=='') $page=1;

  $debug=0;  
  $uri=getenv("REQUEST_URI");
//$uri = $_SERVER['REQUEST_URI'];
//  echo("x $uri");


echo("PAGE $page");

  $tcolor0='#dddddd';
  $tcolor1='#eeeeee';
  $tcolorblue='#0066bb';
  $time=time();
  $sertimenull=get_sertimenull($time);

  //  echo("$time $sertimenull");
 echo("xxx");

$remotehostip=$_SERVER['REMOTE_ADDR'];
// $remotehostip=$HTTP_CLIENT_IP;
if ($remotehostip=='') {$remotehostip=$REMOTE_HOST;}
if ($remotehostip=='') {$remotehostip=$REMOTE_ADDR;}
$agnt=$_SERVER['HTTP_USER_AGENT'];
$refr=$_SERVER['HTTP_USER_AGENT'];
$forw=$_SERVER['HTTP_USER_AGENT'];

  $logstring="$time:uri:$uri:addr:$remotehostip:agnt:$HTTP_USER_AGENT:refr:$HTTP_REFERER:forw:$HTTP_X_FORWARDED_FOR:\n";

  $fp=fopen('tuk.pi','a+');
  fputs($fp,$logstring);
  fclose($fp);

 echo("xxx");


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
    echo("<h5><a align=right href=# onclick=history.back();return false>< Back</a>&nbsp;&nbsp;<a href=index.php?page=99>> Help</a></h5>");
    }

  if ($page==1)
    {
    echo("<h5>Search : &nbsp;&nbsp;<i>> <a href=index.php?page=1>Search</a> &nbsp; > <a href=index.php?page=1&action=vchistoryform>VC History</a></i></h5>");
    if (($action=='searchvc')||($action=='searchvc_cal')||($action=='searchvc_ex')||($action=='searchvc_vp'))
      {
      echo("<h3>> Search</h3><center>");
      include("templates/vclist.php");
      }
    else if ($action=='vchistory')
      {
      echo("<h3>> VC History</h3><center>");
      include("templates/vchistorylist.php");
      }
    else if ($action=='vchistoryform')
      {
      echo("<h3>> VC History</h3><center>");
      include("templates/vchistoryform.php");
      }
    else if ($action=='searchcal_perc')
      {
      echo("<h3>> Search</h3><center>");
      include("templates/config_cal.php");
      }
    else if ($action!='')
      {
      echo("<h3>> Search</h3><center>");
      include("templates/vplist.php");
      }
    else
      {
      echo("<h3>> Search</h3><center>");
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
    if (($action=='availcheck')&($vc_cli!=''))
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
    echo("<h5>Order Management : &nbsp;&nbsp;<i>> <a href=index.php?page=3>Order</a> &nbsp; > <a href=index.php?page=10>Batch Order</a> &nbsp; > <a href=index.php?page=4>Orders Pending</a> &nbsp; > <a href=index.php?page=4&action=ordertracking>Order Tracking</a> &nbsp; > <a href=index.php?page=4&action=exceptions>Exception Handling</a></i></h5>");
    echo("<h3>> Order / Edit Customer</h3><center>");
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
    echo("<h5>Order Management : &nbsp;&nbsp;<i>> <a href=index.php?page=3>Order</a> &nbsp; > <a href=index.php?page=10>Batch Order</a> &nbsp; > <a href=index.php?page=4>Orders Pending</a> &nbsp; > <a href=index.php?page=4&action=ordertracking>Order Tracking</a> &nbsp; > <a href=index.php?page=4&action=exceptions>Exception Handling</a></i></h5>");
    if ($action=='ordertracking')
      {
      echo("<h3>> Order Tracking</h3><center>");
      include("templates/sendvcxmlorderform.php");
      }
    else if ($action=='exceptions')
      {
      echo("<h3>> Exception Handling</h3><center>");
      }
    else
      {
      echo("<h3>> Orders Pending</h3><center>");
      }
    include("templates/vclist.php");
    }
  else if ($page==5)
    {
    echo("<h5>Capacity Management : &nbsp;&nbsp;<i>> <a href=index.php?page=5>Upgrade Exchanges</a> &nbsp; > <a href=index.php?page=6>Track Exchange Orders</a> &nbsp; > <a href=index.php?page=8>Edit Exchange</a></i></h5>");
    echo("<h3>> Upgrade Exchanges</h3><center>");
    $action='listvpupdemand';
    include("templates/vplist.php");
    }
  else if ($page==6)
    {
    echo("<h5>Capacity Management : &nbsp;&nbsp;<i>> <a href=index.php?page=5>Upgrade Exchanges</a> &nbsp; > <a href=index.php?page=6>Track Exchange Orders</a> &nbsp; > <a href=index.php?page=8>Edit Exchange</a></i></h5>");
    echo("<h3>> Track Exchange Orders</h3><center>");
    $action='listvpordered';
    include("templates/vplist.php");
    }
  else if ($page==7)
    {
    echo("<h3>Configure Exchange</h3><center>");
    if (($action=='vpupgradeconf')||($action=='vpdeliveredconf'))
      {
      if ($debug) echo("CHECKDATA<br>");
      $checkmode='vp';
      include("templates/checkformdata.php");
      }
    if (($ordererror==0)&&($action=='vpupgradeconf'))
      {
      if ($debug) echo("VP ORDER/UPGRADE<br>");
      require("templates/vpupgradeconf.php");
      }
    else if (($ordererror==0)&&($action=='vpdeliveredconf'))
      {
      if ($debug) echo("VP DELIVERED<br>");
      require("templates/vpdeliveredconf.php");
      // vc in vp recalculation
      require("templates/ordercheck.php");
      }
    else
      {
      include("templates/vpedit.php");
      }
    }
  else if ($page=='8')
    {
    echo("<h5>Capacity Management : &nbsp;&nbsp;<i>> <a href=index.php?page=5>Upgrade Exchanges</a> &nbsp; > <a href=index.php?page=6>Track Exchange Orders</a> &nbsp; > <a href=index.php?page=8>Edit Exchange</a></i></h5>");
    echo("<h3>> Edit Exchange</h3><center>");
    include("templates/searchformvporder.php");
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
    echo("<h5>Config : &nbsp;&nbsp;<i>> <a href=index.php?page=11&action=pop>Pops</a> &nbsp; > <a href=index.php?page=11&action=cal>Handover Links</a> &nbsp; > <a href=index.php?page=11&action=rules>Configure Rules</a></i></h5>");
    if ($action=='pop')
      {
        echo("<h3>> Pops</h3><center>");
        include("templates/config_pop.php");
      }
    else if ($action=='popedit')
      {
        echo("<h3>> Change Pops</h3><center>");
        include("templates/popedit.php");
      }
    else if ($action=='popdelete')
      {
        echo("<h3>> Change Pops</h3><center>");
        include("templates/popdelete.php");
      }
    else if ($action=='popupdate')
      {
        echo("<h3>> Update PoP</h3></center>");
	include("templates/popupdate.php");
      }
    else if ($action=='rules')
      {
      echo("<h3>> Configure Rules</h3><center>");
      include("templates/ruleform.php");
      }
    else if ($action=='saverules')
      {
      echo("<h3>> Configure Rules</h3><center>");
      include("templates/rulesave.php");
      }
    else if ($action=='caledit')
      {
        echo("<h3>> Change Handover Link</h3></center>");
	include("templates/caledit.php");
      }
    else if ($action=='caldelete')
      {
        echo("<h3>> Delete Handover Link</h3></center>");
	include("templates/caldelete.php");
      }
    else if ($action=='calupdate')
      {
        echo("<h3>> Update Handover Link</h3></center>");
	include("templates/calupdate.php");
      }
    else 
      {
        echo("<h3>> Handover Links</h3><center>");
        include("templates/config_cal.php");
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
  navibox('Capacity Management',5,$page,$col0,$col1,$col2);
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
    <td bgcolor=$col2 align=center width=90 nowrap>
    <span class=table0>
    <b>$text</b></span></td>
    <td width=12>&nbsp;</td>
    ");
    }
  }



?>
