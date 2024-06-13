<?
if ($cal_id==''||$cal_id==0) {
  $cal_id=time();
  $cal_productiondate=get_sertime($cal_productiondate);  
  MYSQL_QUERY("INSERT INTO dslprov_cal VALUES ('$cal_id','$bas_id','$pop_id','0','$cal_name','0','$cal_productiondate','$cal_maxvps','$cal_bw','$cal_state','0','0')");
  echo ("<h4>$result NEW CAL $cal_name HAS BEEN ADDED</h4><br>");
}
else {
  echo("<h4>CAL $cal_name HAS BEEN MODIFIED.</h4><br>");
  $cal_productiondate=get_sertime($cal_productiondate);  
  MYSQL_QUERY("update dslprov_cal set cal_name='$cal_name',cal_productiondate='$cal_productiondate',cal_state='$cal_state',cal_maxvps='$cal_maxvps',cal_bw='$cal_bw',pop_id='$pop_id' where cal_id='$cal_id'");
}
?>
