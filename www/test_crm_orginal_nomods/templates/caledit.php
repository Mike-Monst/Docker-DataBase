<?
$submitvalue='';
$actionflag=0;

  $query="select * from dslprov_cal where cal_id LIKE '$cal_id'";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  $rowarray=mysql_fetch_array($result);
  $cal_id=$rowarray['cal_id'];
  $bas_id=$rowarray['bas_id'];
  $pop_id=$rowarray['pop_id'];
  $btpop_id=$rowarray['btpop_id'];
  $cal_name=$rowarray['cal_name'];
  $cal_csac=$rowarray['cal_csac'];
  $cal_productiondate=$rowarray['cal_productiondate'];
  $cal_maxvps=$rowarray['cal_maxvps'];
  $cal_bw=$rowarray['cal_bw'];
  $cal_state=$rowarray['cal_state'];
  $cal_deleted=$rowarray['cal_deleted'];
  $cal_deleteddate=$rowarray['cal_deleteddate'];


if ($action=='caledit')
  {
  $act="<input type=hidden name=action value=calupdate>";
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
    <td>CAL Id</td>
    <td>$cal_id<input type=hidden name=cal_id value='$cal_id'></td>
  </tr>
");
echo("
  <tr>
    <td>CAL Name</td>
    <td><input name=cal_name value='$cal_name'></td>
  </tr>
");

$cal_productiondate_iso=get_isodate($cal_productiondate);
echo("
  <tr>
    <td>Production Date</td>
    <td><input name=cal_productiondate value='$cal_productiondate_iso'></td>
  </tr>
");

if ($cal_state==1) {
  $alt_state=10;
} else if ($cal_state=='') {
  $cal_state=10;
  $alt_state=1;
} else {
  $alt_state=1;
}
$states = array (1 => 'productive', 10 => 'ordered');
echo("
  <tr>
    <td>State</td>
    <td><select name=cal_state>
    <option value=$cal_state selected>$states[$cal_state]</option>
    <option value=$alt_state>$states[$alt_state]</option></td>
  </tr>
");
echo("
  <tr>
    <td>Max VP No</td>
    <td><input name=cal_maxvps value='$cal_maxvps'></td>
  </tr>
");

if ($cal_bw==155) {
  $alt_bw=622;
} else if ($cal_bw=='') {
  $cal_bw=155;
  $alt_bw=622;
} else {
  $alt_bw=155;
}

echo("
  <tr>
    <td>Bandwidth</td>
    <td><select name=cal_bw>
    <option value=$cal_bw selected>$cal_bw Mbit</option>
    <option value=$alt_bw>$alt_bw Mbit</option></td>
  </tr>
");

echo("
  <tr>
    <td>PoP</td>
    <td><select name=pop_id>
");

  $query="select * from dslprov_pop";  
  $result = mysql_query($query);

while ($line=mysql_fetch_array($result))
{
  $sel="";
  if ($line[pop_id]==$pop_id) {$sel="selected";}
  echo("<option value=$line[pop_id]$sel>$line[pop_name]</option>");
}
echo("</td>
  </tr>
");

echo("
  <tr>
    <td>BRAS</td>
    <td><input name=bas_id value='$bas_id'></td>
  </tr>
");

echo("
  <tr>
    <td colspan=2><center><br><br>
    <input type=hidden name=cal_id value=$cal_id>
    <input type=submit value=$submitvalue name=formtype>
    </form>  
   </center> 
   </td>
  </tr>
");
echo("
<form method=post>
<input type=hidden name=page value=11>
<input type=hidden name=action value=caldelete>
  <tr>
   <td colspan=2><center>
    <input type=hidden name=cal_id value=$cal_id>
    <input type=submit value=Delete name=formtype>
    </form>
    </center>
   </td>
  </tr>

</table>
</center>
");

?>
