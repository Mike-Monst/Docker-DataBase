<?
$report_id=$time;
MYSQL_QUERY("INSERT INTO dslprov_reports VALUES ('$report_id','$report_type','$user_id','$rep_frequency','$rep_format','$rep_addr','$rep_uri','0')"); 
?>