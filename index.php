<?php
require '../includes/mpp_dbconn.php';
?>
<!doctype html>
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
<!-- //jquery -->
<script src="../scripts/jquery-1.8.3.min.js"></script>
<!-- //jqueryUI -->
<script type="text/javascript" src="js/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript" src="js/jquery-fluid16.js"></script>
<script src="js/plugins.js"></script>
<script src="js/script.js"></script>
<!-- //xoxco tags plugin https://github.com/xoxco/jQuery-Tags-Input -->
<script src="js/jquery.tagsinput.min.js"></script>
<link rel="stylesheet" href="css/jquery.tagsinput.css">
<link rel="stylesheet" href="../scripts/jqplot/jquery.jqplot.min.css" />

<script class="include" type="text/javascript" src="../scripts/jqplot/jquery.jqplot.min.js"></script>
<script class="include" type="text/javascript" src="../scripts/jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
<script class="include" type="text/javascript" src="../scripts/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
<script class="include" type="text/javascript" src="../scripts/jqplot/plugins/jqplot.dateAxisRenderer.min.js"></script>

<!-- modernizr -->
<script src="js/libs/modernizr-1.7.min.js"></script>
<!-- superfish menu and needed js for menu -->
<script src="js/superfish.js"></script>
<script src="js/supersubs.js"></script>
<script src="js/hoverIntent.js"></script>
<!-- treeview -->
<script src="js/jquery.treeview.js"></script>
<!-- dataTable -->
<!--<script src="js/jquery.dataTables.min.js"></script>-->
<script type="text/javascript">
        $(function(){
        //treeview for inner menus
        $("#browser").treeview({
                toggle: function() {
                        console.log("%s was toggled.", $(this).find(">span").text());
                        }
                });
                        
        // menu superfish
        $('#navigationTop').superfish();
                
        // tags
        $("#tags_input").tagsInput();
                        
        // dataTable
        /*var uTable = $('#example').dataTable( {
                "sScrollY": 200,
                "bJQueryUI": true,
                "sPaginationType": "full_numbers"
        } );
        $(window).bind('resize', function () {
                uTable.fnAdjustColumnSizing();
        } );
        */                
        // Accordion
        $("#accordion").accordion({ header: "h3" });

        // Accordion2
        $("#accordion2").accordion({ header: "h3" });

        // Tabs
        $('#tabs').tabs();

        // Dialog                        
        $('#dialog').dialog({
                autoOpen: false,
                width: 600,
                buttons: {
                        "Ok": function() {
                        $(this).dialog("close");
                        },
                        "Cancel": function() {
                        $(this).dialog("close");
                        }
                }
        });
                        
        // Dialog Link
        $('#dialog_link').click(function(){
                $('#dialog').dialog('open');
                return false;
        });

        // Datepicker
        $('#datepicker').datepicker({
                inline: true
        });
                        
        // Slider
        $('#slider').slider({
                range: true,
                values: [17, 67]
        });
                        
        // Progressbar
        $("#progressbar").progressbar({
                value: 20
        });
                        
        //hover states on the static widgets
        $('#dialog_link, ul#icons li').hover(
                function() { $(this).addClass('ui-state-hover'); },
                function() { $(this).removeClass('ui-state-hover'); }
        );
                
});
</script>
</head>
<body>
<div class="container_16">
        <header>
        <div class="grid_16">
                <h1 id="branding">
                        <a href="#">Na Mea Mokupāpapa</a>
                </h1>
        </div>
        <div class="clear"></div>
        <div class="grid_16">
                <ul class="sf-menu" id="navigationTop">
                        <li class="selected">
                                <a href="index.php">Dashboard</a>
                        </li>
                        <li><a href="serverdoc.html">Documentation</a></li>
                </ul>
        </div>
        <div class="clear"></div>
        <div class="grid_16">
                <h2 id="page-heading">Server/Services Dashboard</h2>
        </div>
        <div class="clear"></div>
        </header>
        <div id="main" role="main">
                <div class="grid_4">
                        <div class="box">
                                <h2>Network Status</h2>
                                <div class="block">
<?php
$connected = fsockopen("www.google.com", 80);
    if ($connected){
?>
<p><strong>Maika`i!</strong><br />
Internet/network connection is up.
<img src="img/happy.png" width="30" height="30">
<?php
        fclose($connected);
    }else{
?>
<p><strong>Auwe!</strong><br />
Internet/network connection is down.
<img src="img/sad.png" width="30" height="30">
<?php
}

?>
        </p>
        </div>
        </div>
        </div>
        <div class="grid_4">
                <div class="box">
                        <h2>Database Status</h2>
                        <div class="block">
<?php
// execute query
$sql = "SELECT count(*) FROM rain";
$result = pg_query($db, $sql);
if ($result) {
?>
<p><strong>Maika`i!</strong><br />
Database is up.
<img src="img/happy.png" width="30" height="30">
<?php
} else {
?>
<p><strong>Auwe!</strong><br />
Database is down.
<img src="img/sad.png" width="30" height="30">
<?php
}
?>
</p>
                                        </div>
                                </div>
                        </div>
                        <div class="grid_4">
                                <div class="box">
                                        <h2>What to do if something is amiss</h2>
                                        <div class="block">
<p>Google is your friend when troubleshooting, use it before doing something foolish. This is a CentOS linux server running Apache and PHP for the webserver, and PostgreSQL as the database server. The weather data is collected through Python scripts run by cron. Be nice to the machine and the machine will be nice to you. You break it, you buy it.</p>
                                        </div>
                                </div>
                        </div>
                        <div class="grid_4">
                                <div class="box">
                                        <h2>Who you gonna call?</h2>
                                        <div class="block">
                        <p>The Ghostbusters who can try for help are Dave Graham, Nick Tenney and Jon Geyer. We'll do everything we can to help remotely.</p>
                                        </div>
                                </div>
                        </div>
                        <div class="clear"></div>

                        <div class="grid_16">
                                <!-- Accordion -->
                                <h2 class="demoHeaders">Hilo Bay Weather Observations</h2>
                                <div class="block" id="accordion2">
                                        <div id="accordion">
                                                <h3 class="toggler atStart">Rainfall</h3>
                                                <div class="element atStart">
                                                        <h4>Rainfall measurements are normally updated at 1 hour intervals.</h4>
                                                        <a href="#" onclick="window.open('details.php?id=rain','Rain Data','width=640,height=480');"><div id="rainchart" style="height:300px; width:500px;"></div></a>
                                                        <div><p>These data were last updated at <strong><i><label id="lblrain">Sometime</label></i></strong></div>
                                                </div>
                                                <h3 class="toggler atStart">River</h3>
                                                <div class="element atStart">
                                                        <h4>River measurements are normally updated at 1 hour intervals.</h4>
                                                        <a href="#" onclick="window.open('details.php?id=rflow','River Flow','width=640,height=480');">
<div id="riverchart" style="float:left;height:300px; width:500px;"></div></a>
<a href="#" onclick="window.open('details.php?id=rheight','River Flow','width=640,height=480');">
<div id="riverheight" style="float:right;height:300px; width:500px;"></div></a>
                                                        <div><p>These data were last updated at <strong><i><label id="lblriver">Sometime</label></i></strong></div>
                                                </div>
                                                <h3 class="toggler atStart">Salinity / Turbidity</h3>
                                                <div class="element atStart">
                                                        <h4>Salinity and Turbidity measurements are normally updated at 15 minute intervals but the data are only retrieved daily.</h4>
                                                        <a href="#" onclick="window.open('details.php?id=turbid','Turbidity','width=640,height=480');">
<div id="turbidchart" style="float:left;height:300px; width:500px;"></div></a>
<a href="#" onclick="window.open('details.php?id=salinity','Salinity','width=640,height=480');">
<div id="salinitychart" style="float:right;height:300px; width:500px;"></div></a>
                                                        <div><p>These data were last updated at <strong><i><label id="lblturbid">Sometime</label></i></strong></div>
                                                </div>
                                                <h3 class="toggler atStart">Waves</h3>
                                                <div class="element atStart">
                                                        <h4>Wave measurements are normally updated at 30 minute intervals.</h4>
                                                        <a href="#" onclick="window.open('details.php?id=waves','Wave Height','width=640,height=480');">
                                                        <div id="wavechart" style="float:left;height:300px;width:500px;"></div></a>
                                                        <a href="#" onclick="window.open('details.php?id=wavep','Wave Periods','width=640,height=480');">
                                                        <div id="periodchart" style="float:right;height:300px;width:500px;"></div></a>
                                                        <div><p>These data were last updated at <strong><i><label id="lblwave">Sometime</label></i></strong></div>
                                                </div>
                                                <h3 class="toggler atStart">Wind</h3>
                                                <div class="element atStart">
                                                        <h4>Wind measurements are normally updated at 6 minute intervals.</h4>
                                                        <a href="#" onclick="window.open('details.php?id=wind','Winds','width=640,height=480');">
                                                        <div id="windchart" style="float:left;height:300px;width:500px;"></div></a>
                                                        <div><p>These data were last updated at <strong><i><label id="lblwind">Sometime</label></i></strong></div>
                                                </div>
                                                <h3 class="toggler atStart">Satellite</h3>
                                                <div class="element atStart">
                                                        <h4>The satellite image is updated approximately 4 times a day.</h4>
                                                        
                                                        
                                                </div>
                                        </div>
                                </div>
                        
                                <!-- Tabs -->
                                <h2 class="demoHeaders">Troubleshooting</h2>
                                <div id="tabs">
                                        <ul>
                                                <li><a href="#tabs-1">Database</a></li>
                                                <li><a href="#tabs-2">Web Server</a></li>
                                                <li><a href="#tabs-3">Data Collection</a></li>
                                                <li><a href="#tabs-4">Network</a></li>
                                                <li><a href="#tabs-5">Last Resort</a></li>
                                        </ul>
<div id="tabs-1">If you think there is a problem with the database, first make sure its running.<br />
From the command line:<br />
<strong>ps -ef | grep post*</strong><br />
There should be multiple postgres processes running owned by postgres.<br />
To restart the database:<br />
<strong>/etc/init.d/postgresql restart</strong><br /><br />
The database logs are located here: <i>/var/lib/pgsql/9.3/data/pg_log</i>
</div>
                                        <div id="tabs-2">If you can see this page, that means the web server (Apache) and the application server (php) are running. To check configurations further, from the command line:<br />
<strong>netstat -l | grep http</strong><br /><br />
Which should produce something like this:<br />
tcp 0 0 *:http *:* LISTEN<br />
tcp 0 0 *:https *:* LISTEN<br /><br />

To restart the web server:<br />
<strong>/sbin/service httpd restart</strong><br /><br />

To check the php configuration, go <a href="../info.php" target="_new">here</a>.
</div>
                                        <div id="tabs-3">Scripts that collect the data for storage in the database and distribution to the kiosks are located in the /opt/datacollect directory. These are python scripts that connect to the internet, process the responses, and store the data in the database. </div>
                                        <div id="tabs-4">For network problems:<br />
<ul><li>Check the network devices the server plugs into, cables, etc.</li>
<li>Try to ping internal and external devices</li>
<li>Check iptables for proper configuration/functioning</li></ul>
To restart the server network:<br />
<strong>service network restart</strong><br /><br />
To check iptables:<br />
<strong>iptables -L -n -v</strong> </div>
                                        <div id="tabs-5">So, you've done everything you can think of, checked logs, and bounced services and still no love? You can try rebooting, though it probably won't help for more than a few minutes if you're having problems and you've tried everything else. To reboot, from the command line:<br /><br />
<strong>reboot now</strong><br><br>
After rebooting, check the services and logs again and see if anything complained on startup, that can help point you in the right direction for fixing chronic problems.
</div>
                                </div>
                        

                                <br/>
                                <div class="clear"></div>
                                </div>
                                
                        </div>

                <footer>
                        <div class="grid_16" id="site_info">
                                <div class="box">
                                        <p>html5Admin - <a href="http://www.html5admin.com">Your Free HTML5 ready backEnd</a></p>
                                </div>
                        </div>
                        <div class="clear"></div>
                </footer>
        </div>
<?php $result = pg_query($db, "SELECT observationdate, precipitation FROM rain WHERE observationdate >= current_date - interval '30 days' ORDER BY observationdate");
if (!$result) {
        die("Error in SQL query: " . pg_last_error());
}
$results = array(array());
while ($row = pg_fetch_array($result)) {
        $results[] = $row;
}

$riverflow = pg_query($db, "SELECT observationdate, flowrate FROM river WHERE observationdate >= current_date - interval '30 days' ORDER BY observationdate");
if (!$riverflow) {
        die("Error in SQL query: " . pg_last_error());
}
$rflowresults = array(array());
while ($row = pg_fetch_array($riverflow)) {
        $rflowresults[] = $row;
}

$riverheight = pg_query($db, "SELECT observationdate, height FROM river WHERE observationdate >= current_date - interval '30 days' ORDER BY observationdate");
if (!$riverheight) {
        die("Error in SQL query: " . pg_last_error());
}
$rheightresults = array(array());
while ($row = pg_fetch_array($riverheight)) {
        $rheightresults[] = $row;
}

$turbidity = pg_query($db, "SELECT observationdate, turbidity FROM turbidity WHERE observationdate >= current_date - interval '30 days' ORDER BY observationdate");
if(!$turbidity){
        die("Error in SQL query: " . pg_last_error());        
}
$turbidresults = array(array());
while($row = pg_fetch_array($turbidity)){
        $turbidresults[] = $row;
}

$salinity = pg_query($db, "SELECT observationdate, salinity FROM turbidity WHERE observationdate >= current_date - interval '30 days' ORDER BY observationdate");
if(!$salinity){
        die("Error in SQL query: " . pg_last_error());
}
$salinityresults = array(array());
while($row = pg_fetch_array($salinity)){
        $salinityresults[] = $row;
}

$waves = pg_query($db, "SELECT observationdate, height FROM waves WHERE observationdate >= current_date - interval '30 days' ORDER BY observationdate");
if(!$waves){
        die("Error in SQL query: " . pg_last_error());
}
$waveresults = array(array());
while($row = pg_fetch_array($waves)){
        $waveresults[] = $row;
}

$period = pg_query($db, "SELECT observationdate, period FROM waves WHERE observationdate >= current_date - interval '30 days' ORDER BY observationdate");
if(!$period){
        die("Error in SQL query: " . pg_last_error());
}
$periodresults = array(array());
while($row = pg_fetch_array($period)){
        $periodresults[] = $row;
}

$wind = pg_query($db, "SELECT observationdate, speed FROM wind WHERE observationdate >= current_date - interval '30 days' ORDER BY observationdate");
if(!$wind){
        die("Error in SQL query: " . pg_last_error());
}
$windresults = array(array());
while($row = pg_fetch_array($wind)){
        $windresults[] = $row;
}

$res = pg_query($db, "SELECT max(createdate) as thedate FROM wind;");
if(!$res){
        die("Error in SQL query: " . pg_last_error());
}
$wdate = pg_fetch_result($res, 0, 0);
pg_free_result($res);
$res = pg_query($db, "SELECT max(createdate) as thedate FROM waves;");
if(!$res){
        die("Error in SQL query: " . pg_last_error());
}
$wavedate = pg_fetch_result($res, 0, 0);
pg_free_result($res);
$res = pg_query($db, "SELECT max(createdate) as thedate FROM river;");
if(!$res){
        die("Error in SQL query: " . pg_last_error());
}
$riverdate = pg_fetch_result($res, 0, 0);
pg_free_result($res);
$res = pg_query($db, "SELECT max(createdate) as thedate FROM rain;");
if(!$res){
        die("Error in SQL query: " . pg_last_error());
}
$raindate = pg_fetch_result($res, 0, 0);
pg_free_result($res);
$res = pg_query($db, "SELECT max(createdate) as thedate FROM turbidity;");
if(!$res){
        die("Error in SQL query: " . pg_last_error());
}
$tdate = pg_fetch_result($res, 0, 0);
pg_free_result($res);
?>
<script type="text/javascript">
$(document).ready(function(){

document.getElementById("lblwind").textContent = "<?php echo $wdate; ?>";
document.getElementById("lblwave").textContent = "<?php echo $wavedate; ?>";
document.getElementById("lblriver").textContent = "<?php echo $riverdate; ?>";
document.getElementById("lblturbid").textContent = "<?php echo $tdate; ?>";
document.getElementById("lblrain").textContent = "<?php echo $raindate; ?>";

var line1 = new Array();
<?php for ($i=1; $i<count($results); $i++) { ?>
line1[<?php echo $i-1; ?>] = ['<?php echo $results[$i][0]; ?>', <?php echo $results[$i][1]; ?>];
<?php } ?>

var plot2 = $.jqplot('rainchart', [line1], {
title:'Hourly Rainfall - last 30 days',
axesDefaults: {labelRenderer: $.jqplot.CanvasAxisLabelRenderer},
axes:{
xaxis:{
renderer:$.jqplot.DateAxisRenderer,
tickOptions:{formatString:'%b %#d, %#I %p'},
numberTicks: 7
},
yaxis: {label: "Precipitation (cm)"}
},
seriesDefaults:{showMarker:false, shadow:false}
});

//river flow
var rf = new Array();
<?php for ($i=1; $i<count($rflowresults); $i++) { ?>
rf[<?php echo $i-1; ?>] = ['<?php echo $rflowresults[$i][0]; ?>', <?php echo $rflowresults[$i][1]; ?>];
<?php } ?>
var river1 = $.jqplot('riverchart', [rf], {
title:'River Flow - last 30 days',
axesDefaults: {labelRenderer: $.jqplot.CanvasAxisLabelRenderer},
axes:{
xaxis:{
renderer:$.jqplot.DateAxisRenderer,
tickOptions:{formatString:'%b %#d, %#I %p'},
numberTicks: 7
},
yaxis: {label: "Feet^3/second"}
},
seriesDefaults:{showMarker:false, shadow:false}
});

//river height
var rh = new Array();
<?php for ($i=1; $i<count($rheightresults); $i++) { ?>
rh[<?php echo $i-1; ?>] = ['<?php echo $rheightresults[$i][0]; ?>', <?php echo $rheightresults[$i][1]; ?>];
<?php } ?>
var river2 = $.jqplot('riverheight', [rh], {
title:'River Height - last 30 days',
axesDefaults: {labelRenderer: $.jqplot.CanvasAxisLabelRenderer},
axes:{
xaxis:{
renderer:$.jqplot.DateAxisRenderer,
tickOptions:{formatString:'%b %#d, %#I %p'},
numberTicks: 7
},
yaxis: {label: "Feet"}
},
seriesDefaults:{showMarker:false, shadow:false}
});

//turbidity
var tb = new Array();
<?php for ($i=1; $i<count($turbidresults); $i++) { ?>
tb[<?php echo $i-1; ?>] = ['<?php echo $turbidresults[$i][0]; ?>', <?php echo $turbidresults[$i][1]; ?>];
<?php } ?>
var turbidity = $.jqplot('turbidchart', [tb], {
title:'Turbidity - last 30 days',
axesDefaults: {labelRenderer: $.jqplot.CanvasAxisLabelRenderer},
axes:{
xaxis:{
renderer:$.jqplot.DateAxisRenderer,
tickOptions:{formatString:'%b %#d, %#I %p'},
numberTicks: 7
},
yaxis: {label: "NTU"}
},
seriesDefaults:{showMarker:false, shadow:false}
});

//salinity
var sl = new Array();
<?php for ($i=1; $i<count($salinityresults); $i++) { ?>
sl[<?php echo $i-1; ?>] = ['<?php echo $salinityresults[$i][0]; ?>', <?php echo $salinityresults[$i][1]; ?>];
<?php } ?>
var salinity = $.jqplot('salinitychart', [sl], {
title:'Salinity - last 30 days',
axesDefaults: {labelRenderer: $.jqplot.CanvasAxisLabelRenderer},
axes:{
xaxis:{
renderer:$.jqplot.DateAxisRenderer,
tickOptions:{formatString:'%b %#d, %#I %p'},
numberTicks: 7
},
yaxis: {label: "PSU"}
},
seriesDefaults:{showMarker:false, shadow:false}
});

//waves
var wv = new Array();
<?php for ($i=1; $i<count($waveresults); $i++) { ?>
wv[<?php echo $i-1; ?>] = ['<?php echo $waveresults[$i][0]; ?>', <?php echo $waveresults[$i][1]; ?>];
<?php } ?>
var wave = $.jqplot('wavechart', [wv], {
title:'Wave Heights - last 30 days',
axesDefaults: {labelRenderer: $.jqplot.CanvasAxisLabelRenderer},
axes:{
xaxis:{
renderer:$.jqplot.DateAxisRenderer,
tickOptions:{formatString:'%b %#d, %#I %p'},
numberTicks: 7
},
yaxis: {label: "Meters"}
},
seriesDefaults:{showMarker:false, shadow:false}
});

//wave period
var wp = new Array();
<?php for ($i=1; $i<count($periodresults); $i++) { ?>
wp[<?php echo $i-1; ?>] = ['<?php echo $periodresults[$i][0]; ?>', <?php echo $periodresults[$i][1]; ?>];
<?php } ?>
var period = $.jqplot('periodchart', [wp], {
title:'Wave Periods - last 30 days',
axesDefaults: {labelRenderer: $.jqplot.CanvasAxisLabelRenderer},
axes:{
xaxis:{
renderer:$.jqplot.DateAxisRenderer,
tickOptions:{formatString:'%b %#d, %#I %p'},
numberTicks: 7
},
yaxis: {label: "Second"}
},
seriesDefaults:{showMarker:false, shadow:false}
});

//wind
var windspd = new Array();
<?php for ($i=1; $i<count($windresults); $i++) { ?>
windspd[<?php echo $i-1; ?>] = ['<?php echo $windresults[$i][0]; ?>', <?php echo $windresults[$i][1]; ?>];
<?php } ?>
var wind = $.jqplot('windchart', [windspd], {
title:'Wind Speed - last 30 days',
axesDefaults: {labelRenderer: $.jqplot.CanvasAxisLabelRenderer},
axes:{
xaxis:{
renderer:$.jqplot.DateAxisRenderer,
tickOptions:{formatString:'%b %#d, %#I %p'},
numberTicks: 7
},
yaxis: {label: "MPH"}
},
seriesDefaults:{showMarker:false, shadow:false}
});

$('#accordion2').bind('accordionchange', function(event, ui) {
var index = $(this).find("h3").index ( ui.newHeader[0] );
if (index === 1) {
        river1.replot();
        river2.replot();
} else if(index === 2){
                turbidity.replot();
                salinity.replot();
} else if (index === 3){
                wave.replot();
                period.replot();
} else if (index === 4){
                wind.replot();
}
});
});
</script>
</body>
</html>
