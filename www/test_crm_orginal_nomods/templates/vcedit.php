<?
$write=1;
if ((($action=='vcorder')||($action=='vcorderform'))&&($write==1))
  {
// date("d.m.y H:i",$time)
if ($vc_reqdeliverydate=='')
  {
  get_leadtimes($vc_leadtime,$vp_leadtime);
  $vc_reqdeliverydate=time()+$vc_leadtime;
  $vc_reqdeliverydate=get_isodate($vc_reqdeliverydate);
  }

echo("

<center>
<form method=get>
<input type=hidden name=page value=3>
<input type=hidden name=action value=vcorder>
<input type=hidden name=usercr_id value=1>
<table border=0>
  <tr>
    <td bgcolor=$tcolor1>Reference / Order Number</td>
    <td bgcolor=$tcolor1><input name=vc_visprefnum value='$vc_visprefnum' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>Title</td>
    <td bgcolor=$tcolor0><input name=vc_title value='$vc_title' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>Surname</td>
    <td bgcolor=$tcolor1><input name=vc_surname value='$vc_surname' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>First Name</td>
    <td bgcolor=$tcolor0><input name=vc_firstname value='$vc_firstname' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>Premises Name</td>
    <td bgcolor=$tcolor1><input name=vc_premisesname value='$vc_premisesname' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>House Number</td>
    <td bgcolor=$tcolor0><input name=vc_houseno value='$vc_houseno' size=8></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>Street</td>
    <td bgcolor=$tcolor1><input name=vc_street value='$vc_street' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>City</td>
    <td bgcolor=$tcolor0><input name=vc_city value='$vc_city' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>Postcode</td>
    <td bgcolor=$tcolor1><input name=vc_postcode value='$vc_postcode' size=8></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>CLI</td>
    <td bgcolor=$tcolor0><input name=vc_cli value='$vc_cli' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>Contact Phone</td>
    <td bgcolor=$tcolor1><input name=vc_contactphone value='$vc_contactphone' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>IP</td>
    <td bgcolor=$tcolor0><input name=ip value='$ip' size=32></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>Req. Delivery Date</td>
    <td bgcolor=$tcolor1><input name=vc_reqdeliverydate value='$vc_reqdeliverydate' size=16></td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>BT Product</td>
    <td bgcolor=$tcolor0>
    <select name=btproduct_id>
    <option value=0 selected>auto rule select</option>
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
    <td bgcolor=$tcolor1>Product Bandwidth</td>
    <td bgcolor=$tcolor1>
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
    <td bgcolor=$tcolor0>Contention</td>
    <td bgcolor=$tcolor0>
    <select name=usercr_id>
");
  if ($usercr_id==0) { $usercr_id=4; } // INI  1:20

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
    <td bgcolor=$tcolor1>Realm</td>
    <td bgcolor=$tcolor1>
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
  <tr>
    <td bgcolor=$tcolor0>Ordertype</td>
    <td bgcolor=$tcolor0>
    <select name=btuserordertype_id>
");


  $query="select * from dslprov_btuserordertype";
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
         $tvalue=$value;
         $sel='';
         if ($btuserordertype_id==$value)
           {
           $sel=" selected";
           }
         }
       if ($j==1)
         {
         if ($tvalue!=2)  //CEASE
           {
           print "<option value=$tvalue$sel>$value</option>\n";
           }
         }
       $j++;
       }
     }


echo("
    </select>
    </td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>Migration Key (ISonly)</td>
    <td bgcolor=$tcolor1><input name=vc_migkey value='$vc_migkey' size=32></td>
  </tr>
  <tr>
    <td colspan=2><center><br><br>
    <input type=submit value='Order' name=formtype>
    </center> 
   </td>
  </tr>
</table>
</form>
</center>
");

$vc_confirmations='11111';
$sur = substr($vc_surname, 0, 1); 
$first = substr($vc_firstname, 0, 1);
$vc_initials=strtoupper($first.$sur);

$vc_btaccountcode='';
$vc_visprefnum='';
$vc_resellernotes='';

  }
else
  { 
  include("vcedit_upgrade.php");
  }
?>
