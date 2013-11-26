<?php
require '../includes/mpp_dbconn.php';

?>
<!doctype html>

<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Mokupapapa Kiosk Server Dashboard</title>
<meta name="description" content="Admin dashboard for kiosk web/content server">
<meta name="author" content="Dave Graham">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="/favicon.ico">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link rel="stylesheet" href="css/style.css?v=2">
<!-- fluid 960 -->
<link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
<!-- superfish menu -->
<link rel="stylesheet" type="text/css" href="css/superfish.css" media="screen" />
<!-- tags css -->
<link rel="stylesheet" href="css/jquery.tagsinput.css">
<!-- treeview css -->
<link rel="stylesheet" href="css/jquery.treeview.css">
<!-- dataTable css -->
<link rel="stylesheet" href="css/demo_table_jui.css">
<!-- fluid GS -->
<link rel="stylesheet" type="text/css" href="css/fluid.gs.css" media="screen" />
<!-- //jqueryUI css -->
<link type="text/css" href="css/custom-theme/jquery-ui-1.8.13.custom.css" rel="stylesheet" />

<!-- <link type="text/css" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" />-->

<!-- //jquery -->
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script> -->
<!-- <script src="js/libs/jquery-1.5.1.min.js"></script>-->

<script>!window.jQuery && document.write(unescape('%3Cscript src="js/libs/jquery-1.5.1.min.js"%3E%3C/script%3E'))</script>
<!-- //jqueryUI -->
<script type="text/javascript" src="js/jquery-ui-1.8.13.custom.min.js"></script>

<!-- <script type="text/javascript" src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>-->

<script type="text/javascript" src="js/jquery-fluid16.js"></script>
<script src="js/plugins.js"></script>
<script src="js/script.js"></script>
<!-- //xoxco tags plugin https://github.com/xoxco/jQuery-Tags-Input -->
<script src="js/jquery.tagsinput.min.js"></script>
<link rel="stylesheet" href="css/jquery.tagsinput.css">
<script src="../scripts/jqplot/jquery.jqplot.min.css" />
<script class="include" language="javascript" type="text/javascript" src="../scripts/jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
<script class="include" language="javascript" type="text/javascript" src="../scripts/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
</head>
<body>
<div id="rainchart" style="height:300px; width:500px;"></div>
<?php $result = pg_query($db, "SELECT observationdate, precipitation FROM rain ORDER BY observationdate");
if (!$result) {
	die("Error in SQL query: " . pg_last_error());
}
$results = array(array());
while ($row = pg_fetch_array($result)) {
	$results[] = $row;
}
//var_dump($results);
?>
<script type="text/javascript">
$(document).ready(function(){
var line1 = <?php echo json_encode($results); ?>;
var plot1b = $.jqplot('rainchart', [line1]);
});
  </script>         
</body>
</html>

<!-- http://stackoverflow.com/questions/14305420/how-to-plot-values-from-php-array-into-jqplot -->
