<?
echo("<center><h4>REPORT HAS BEEN DELETED.</h4></center>");
    MYSQL_QUERY("update dslprov_reports set deleted='1' where report_id='$report_id'");
?>
