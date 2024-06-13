<?php
// date("d.m.y H:i",$time)

if ($month=='')
  {
  $month=date("m",time())-1;
  $year=date("y",time());
  if ($month==12) {$year--;}
  }
echo("

<center>
<form method=get>
<input type=hidden name=page value=13>
<input type=hidden name=action value=qualreport>
<table border=0>
  <tr>
    <td>Realm</td>
    <td>
    <select name=userrealm_id>
<!--    <option value=all>all</option> -->
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
    <td>Month</td>
    <td>
    <select name=month>
");

for($i=1;$i<13;$i++)
  {
  $pre='';
  $sel='';
  if ($month==$i)
    {
    $sel=" selected";
    }
  if ($i<10) {$pre="0";}
  print "<option value=$i$sel>";
  print "$pre$i</option>\n";
  }
echo("
    </select>
    </td>
  </tr>
  <tr>
    <td>Year</td>
    <td>
    <select name=year>
");

for($i=3;$i<6;$i++)
  {
  $pre='';
  $sel='';
  if ($year==$i)
    {
    $sel=" selected";
    }
  print "<option value=200$i$sel>";
  print "200$i</option>\n";
  }
echo("
    </select>
    </td>
  </tr>
  <tr>
    <td colspan=2><center><br><br>
    <input type=submit value='Show Report' name=formtype>
    </center>
   </td>
  </tr>

</table>
</form>
</center>
");

?>