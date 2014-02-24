<?php
//David Graham
//queries and returns wind observations for the last 75 days from mokupapapa.wind table
//last row returned is the mean speed observations from last 365 days
require '../includes/mpp_dbconn.php';
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

$result = pg_query($db, "SELECT TO_CHAR(observationdate,'YYYYMMDDHH24MI') AS observationdate, speed, direction 
FROM wind 
WHERE observationdate >= current_date - interval '75 days' 
AND observationdate IS NOT NULL 
ORDER BY observationdate");
if (!$result) {
        die("Error in SQL query: " . pg_last_error());
} else {
    echo "date,speed,direction";
    $results = array(array());
    while ($row = pg_fetch_array($result)) {
        echo "\n" . $row['observationdate'] . "," . $row['speed'] . "," . $row['direction'];
    }
    pg_free_result($result);

    $avgresult = pg_query($db, "SELECT TO_CHAR(now(),'YYYYMMDDHH24MI') AS observationdate, avg(speed) 
FROM wind 
WHERE observationdate >= current_date - interval '365 days' 
ORDER BY observationdate");
    if(!$avgresult){
        //do nothing
    } else {
        $row = pg_fetch_row($avgresult);
        echo "\n" . $row[0] . "," . $row[1] . ",";
    }
    pg_free_result($avgresult);
}
?>
