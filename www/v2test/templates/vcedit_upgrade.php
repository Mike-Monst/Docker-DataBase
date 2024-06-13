<?php
$write=1;

$submitvalue='';
$actionflag=0;


  $query="select * from dslprov_vc where vc_id LIKE '$vc_id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  $rowarray=mysql_fetch_array($result);

  $vc_state=$rowarray['vc_state'];
  $vp_id=$rowarray['vp_id'];
  $vc_vci=$rowarray['vc_vci'];
  $btuserordertype_id=$rowarray['btuserordertype_id'];
  $btproduct_id=$rowarray['btproduct_id'];
  $vc_title=$rowarray['vc_title'];
  $vc_surname=$rowarray['vc_surname'];
  $vc_firstname=$rowarray['vc_firstname'];
  $vc_initials=$rowarray['vc_initials'];
  $vc_premisesname=$rowarray['vc_premisesname'];
  $vc_houseno=$rowarray['vc_houseno'];
  $vc_street=$rowarray['vc_street'];
  $vc_city=$rowarray['vc_city'];
  $vc_postcode=$rowarray['vc_postcode'];
  $vc_cli=$rowarray['vc_cli'];
  $vc_contactphone=$rowarray['vc_contactphone'];
  $vc_orderdate=$rowarray['vc_orderdate'];
  $vc_reqdeliverydate=$rowarray['vc_reqdeliverydate'];
  $vc_productiondate=$rowarray['vc_productiondate'];
  $vc_notes=$rowarray['vc_notes'];
  $vc_resellernotes=$rowarray['vc_resellernotes'];
  $vc_carelevel=$rowarray['vc_carelevel'];
  $userbw_id=$rowarray['userbw_id'];
  $usercr_id=$rowarray['usercr_id'];
  $userrealm_id=$rowarray['userrealm_id'];
  $vc_cbuk=$rowarray['vc_cbuk'];


if ((($action=='vcupgrade')||($action==vcupgradeconf))&&($write==1))
  {
  $actionflag=1;
  $act="<input type=hidden name=action value=vcupgradeconf>";
  $submitvalue='Update/Modify';
  }
else
  {
  $actionflag=2;
  }


echo("

<center>
<form method=post>
<input type=hidden name=page value=3>
<input type=hidden name=vc_state value=$vc_state>
$act
<table border=0>
  <tr>
    <td>Title</td>
    <td>$vc_title<input type=hidden name=vc_title value='$vc_title'></td>
  </tr>
  <tr>
    <td>Surname</td>
    <td>$vc_surname<input type=hidden name=vc_surname value='$vc_surname'></td>
  </tr>
  <tr>
    <td>First Name</td>
    <td>$vc_firstname<input type=hidden name=vc_firstname value='$vc_firstname'></td>
  </tr>
  <tr>
    <td>Initials</td>
    <td>$vc_initials<input type=hidden name=vc_initials value='$vc_initials'></td>
  </tr>
  <tr>
    <td>Premises Name</td>
    <td>$vc_premisesname<input type=hidden name=vc_premisesname value='$vc_premisesname'></td>
  </tr>
  <tr>
    <td>House Number</td>
    <td>$vc_houseno<input type=hidden name=vc_houseno value='$vc_houseno'></td>
  </tr>
  <tr>
    <td>Street</td>
    <td>$vc_street<input type=hidden name=vc_street value='$vc_street'></td>
  </tr>
  <tr>
    <td>City</td>
    <td>$vc_city<input type=hidden name=vc_city value='$vc_city'></td>
  </tr>
  <tr>
    <td>Postcode</td>
    <td>$vc_postcode<input type=hidden name=vc_postcode value='$vc_postcode'></td>
  </tr>
  <tr>
    <td>CLI</td>
    <td>$vc_cli<input type=hidden name=vc_cli value='$vc_cli'></td>
  </tr>
  <tr>
    <td>Contact Phone</td>
    <td>$vc_contactphone<input type=hidden name=vc_contactphone value='$vc_contactphone'></td>
  </tr>
  <tr>
    <td>Requested Delivery Date</td>
    <td>$vc_reqdeliverydate<input type=hidden name=vc_reqdeliverydate value='$vc_reqdeliverydate'></td>
  </tr>
  <tr>
    <td>Order Date</td>
    <td>$vc_orderdate<input type=hidden name=vc_reqdeliverydate value='$vc_reqdeliverydate'></td>
  </tr>
<!--  <tr>
    <td>Reseller Notes</td>
    <td>$vc_resellernotes<input type=hidden name=vc_resellernotes value='$vc_resellernotes' size=32></td>
  </tr>

  <tr>
    <td>Notes</td>
    <td><input name=vc_notes value='$vc_notes' size=32></td>
  </tr>
-->  <tr>
    <td>CBUK</td>
    <td><input name=vc_cbuk value='$vc_cbuk' size=16></td>
  </tr>
  <tr>
    <td>VCI</td>
    <td><input name=vc_vci value='$vc_vci' size=16></td>
  </tr>
  <tr>
    <td>IP</td>
    <td><input name=ip value='$ip' size=32></td>
  </tr>
  <tr>
    <td>BT Product</td>
    <td>
    <select name=btproduct_id>
");

  $query="select * from dslprov_btproduct";  
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if (is_numeric($value)) { $value = (int)$value; }
       if ($j==0)
         {
         $sel='';
         if ($btproduct_id==$value)
           {
           $sel=" selected";
           }
         print "<option value=$value$sel>";
         }
       if ($j==1)
         {
         print "$value</option>\n";
         }
       $j++;
       }
     }

echo("
    </select>
    </td>
  </tr>

  <tr>
    <td>Product Bandwidth</td>
    <td>
    <select name=userbw_id>
");

  $query="select * from dslprov_userbw";  
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if (is_numeric($value)) { $value = (int)$value; }
       if ($j==0)
         {
         $sel='';
         if ($userbw_id==$value)
           {
           $sel=" selected";
           }
         print "<option value=$value$sel>";
         }
       if ($j==1)
         {
         print "$value KBit/s</option>\n";
         }
       $j++;
       }
     }

echo("
    </select>
    </td>
  </tr>

  <tr>
    <td>Contention</td>
    <td>
    <select name=usercr_id>
");

  $query="select * from dslprov_usercr";  
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if (is_numeric($value)) { $value = (int)$value; }
       if ($j==0)
         {
         $sel='';
         if ($usercr_id==$value)
           {
           $sel=" selected";
           }
         print "<option value=$value$sel>";
         }
       if ($j==1)
         {
         print "1 : $value</option>\n";
         }
       $j++;
       }
     }

echo("
    </select>
    </td>
  </tr>

  <tr>
    <td>Realm</td>
    <td>
    <select name=userrealm_id>
");


  $query="select * from dslprov_userrealm";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if (is_numeric($value)) { $value = (int)$value; }
       if ($j==0)
         {
         $sel='';
         if ($userrealm_id==$value)
           {
           $sel=" selected";
           }
         print "<option value=$value$sel>";
         }
       if ($j==2)
         {
         print "$value</option>\n";
         }
       $j++;
       }
     }

echo("
    </select>
    </td>
  </tr>

<!--

  <tr>
    <td>Care Level</td>
    <td>
");
  $checked1='';
  $checked2='';
  if ($vc_carelevel==2)
    {
    $checked2='checked';
    }
  else
    {
    $checked1='checked';
    }
  
echo("
      <input type=radio name=vc_carelevel value='1' $checked1>Standard<br>
      <input type=radio name=vc_carelevel value='2' $checked2>Enhanced
    </td>
  </tr>

-->

  <tr>
    <td>BT Ordertype</td>
    <td>
");
  if ($btuserordertype_id==3)
    {
    $value='ISDN Conversion';
    }
  else
    {
    $value='Provide';
    }

echo("
      $value<input type=hidden name=btuserordertype_id value=$value>
    </td>
  </tr>
  <tr>
    <td>VC State</td>
    <td>
");
$value=get_vcstate($vc_state);
echo("$value<input type=hidden name=vc_state value=$vc_state>
    </td>
  </tr>
  <tr>
    <td colspan=2><center><br><br>
    <input type=hidden name=vc_id value=$vc_id>
    <input type=submit value=$submitvalue name=formtype>
    </form>  
   </center> 
   </td>
  </tr>

<form method=post>
<input type=hidden name=page value=3>
<input type=hidden name=action value=delete>
  <tr>
    <td colspan=2><center>
    <input type=hidden name=vc_id value=$vc_id>
    <input type=submit value=Delete name=formtype>
    </form>
   </center>
   </td>
  </tr>

</table>
</center>
");


$vc_btaccountcode='';
$vc_visprefnum='';

?>
