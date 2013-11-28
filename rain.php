<?php
require '../includes/mpp_dbconn.php';

$res = pg_query($db, "SELECT max(createdate) as thedate FROM rain;");
if(!$res){
	die("Error in SQL query: " . pg_last_error());
}
$raindate = pg_fetch_result($res, 0, 0);
?>
