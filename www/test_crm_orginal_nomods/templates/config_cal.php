<?

$bgcolor='#ffeebb';

echo("<center><table border=0>");
echo("<tr bgcolor=$tcolor0>");
echo("<td align=center nowrap><b><a href=index.php?page=$page&sort=cal_id>CAL Id</a></b></td>");
echo("<td align=center nowrap><b><a href=index.php?page=$page&sort=cal_name>CAL Name</a></b></td>");
echo("<td align=center nowrap><b><a href=index.php?page=$page&sort=cal_productiondate>Production Date</a></b></td>");
echo("<td align=center nowrap><b><a href=index.php?page=$page&sort=cal_maxvps>Max VP No</a></b></td>");
echo("<td align=center nowrap><b><a href=index.php?page=$page&sort=cal_bw>Bandwidth</a></b></td>");
echo("<td align=center nowrap><b><a href=index.php?page=$page&sort=cal_state>State</a></b></td>");
echo("<td align=center nowrap><b><a href=index.php?page=$page&sort=btpop_id>BT PoP</a></b></td>");
echo("<td align=center nowrap><b><a href=index.php?page=$page&sort=pop_id>PoP</a></b></td>");
echo("<td align=center nowrap><b><a href=index.php?page=$page&sort=bas_id>B-RAS</a></b></td>");
if ($action=='searchcal_perc'){
	echo("<td align=center nowrap><b><a href=index.php?page=$page&sort=perc>Utilization</a></b></td>");
	$perc=$query;
}
echo("<td align=center nowrap><b>Edit CAL</b></td>");
echo("</tr>");

if ($sort=='') {$sort=1;} 
$orderstm="$sort ASC";

$query="select * from dslprov_cal where 1 order by $orderstm";
$result = mysql_query($query);

while ($line = mysql_fetch_array($result)) {
	if ($line[cal_deleted]!=1) {
		
		if ($action=='searchcal_perc'){
			//calculate utilization
			$vp_query="SELECT SUM(dslprov_vpbw.vpbw_value) FROM dslprov_vpbw,dslprov_vp WHERE dslprov_vp.cal_id=$line[cal_id] AND dslprov_vpbw.vpbw_id=dslprov_vp.vpbw_id";
			$vp_result=MYSQL_QUERY($vp_query);
			$sum=MYSQL_FETCH_ARRAY($vp_result);
			$bw_sum=$sum[0];
			$bw_sum=round($bw_sum/$line[cal_bw]/10, 2);
		}
		if ($action=='searchcal_perc'&&$bw_sum<=$perc) {
			continue;
		}
		$cal_productiondate_iso=get_isodate($line[cal_productiondate]);
// Print table Content
		echo("<tr bgcolor=$bgcolor>");
		echo("<td align=center><b>$line[cal_id]</b></td>");
		echo("<td align=center><b>$line[cal_name]</b></td>");
		echo("<td align=center><b>$cal_productiondate_iso</b></td>");
		echo("<td align=center><b>$line[cal_maxvps]</b></td>");
		echo("<td align=center><b>$line[cal_bw]</b></td>");
		echo("<td align=center><b>$line[cal_state]</b></td>");
		echo("<td align=center><b>$line[btpop_id]</b></td>");
		echo("<td align=center><b>$line[pop_id]</b></td>");
		echo("<td align=center><b>$line[bas_id]</b></td>");
		if ($action=='searchcal_perc') {
			echo("<td align=center><b>$bw_sum %</b></td>");
		}
		echo("<td align=right><a href=index.php?page=11&cal_id=$line[cal_id]&action=caledit>Edit</a></td>");
		echo("</tr>");
	}
}
echo("
<form method=post>
<input type=hidden name=page value=11>
<input type=hidden name=action value=caledit>
  <tr>
   <td colspan=11>
    <center>
    <input type=hidden name=cal_id value=0>
    <input type=submit value='Add new CAL' name=formtype>
    </form>
    </center>
   </td>
  </tr>
");

echo("</table></center>");
?>
