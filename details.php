<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require '../includes/mpp_dbconn.php';
$variable = $_GET["id"];

if($variable == "rain"){
    $sql = "SELECT precipitation, observationdate, createdate ";
    $sql   .= "FROM rain ORDER BY observationdate desc";
   
    $result = pg_query($db, $sql);
    if (!$result) {
	die("Error in SQL query: " . pg_last_error());
    }
    $results = array(array());
    while ($row = pg_fetch_array($result)) {
	$results[] = $row;
    }
    for ($i=1; $i<count($results); $i++) { 
        echo $results[$i][0] . ", " . $results[$i][1] . ", " . $results[$i][2];
    }
}
?>

