<?php

echo("

<center>
<form method=get>
<input type=hidden name=page value=$page>
<input type=hidden name=action value='saveconfig'>
<input type=hidden name=rep_uri value='$uri'>
<input type=hidden name=rep_string value='$repstring'>
<input type=hidden name=report_type value='$report_type'>

  <table>
  <tr>
    <td colspan=2><h4>Configure Parameters</h4></td>
  </tr>
  <tr>
    <td>Frequency of Report</td>
    <td>
    <select name=rep_frequency>
  ");

  $query="select dayselect_id from dslprov_dayselect";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($value>0 && $value<31)
         {
         print "<option value=$value$sel>";
         print "every $value day(s)</option>\n";
         }
       $j++;
       }
     }

echo("
    </select>
    </td>
  </tr>
  <tr>
    <td>
    Format:
    </td>
    <td>
    <select name=rep_format>
    <option value=csv>csv</option>
    <option value=xml>xml</option>
    </select>
    </td>
  </tr>
  <tr>
    <td>email(csv), URL(xml)
    </td>
    <td>
    <input type=text name=rep_addr size=20>
    </td>
  </tr>
  <tr>
    <td colspan=2><center><br><br>
    <input type=submit value='Save Customer Report Config' name=formtype>
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
