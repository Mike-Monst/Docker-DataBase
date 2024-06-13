<?
//FIXME We have to check, if there are still VPs connected to this CAL
  echo("<h4>CAL $cal_name WILL BE DELETED</h4><br>");
  $cal_deleted=1; 
  $cal_deleteddate=time();
  MYSQL_QUERY("update dslprov_cal set cal_deleted='$cal_deleted',cal_deleteddate='$cal_deleteddate' where cal_id='$cal_id'");
?>
