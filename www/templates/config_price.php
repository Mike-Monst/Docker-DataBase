<?php
echo("

<center>
<form method=get>
<input type=hidden name=page value=9>
<input type=hidden name=action value=vcorder>
<table border=0>
  <tr>
    <td bgcolor=$tcolor1><b>Bandwidth</b></td>
    <td bgcolor=$tcolor1><b>Contention</b></td>
    <td bgcolor=$tcolor1><b>Usage Price</b></td>
    <td bgcolor=$tcolor1><b>Installation Price</b></td>
  </tr>

");

  $tcolorx=$tcolor0;
  $query="select * from dslprov_userpricing where userrealm_id like '$userrealm_id'";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($j==1)
         {
         $tvalue=get_userbw($value);
         print "<tr><td bgcolor=$tcolorx>$tvalue</td>";
         }
       if ($j==2)
         {
         $tvalue=get_usercr($value);
         print "<td bgcolor=$tcolorx>$talue</td>";
         }
       if ($j==3)
         {
         print "<td bgcolor=$tcolorx>$value</td>";
         }
       if ($j==4)
         {
         print "<td bgcolor=$tcolorx>$value</td>";
         print "</tr>";
         $tcolorx=toggle_color($tcolorx,$tcolor0,$tcolor1);
         }


       $j++;
       }
     }

echo("
  <tr>
    <th colspan=4 bgcolor=$tcolorx>Add New:</th>
  </tr>
  <tr>    
    <td bgcolor=$tcolorx><input type=text size=10 name=newbw></td>
    <td bgcolor=$tcolorx><input type=text size=10 name=newcr></td>
    <td bgcolor=$tcolorx><input type=text size=10 name=newmprice></td>
    <td bgcolor=$tcolorx><input type=text size=5 name=newiprice></td>
  </tr>
  <tr>
    <td colspan=4><center><br><br>
    <input type=submit value='Save Changes' name=formtype>
    </center> 
   </td>
  </tr>
</table>
</form>
</center>
");

?>
