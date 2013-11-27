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
<!--[if lt IE 8 ]>
<link rel="stylesheet" type="text/css" href="css/fluid.gs.lt_ie8.css" media="screen" />
<![endif]-->
<!-- //jqueryUI css -->
<link type="text/css" href="css/custom-theme/jquery-ui-1.8.13.custom.css" rel="stylesheet" />
<!-- //jquery -->
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script> -->
<!-- <script src="js/libs/jquery-1.5.1.min.js"></script>-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<!--  <script>!window.jQuery && document.write(unescape('%3Cscript src="js/libs/jquery-1.5.1.min.js"%3E%3C/script%3E'))</script>-->
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
<script src="js/jquery.dataTables.min.js"></script>
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
	var uTable = $('#example').dataTable( {
		"sScrollY": 200,
		"bJQueryUI": true,
		"sPaginationType": "full_numbers"
	} );
	$(window).bind('resize', function () {
		uTable.fnAdjustColumnSizing();
	} );
			
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
				<a href="index.html">Dashboard</a>
			<ul>
			  <li><a href="#">Nothing to see here</a></li>
			  <li>
				<a href="#">Layouts</a>
				<ul>
				  <li><a href="userAdmin.html">Fake user page</a></li>
				  <li><a href="largeLayout.html">Large graphical layout</a></li>
				  <li><a href="messagesLayout.html">Messages afer a form</a></li>
				  <li><a href="#">Superfish</a>
				  <ul>
					<li><a href="userAdmin.html">is</a>
					<ul>
					  <li><a href="#">A multilevel</a></li>
					  <li><a href="#">Menu</a></li>
					</ul>
					</li>
				  </ul>
			  </li>
			</ul>
			</li>
			</ul>
			</li>
			<li><a href="#">Another Nothing voice</a></li>
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
<ol>
<li>Check the server log files (they're located below) to see if they tell you anything important. Everything you need to know should be here and should tell you what's up.</li>
<li>For database problems, make sure the database is running (e.g. 'ps -ef | grep post*'). If not, try to restart it.</li>
<li>For network problems, check the network devices the server plugs into, restart the server network (e.g. 'service network restart'), cables, etc.</li>
<li>As a last resort, restart the server, (e.g. 'reboot now').</li>
</ol>						
<p>Google is your friend when troubleshooting, use it before doing something foolish. This is a CentOS linux server running Apache as a webserver, php, and PostgreSQL as the database server. The weather data is collected through Python scripts run by cron. Be nice to the machine and the machine will be nice to you. You break it, you buy it.</p>
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
							<div id="rainchart" style="height:300px; width:500px;"></div>
							
						</div>
						<h3 class="toggler atStart">River</h3>
						<div class="element atStart">
							<h4>River measurements are normally updated at 1 hour intervals.</h4>
							<div id="riverchart" style="float:left;height:300px; width:500px;"></div>
							<div id="riverheight" style="float:right;height:300px; width:500px;"></div>
						</div>
						<h3 class="toggler atStart">Salinity / Turbidity</h3>
						<div class="element atStart">
							<h4>Salinity and Turbidity measurements are normally updated at 15 minute intervals but the data are only retrieved daily.</h4>
							<div id="turbidchart" style="float:left;height:300px; width:500px;"></div>
							<div id="salinitychart" style="float:right;height:300px; width:500px;"></div>
						</div>
						<h3 class="toggler atStart">Waves</h3>
						<div class="element atStart">
							<h4>Wave measurements are normally updated at 30 minute intervals.</h4>
							<div id="wavechart" style="float:left;height:300px;width:500px;"></div>
							<div id="periodchart" style="float:right;height:300px;width:500px;"></div>
						</div>
						<h3 class="toggler atStart">Wind</h3>
						<div class="element atStart">
							<h4>Wind measurements are normally updated at 6 minute intervals.</h4>
							<div id="windchart" style="float:left;height:300px;width:500px;"></div>
						</div>
					</div>
				</div>
			
				<!-- Tabs -->
				<h2 class="demoHeaders">Tabs</h2>
				<div id="tabs">
					<ul>
						<li><a href="#tabs-1">First</a></li>
						<li><a href="#tabs-2">Second</a></li>
						<li><a href="#tabs-3">Third</a></li>
					</ul>
					<div id="tabs-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
					<div id="tabs-2">Phasellus mattis tincidunt nibh. Cras orci urna, blandit id, pretium vel, aliquet ornare, felis. Maecenas scelerisque sem non nisl. Fusce sed lorem in enim dictum bibendum.</div>
					<div id="tabs-3">Nam dui erat, auctor a, dignissim quis, sollicitudin eu, felis. Pellentesque nisi urna, interdum eget, sagittis et, consequat vestibulum, lacus. Mauris porttitor ullamcorper augue.</div>
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
?>
<script type="text/javascript">
$(document).ready(function(){
var line1 = new Array();

<? for ($i=1; $i<count($results); $i++) { ?>
line1[<?=$i-1?>] = ['<?=$results[$i][0]?>', <?=$results[$i][1]?>];
<? } ?>

var plot2 = $.jqplot('rainchart', [line1], {
    title:'Hourly Rainfall - last 30 days', 
    axesDefaults: {
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer
      },
    axes:{
      xaxis:{
        renderer:$.jqplot.DateAxisRenderer, 
        tickOptions:{formatString:'%b %#d, %#I %p'},
        //min:'June 16, 2008 8:00AM', 
        //tickInterval:'1 day',
        numberTicks: 7,
        tickOptions: {
            angle: -30
        }
      },
      yaxis: {
          label: "Precipitation (cm)"
        }
    }
      ,
    seriesDefaults:{showMarker:false, shadow:false}
});

//river flow
var rf = new Array();
<? for ($i=1; $i<count($rflowresults); $i++) { ?>
rf[<?=$i-1?>] = ['<?=$rflowresults[$i][0]?>', <?=$rflowresults[$i][1]?>];
<? } ?>
var river1 = $.jqplot('riverchart', [rf], {
    title:'River Flow - last 30 days', 
    axesDefaults: {
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer
      },
    axes:{
      xaxis:{
        renderer:$.jqplot.DateAxisRenderer, 
        tickOptions:{formatString:'%b %#d, %#I %p'},
        numberTicks: 7,
        tickOptions: {
            angle: -30
        }
      },
      yaxis: {
          label: "Feet^3/second"
        }
    }
      ,
    seriesDefaults:{showMarker:false, shadow:false}
});

//river height
var rh = new Array();
<? for ($i=1; $i<count($rheightresults); $i++) { ?>
rh[<?=$i-1?>] = ['<?=$rheightresults[$i][0]?>', <?=$rheightresults[$i][1]?>];
<? } ?>
var river2 = $.jqplot('riverheight', [rh], {
    title:'River Height - last 30 days', 
    axesDefaults: {
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer
      },
    axes:{
      xaxis:{
        renderer:$.jqplot.DateAxisRenderer, 
        tickOptions:{formatString:'%b %#d, %#I %p'},
        numberTicks: 7,
        tickOptions: {
            angle: -30
        }
      },
      yaxis: {
          label: "Feet"
        }
    }
      ,
    seriesDefaults:{showMarker:false, shadow:false}
});

//turbidity
var tb = new Array();
<? for ($i=1; $i<count($turbidresults); $i++) { ?>
tb[<?=$i-1?>] = ['<?=$turbidresults[$i][0]?>', <?=$turbidresults[$i][1]?>];
<? } ?>
var turbidity = $.jqplot('turbidchart', [tb], {
    title:'Turbidity - last 30 days', 
    axesDefaults: {
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer
      },
    axes:{
      xaxis:{
        renderer:$.jqplot.DateAxisRenderer, 
        tickOptions:{formatString:'%b %#d, %#I %p'},
        numberTicks: 7,
        tickOptions: {
            angle: -30
        }
      },
      yaxis: {
          label: "NTU"
        }
    }
      ,
    seriesDefaults:{showMarker:false, shadow:false}
});

//salinity
var sl = new Array();
<? for ($i=1; $i<count($salinityresults); $i++) { ?>
sl[<?=$i-1?>] = ['<?=$salinityresults[$i][0]?>', <?=$salinityresults[$i][1]?>];
<? } ?>
var salinity = $.jqplot('salinitychart', [sl], {
    title:'Salinity - last 30 days', 
    axesDefaults: {
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer
      },
    axes:{
      xaxis:{
        renderer:$.jqplot.DateAxisRenderer, 
        tickOptions:{formatString:'%b %#d, %#I %p'},
        numberTicks: 7,
        tickOptions: {
            angle: -30
        }
      },
      yaxis: {
          label: "PSU"
        }
    }
      ,
    seriesDefaults:{showMarker:false, shadow:false}
});

//waves
var wv = new Array();
<? for ($i=1; $i<count($waveresults); $i++) { ?>
wv[<?=$i-1?>] = ['<?=$waveresults[$i][0]?>', <?=$waveresults[$i][1]?>];
<? } ?>
var wave = $.jqplot('wavechart', [wv], {
    title:'Wave Heights - last 30 days', 
    axesDefaults: {
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer
      },
    axes:{
      xaxis:{
        renderer:$.jqplot.DateAxisRenderer, 
        tickOptions:{formatString:'%b %#d, %#I %p'},
        numberTicks: 7,
        tickOptions: {
            angle: -30
        }
      },
      yaxis: {
          label: "Meters"
        }
    }
      ,
    seriesDefaults:{showMarker:false, shadow:false}
});

//wave period
var wp = new Array();
<? for ($i=1; $i<count($periodresults); $i++) { ?>
wp[<?=$i-1?>] = ['<?=$periodresults[$i][0]?>', <?=$periodresults[$i][1]?>];
<? } ?>
var period = $.jqplot('periodchart', [wp], {
    title:'Wave Periods - last 30 days', 
    axesDefaults: {
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer
      },
    axes:{
      xaxis:{
        renderer:$.jqplot.DateAxisRenderer, 
        tickOptions:{formatString:'%b %#d, %#I %p'},
        numberTicks: 7,
        tickOptions: {
            angle: -30
        }
      },
      yaxis: {
          label: "Second"
        }
    }
      ,
    seriesDefaults:{showMarker:false, shadow:false}
});

//wind
var windspd = new Array();
<? for ($i=1; $i<count($windresults); $i++) { ?>
windspd[<?=$i-1?>] = ['<?=$windresults[$i][0]?>', <?=$windresults[$i][1]?>];
<? } ?>
var wind = $.jqplot('windchart', [windspd], {
    title:'Wind Speed - last 30 days', 
    axesDefaults: {
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer
      },
    axes:{
      xaxis:{
        renderer:$.jqplot.DateAxisRenderer, 
        tickOptions:{formatString:'%b %#d, %#I %p'},
        numberTicks: 7,
        tickOptions: {
            angle: -30
        }
      },
      yaxis: {
          label: "MPH"
        }
    }
      ,
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
