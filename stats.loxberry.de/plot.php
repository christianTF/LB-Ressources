<?php

  # MySQL Connection
	$servername = "wp365.webpack.hosteurope.de";
	$username = "db11022769-lbsta";
	$password = "V5kEmzK34GRgPrjm";
	$dbname = "db11022769-loxberrystats";
	$tablename = "lbusage";

	$sql = "SELECT `Week`, `version`, count(*) as `clients` FROM ("
		. "SELECT `uid`, DATE_FORMAT(DATE_ADD(`currtime`, INTERVAL(1-DAYOFWEEK(`currtime`)) DAY),\'%Y-%m-%d\') AS \'Week\', concat(`ver_major`, \'.\', `ver_minor`, \'.\', `ver_sub`) `version` from `lbusage` GROUP BY `version`, `uid`) v "
		. "GROUP BY `Week`, `version` ORDER BY `Week`, `version`";

	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    echo ("Connection failed: " . $conn->connect_error);
	} else {
		$sth = mysqli_query($conn, $sql);
		mysqli_fetch_all ( $res, MYSQLI_ASSOC);
		# Reorder resultset to get dates and values per version
		foreach ($res as $row) {
			$vd[$row['version']]['week'] = $row['week'];
			$vd[$row['version']]['clients'] = $row['clients'];
		}
		mysqli_free_result($res);
		# Create JavaScript data lines
		// $plotline = 0;
		// foreach ($vd as $versdata) {
			// $plotline++;
			// $plot[$plotline] 
		// }
	}


?>


<HTML>
<head>
<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="excanvas.js"></script><![endif]-->
<script language="javascript" type="text/javascript" src="jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="jquery.jqplot.min.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.jqplot.css" />

</head>
<!-- Prepare data on the server side (not AJAX) -->
<body>

	<div id="chartdiv" style="height:400px;width:300px;"></div>
	
	
<script>
$(document).ready(function(){
  var line1=[['2008-08-12 4:00PM',4], ['2008-09-12 4:00PM',6.5], ['2008-10-12 4:00PM',5.7], ['2008-11-12 4:00PM',9], ['2008-12-12 4:00PM',8.2]];
  var plot1 = $.jqplot('chart1', [line1], {
    title:'Default Date Axis',
    axes:{
        xaxis:{
            renderer:$.jqplot.DateAxisRenderer
        }
    },
    series:[{lineWidth:4, markerOptions:{style:'square'}}]
  });
});
	
	
</script>
</body>
</HTML>