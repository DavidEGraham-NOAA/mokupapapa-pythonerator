<?php
//David Graham
//queries and returns salinity and turbidity observations for the last 75 days from mokupapapa.turbidity table
//last row returned is the mean salinity and turbidity observations from last 365 days
require '../includes/mpp_dbconn.php';
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

$result = pg_query($db, "SELECT TO_CHAR(observationdate,'YYYYMMDDHH24MI') AS observationdate, salinity, turbidity 
FROM turbidity 
WHERE observationdate >= current_date - interval '75 days' 
AND salinity is not null 
ORDER BY observationdate");
if (!$result) {
        die("Error in SQL query: " . pg_last_error());
} else {
    echo "date,salinity,turbidity";
    while ($row = pg_fetch_array($result)) {
        echo "\n" . $row['observationdate'] . "," . $row['salinity'] . "," . $row['turbidity'];
    }
    pg_free_result($result);

    $avgresult = pg_query($db, "SELECT TO_CHAR(now(),'YYYYMMDDHH24MI') AS observationdate, avg(salinity), avg(turbidity) 
FROM turbidity 
WHERE observationdate >= current_date - interval '365 days' 
AND salinity is not null 
ORDER BY observationdate");
    if(!$avgresult){
        //do nothing
    } else {
        $row = pg_fetch_row($avgresult);
        echo "\n" . $row[0] . "," . $row[1] . "," . $row[2];
    }
    pg_free_result($avgresult);
}
?>
