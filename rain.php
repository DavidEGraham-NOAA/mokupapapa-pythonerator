<?php
require '../includes/mpp_dbconn.php';
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

$raindate = pg_fetch_result($res, 0, 0);
$result = pg_query($db, "SELECT TO_CHAR(observationdate,'YYYYMMDDHH24MI') AS observationdate, precipitation FROM rain WHERE observationdate >= current_date - interval '30 days' ORDER BY observationdate");
if (!$result) {
	die("Error in SQL query: " . pg_last_error());
}
$results = array(array());
while ($row = pg_fetch_array($result)) {
	echo $row['observationdate'] . "," . $row['precipitation'] . "\n"; 
	$results[] = $row;
}
pg_free_result($result);
?>
