<?php
//David Graham
//queries and returns wave observations for the last 75 days from mokupapapa.waves table
//last row returned is the mean height and period observations from last 365 days
require '../includes/mpp_dbconn.php';
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

$result = pg_query($db, "SELECT TO_CHAR(observationdate,'YYYYMMDDHH24MI') AS observationdate, height, direction, period 
FROM waves 
WHERE observationdate >= current_date - interval '75 days' 
AND height IS NOT NULL 
ORDER BY observationdate");
if (!$result) {
        die("Error in SQL query: " . pg_last_error());
} else {
    echo "date,height,direction,period";
    while ($row = pg_fetch_array($result)) {
        echo "\n" . $row['observationdate'] . "," . $row['height'] . "," . $row['direction'] . "," . $row['period'];
    }
    pg_free_result($result);

    $avgresult = pg_query($db, "SELECT TO_CHAR(now(),'YYYYMMDDHH24MI') AS observationdate, avg(height), avg(period) 
FROM waves 
WHERE observationdate >= current_date - interval '365 days'");
    if(!$avgresult){
        //do nothing
    } else {
        $row = pg_fetch_row($avgresult);
        echo "\n" . $row[0] . "," . $row[1] . ",," . $row[2];
    }
    pg_free_result($avgresult);
}
?>
