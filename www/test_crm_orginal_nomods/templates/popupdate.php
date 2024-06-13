<?
if ($pop_id==''||$pop_id==0) {
	$pop_id=time();
	$pop_productiondate=get_sertime($pop_productiondate);
	MYSQL_QUERY("INSERT INTO dslprov_pop VALUES ('$pop_id','$pop_name','$pop_productiondate','$pop_state','0','0','$pop_exchange_id')");
	echo("<h4>$result NEW POP $pop_name HAS BEEN ADDED</h4><br>");
}
else {
	echo("<h4>PoP $pop_name HAS BEEN MODIFIED.</h4><br>");
	$pop_productiondate=get_sertime($pop_productiondate);
	MYSQL_QUERY("update dslprov_pop set pop_name='$pop_name',pop_productiondate='$pop_productiondate',pop_state='$pop_state',pop_exchange_id='$pop_exchange_id' where pop_id='$pop_id'");
}
?>
