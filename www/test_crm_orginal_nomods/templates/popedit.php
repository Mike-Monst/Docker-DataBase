<?
$submitvalue='';
$actionflag=0;

  $query="select * from dslprov_pop where pop_id LIKE '$pop_id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  $rowarray=mysql_fetch_array($result);
  $pop_id=$rowarray['pop_id'];
  $pop_name=$rowarray['pop_name'];
  $pop_productiondate=$rowarray['pop_productiondate'];
  $pop_state=$rowarray['pop_state'];
  $pop_exchange_id=$rowarray['pop_exchange_id'];

if ($action=='popedit')
  {
  $act="<input type=hidden name=action value=popupdate>";
  $submitvalue='Update/Modify';
  }

echo("

<center>
<form method=post>
<input type=hidden name=page value=11>
$act
<table border=0>
");
echo("
  <tr>
    <td>PoP Id</td>
    <td>$pop_id<input type=hidden name=pop_id value='$pop_id'></td>
  </tr>
");
echo("
  <tr>
    <td>PoP Name</td>
    <td><input name=pop_name value='$pop_name'></td>
  </tr>
");
$pop_productiondate_iso=get_isodate($pop_productiondate);
echo("
  <tr>
    <td>Production Date</td>
    <td><input name=pop_productiondate value='$pop_productiondate_iso'></td>
  </tr>
");

if ($pop_state==1) {
  $alt_state=10;
} else if ($pop_state=='') {
  $pop_state=10;
  $alt_state=1;
} else {
  $alt_state=1;
}
$states = array (1 => 'productive', 10 => 'ordered');
echo("
  <tr>
    <td>State</td>
    <td><select name=pop_state>
    <option value=$pop_state selected>$states[$pop_state]</option>
    <option value=$alt_state>$states[$alt_state]</option>
    </td>
  </tr>
");
echo("
  <tr>
    <td>Exchange</td>
    <td><select name=pop_exchange_id>
");

  $query="select * from dslprov_btpop";  
  $result = mysql_query($query);

while ($line=mysql_fetch_array($result))
{
  $sel="";
  if ($line[btpop_id]==$pop_exchange_id) {$sel=" selected";}
  echo("<option value=$line[btpop_id]$sel>$line[btpop_name]</option>");
}

echo("
    </select>
    </td>
  </tr>
");


echo("
  <tr>
    <td colspan=2><center><br><br>
    <input type=hidden name=pop_id value=$pop_id>
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
    <input type=hidden name=pop_id value=$pop_id>
    <input type=submit value=Delete name=formtype>
    </form>
    </center>
   </td>
  </tr>

</table>
</center>
");



?>
