<?

$bgcolor='#ffeebb';

echo("<center><table border=0>");
echo("<tr bgcolor=$tcolor0>");
echo("<td align=center nowrap><b><a href=index.php?page=$page&sort=pop_id>PoP Id</a></b></td>");
echo("<td align=center nowrap><b><a href=index.php?page=$page&sort=pop_name>PoP Name</a></b></td>");
echo("<td align=center nowrap><b><a href=index.php?page=$page&sort=pop_productiondate>Production Date</a></b></td>");
echo("<td align=center nowrap><b><a href=index.php?page=$page&sort=pop_state>State</a></b></td>");
echo("<td align=center nowrap><b><a href=index.php?page=$page&sort=pop_exchange_id>BT Exchange</a></b></td>");
echo("<td align=center nowrap><b>Edit PoP</b></td>");
echo("</tr>");

if ($sort=='') {$sort=1;} 
$orderstm="$sort ASC";

$query="select * from dslprov_pop where 1 order by $orderstm";
$result = mysql_query($query);

// Print table Content
while ($line = mysql_fetch_array($result)) {
	$pop_productiondate_iso=get_isodate($line[pop_productiondate]);
	echo("<tr bgcolor=$bgcolor>");
	echo("<td align=center><b>$line[pop_id]</b></td>");
	echo("<td align=center><b>$line[pop_name]</b></td>");
	echo("<td align=center><b>$pop_productiondate_iso</b></td>");
	echo("<td align=center><b>$line[pop_state]</b></td>");
	$btpop_result=mysql_query("select btpop_exchange_id from dslprov_btpop where 1 AND btpop_id = $line[pop_exchange_id]");
	$pop_exchange_id=mysql_result($btpop_result,0);
	echo("<td align=center><b>$pop_exchange_id</b></td>");
	echo("<td align=right><a href=index.php?page=$page&pop_id=$line[pop_id]&action=popedit>Edit</a></td>");
	echo("</tr>");
}
echo("
<form method=post>
<input type=hidden name=page value=11>
<input type=hidden name=action value=popedit>
  <tr>
   <td colspan=6>
    <center>
    <input type=hidden name=pop_id value=0>
    <input type=submit value='Add new PoP' name=formtype>
    </form>
    </center>
   </td>
  </tr>
");



echo("</table></center>");

?>
