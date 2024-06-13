<?

echo("

<center>
<form method=get>
<input type=hidden name=page value=20>
<input type=hidden name=action value='searchvp_cal'>

<table border=0>
  <tr>
    <td>VP by CAL</td>
    <td>
    <select name=query>
");

  $query="select cal_id,cal_name from dslprov_cal";
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
         $h=$i+1;
         if ($cal_id==$h)
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
    <td>
    <input type=submit value='Search' name=formtype>
    </td>
  </tr>
</form>
<form method=get>
<input type=hidden name=page value=20>
<input type=hidden name=action value='searchvp_state'>

  <tr>
    <td>VP State</td>
    <td>
    <select name=query>
");

  $query="select vpstate_id,vpstate_value from dslprov_vpstate";
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
    <td>    
    <input type=submit value='Search' name=formtype>
    </td>
  </tr>
</form>
<form method=get>
<input type=hidden name=page value=20>
<input type=hidden name=action value='searchvp_bwperc'>
  <tr>
    <td>VP BW usage > %</td>
    <td><input name=query value='$vpbw_usage' size=16></td>
    <td>
    <input type=submit value='Search' name=formtype>
    </td>
  </tr>
</form>
<form method=get>
<input type=hidden name=page value=20>
<input type=hidden name=action value='searchvp_portsperc'>
  <tr>
    <td>VP Ports usage > %</td>
    <td><input name=query value='$vp_portsusage' size=16></td>
    <td>
    <input type=submit value='Search' name=formtype>
    </td>
  </tr>
</form>
<form method=get>
<input type=hidden name=page value=20>
<input type=hidden name=action value='searchcal_perc'>
  <tr>
    <td>CAL/Central BW usage > %</td>
    <td><input name=query value='$cal_usage' size=16></td>
    <td>
    <input type=submit value='Search' name=formtype>
    </td>
  </tr>
</form>

</table>
</center>
<br><br>
");


?>
