<?
$write=1;

if ((($action=='vcorder')||($action=='vcorderform'))&&($write==1))
  {

// date("d.m.y H:i",$time)
if ($vc_reqdeliverydate=='')
  {
  $vc_reqdeliverydate=date("d.m.y",time()+604800);
  }
echo("

<center>
<form method=post>
<input type=hidden name=page value=3>
<input type=hidden name=action value=vcorder>
<table border=0>
  <tr>
    <td>Title</td>
    <td><input name=vc_title value='$vc_title' size=32></td>
  </tr>
  <tr>
    <td>* Surname</td>
    <td><input name=vc_surname value='$vc_surname' size=32></td>
  </tr>
  <tr>
    <td>First Name</td>
    <td><input name=vc_firstname value='$vc_firstname' size=32></td>
  </tr>
  <tr>
    <td>Premises Name</td>
    <td><input name=vc_premisesname value='$vc_premisesname' size=32></td>
  </tr>
  <tr>
    <td>House Number</td>
    <td><input name=vc_houseno value='$vc_houseno' size=8></td>
  </tr>
  <tr>
    <td>* Street</td>
    <td><input name=vc_street value='$vc_street' size=32></td>
  </tr>
  <tr>
    <td>* City</td>
    <td><input name=vc_city value='$vc_city' size=32></td>
  </tr>
  <tr>
    <td>* Postcode</td>
    <td><input name=vc_postcode value='$vc_postcode' size=8></td>
  </tr>
  <tr>
    <td>* CLI</td>
    <td><input name=vc_cli value='$vc_cli' size=32></td>
  </tr>
  <tr>
    <td>Contact Phone</td>
    <td><input name=vc_contactphone value='$vc_contactphone' size=32></td>
  </tr>
  <tr>
    <td>* Requested Delivery Date DD.MM.YYYY</td>
    <td><input name=vc_reqdeliverydate value='$vc_reqdeliverydate' size=16></td>
  </tr>
  <tr>
    <td>Notes</td>
    <td><input name=vc_notes value='$vc_notes' size=32></td>
  </tr>

  <tr>
    <td>* User Bandwidth</td>
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
         print "$value Kbits</option>\n";
         }
       $j++;
       }
     }

echo("
    </select>
    </td>
  </tr>

  <tr>
    <td>* Contention Ratio</td>
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
    <td>* Realm</td>
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

  <tr>
    <td>BT Product</td>
    <td>
    <select name=btproduct_id>
");

  if ($btproduct_id==0) { $btproduct_id=4; } // INI  DS2000

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
  <tr>
    <td>Ordertype</td>
    <td>
");
  $checked1='';
  $checked2='';
  if ($btuserordertype_id==3)
    {
    $checked3='checked';
    }
  else
    {
    $checked1='checked';
    }

echo("
      <input type=radio name=btuserordertype_id value='1' $checked1>Provide<br>
      <input type=radio name=btuserordertype_id value='3' $checked3>ISDN Convert
    </td>
  </tr>
<!--
  <tr>
    <td>* Confirmations </td>
    <td>
    <input type=checkbox name=confirmations1 value=1> advised of restrictions<br>
    <input type=checkbox name=confirmations2 value=1> check alarm after install<br>     

    <input type=checkbox name=confirmations3 value=1> power details<br>
    <input type=checkbox name=confirmations4 value=1> knows appointment time<br>  

    <input type=checkbox name=confirmations5 value=1> rents line<br>
    </td>
  </tr>
-->
  <tr>
    <td colspan=2><center><br><br>
    <input type=submit value='AddNewCustomer' name=formtype>
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
  include("vcedit2.php");
  }
?>