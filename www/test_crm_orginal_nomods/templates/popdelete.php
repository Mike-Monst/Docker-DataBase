<?

//FIXME We need to check, if there are still CALs connected to this PoP
  echo("<h4>POP $pop_name WILL BE DELETED</h4><br>");
  $pop_deleted=1; 
  $pop_deleteddate=time();
  MYSQL_QUERY("update dslprov_pop set pop_deleted='$pop_deleted',pop_deleted='$pop_deleteddate' where pop_id='$pop_id'");
?>
