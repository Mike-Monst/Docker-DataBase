<?

$ne_query="SELECT * FROM dslprov_btexchangeco WHERE 1 AND exchange_id = '$vca_exchangecode'";
$ne_result=MYSQL_QUERY ($ne_query);
$ne_exchange=MYSQL_FETCH_ARRAY($ne_result, MYSQL_ASSOC);
//var_dump($ne_exchange);
echo ("<hr>");

$pop_query=("SELECT dslprov_pop.pop_id,dslprov_btpop.btpop_exchange_id,dslprov_btexchangeco.exchange_easting,dslprov_btexchangeco.exchange_northing FROM dslprov_btpop,dslprov_pop,dslprov_btexchangeco WHERE 1 AND dslprov_pop.pop_state=1 AND dslprov_pop.pop_exchange_id = dslprov_btpop.btpop_id AND dslprov_btpop.btpop_exchange_id = dslprov_btexchangeco.exchange_id");
$pop_result=MYSQL_QUERY($pop_query);

$distance=array();
while ($pop_map=MYSQL_FETCH_ARRAY($pop_result, MYSQL_ASSOC)) {
	$east=$pop_map[exchange_easting]-$ne_exchange[exchange_easting];
	$nort=$pop_map[exchange_northing]-$ne_exchange[exchange_northing];
	$mypopid=$pop_map[pop_id];
	$distance[$mypopid]=hypot($east,$nort);
	$dummy=$distance[$mypopid];
}

asort ($distance);
reset ($distance);

foreach ( $distance as $k=>$v ){
	$cal_query="SELECT cal_id FROM dslprov_cal WHERE dslprov_cal.pop_id=$k";
	$cal_result=MYSQL_QUERY($cal_query);
	while ($cal_loop=MYSQL_FETCH_ARRAY($cal_result)) {
		$vp_query="SELECT SUM(dslprov_vpbw.vpbw_value) FROM dslprov_vpbw,dslprov_vp WHERE dslprov_vp.cal_id=$cal_loop[0] AND dslprov_vpbw.vpbw_id=dslprov_vp.vpbw_id";
		$vp_result=MYSQL_QUERY($vp_query);
		$bw_sum=MYSQL_FETCH_ARRAY($vp_result);
//		echo("POP:$k DISTANCE:$v CAL:$cal_loop[0] SUM:$bw_sum[0]<br>");
		$cal_selection[$k][$cal_loop[0]]=$bw_sum[0];
	}
}

$choose_cal='';
foreach ($cal_selection as $k=>$v) {
	asort ($cal_selection[$k]);
	reset ($cal_selection[$k]);
	foreach ($cal_selection[$k] as $k2=>$v2) {
		// here we can insert several other contrains.
		if (TRUE) {
			if ($choose_cal!=1) {
				echo ("POP_ID: $k CAL_ID: $k2<br>");
				$cal_id=$k2;
				
			}
			$choose_cal=1;
		}
	}
}
?>
