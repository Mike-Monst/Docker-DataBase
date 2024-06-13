<?

echo("

<center>
<table border=0>

<form method=get>
<input type=hidden name=page value=1>
<input type=hidden name=action value='searchvp_dsuk'>
  <tr>
    <td>DSLAM</td>
    <td><input name=query value='$vp_dsuk' size=8></td>
    <td>
    <input type=submit value='Search' name=formtype>
    </td>
  </tr>
</form>
<form method=get>
<input type=hidden name=page value=1>
<input type=hidden name=action value='searchvp_ex'>

<table border=0>

  <tr>
    <td>Exchange</td>
    <td>
    <select name=query>
");

  $query="select exchange_id,exchange_name from dslprov_btexchange order by exchange_name";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($j==0)
         {
         print "<option value=$value>$value , ";
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

</table>
</center>
<br><br>
");


?>
