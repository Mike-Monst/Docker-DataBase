<?
require ("../config.inc.php");
$result=mysql_query("DELETE FROM `dslprov_vc` WHERE `vc_cli` >= '01234500000' AND `vc_cli` <= '01234599999'");

if ( $result == 1 ) {
  echo "<h2>Customer test data successfully purged<h2><hr>";
};

$result=mysql_query("DELETE FROM `dslprov_vp` WHERE `exchange_id` = 'ABCDC'");
if ( $result == 1 ) {
  echo "<h2>VP test data successfully purged<h2><hr>";
}
else {
  echo "$result<hr>";
};

$result=mysql_query("UPDATE `dslprov_vp` SET `vpbw_id` = '2' WHERE `exchange_id` = 'ABCDD'");

?>



