<?

echo("

<center>
<form method=get>
<input type=hidden name=page value=20>
<input type=hidden name=action value='searchvc'>

<table border=0>
  <tr>
    <td bgcolor=$tcolor0>Realm</td>
    <td bgcolor=$tcolor0 colspan=3>
    <select name=userrealm_id>
");


  $query="select * from dslprov_userrealm";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
print"<option value=0 selected>all</option>";
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
    <td bgcolor=$tcolor1>BT Product</td>
    <td colspan=3 bgcolor=$tcolor1>
    <select name=btproduct_id>
");


  $query="select * from dslprov_btproduct";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
print"<option value=0 selected>all</option>";
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
    <td bgcolor=$tcolor0>Product Bandwidth</td>
    <td colspan=3 bgcolor=$tcolor0>
    <select name=userbw_id>
");


  $query="select * from dslprov_userbw";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
print"<option value=0 selected>all</option>";
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
    <td bgcolor=$tcolor1>Contention</td>
    <td colspan=3 bgcolor=$tcolor1>
    <select name=usercr_id>
");

  $query="select * from dslprov_usercr";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
print"<option value=0 selected>all</option>";
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
    <td bgcolor=$tcolor0>State</td>
    <td bgcolor=$tcolor0 colspan=3>
    <select name=vc_state>
");

  $query="select vcstate_id,vcstate_value from dslprov_vcstate";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
print"<option value=0 selected>all</option>";
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($j==0)
         {
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
    <td bgcolor=$tcolor1>Order Date from</td>
    <td bgcolor=$tcolor1>
    <select name=orderdatefrom>
");

  $query="select dayselect_id,dayselect_value from dslprov_dayselect order by dayselect_id";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
print"<option value=></option>";
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($j==0)
         {
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
    <td bgcolor=$tcolor1>to</td>
    <td bgcolor=$tcolor1>
    <select name=orderdateto>
");

  $query="select dayselect_id,dayselect_value from dslprov_dayselect order by dayselect_id";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
print"<option value=></option>";
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($j==0)
         {
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
    <td bgcolor=$tcolor0>Req. Delivery Date from</td>
    <td bgcolor=$tcolor0>
    <select name=reqdeliverydatefrom>
");

  $query="select dayselect_id,dayselect_value from dslprov_dayselect order by dayselect_id";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
print"<option value=></option>";
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($j==0)
         {
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
    <td bgcolor=$tcolor0>to</td>
    <td bgcolor=$tcolor0>
    <select name=reqdeliverydateto>
");

  $query="select dayselect_id,dayselect_value from dslprov_dayselect order by dayselect_id";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
print"<option value=></option>";
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($j==0)
         {
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
    <td bgcolor=$tcolor1>Commit Date from</td>
    <td bgcolor=$tcolor1>
    <select name=commitdatefrom>
");

  $query="select dayselect_id,dayselect_value from dslprov_dayselect order by dayselect_id";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
print"<option value=></option>";
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($j==0)
         {
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
    <td bgcolor=$tcolor1>to</td>
    <td bgcolor=$tcolor1>
    <select name=commitdateto>
");

  $query="select dayselect_id,dayselect_value from dslprov_dayselect order by dayselect_id";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
print"<option value=></option>";
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($j==0)
         {
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
    <td bgcolor=$tcolor0>Installation Date from</td>
    <td bgcolor=$tcolor0>
    <select name=installationdatefrom>
");

  $query="select dayselect_id,dayselect_value from dslprov_dayselect order by dayselect_id";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
print"<option value=></option>";
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($j==0)
         {
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
    <td bgcolor=$tcolor0>to</td>
    <td bgcolor=$tcolor0>
    <select name=installationdateto>
");

  $query="select dayselect_id,dayselect_value from dslprov_dayselect order by dayselect_id";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
print"<option value=></option>";
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($j==0)
         {
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
    <td bgcolor=$tcolor1>Production Date from</td>
    <td bgcolor=$tcolor1>
    <select name=productiondatefrom>
");

  $query="select dayselect_id,dayselect_value from dslprov_dayselect order by dayselect_id";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
print"<option value=></option>";
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($j==0)
         {
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
    <td bgcolor=$tcolor1>to</td>
    <td bgcolor=$tcolor1>
    <select name=productiondateto>
");

  $query="select dayselect_id,dayselect_value from dslprov_dayselect order by dayselect_id";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
print"<option value=></option>";
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($j==0)
         {
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
  <tr>
    <td bgcolor=$tcolor0>Cancel Date from</td>
    <td bgcolor=$tcolor0>
    <select name=canceldatefrom>
");

  $query="select dayselect_id,dayselect_value from dslprov_dayselect order by dayselect_id";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
print"<option value=></option>";
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($j==0)
         {
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
    <td bgcolor=$tcolor0>to</td>
    <td bgcolor=$tcolor0>
    <select name=canceldateto>
");

  $query="select dayselect_id,dayselect_value from dslprov_dayselect order by dayselect_id";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
print"<option value=></option>";
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($j==0)
         {
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
    <td colspan=4><center><br><br>
    <input type=submit value='Generate Customer Report' name=formtype>
    </center> 
   </td>
  </tr>
</table>
</form>

</table>
</center>
<br><br>
");


?>
