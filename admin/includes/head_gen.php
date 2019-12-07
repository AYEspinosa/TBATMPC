
<!DOCTYPE html>
<html>
	<head>
		<title>TBATMPC - Admin</title>
		<link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
		
		<script src="js_req/jquery-1.10.2.min.js"></script>
		<link rel="stylesheet" href="../css/glyphicons.css" type="text/css">

		<!-- <link rel="stylesheet" href="css_req/bootstrap.min.css" /> -->

		<script src="js_req/jquery.dataTables.min.js"></script>
		<script src="js_req/dataTables.bootstrap.min.js"></script>		
		<link rel="stylesheet" href="css_req/dataTables.bootstrap.min.css" />
		<script src="../js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
		<link rel="stylesheet" href="../css/main.css" type="text/css">
		<!-- FOR GRAPH!!-->
		<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
		<script src="https://www.amcharts.com/lib/3/serial.js"></script>
		<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
		<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
		<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

        <?php
			$thisYr = date("Y");
			$lastYr = $thisYr - 1;
			$thisYrQ = $db->query("SELECT grand_amount, txn_date FROM transactions WHERE YEAR(txn_date) = '{$thisYr}'");
			$lastYrQ = $db->query("SELECT grand_amount, txn_date FROM transactions WHERE YEAR(txn_date) = '{$lastYr}'");
			$current = array();
			$last = array();
			$current_total = 0;
			$last_total = 0;
			while($x = mysqli_fetch_assoc($thisYrQ)){
				$month = date("m", strtotime($x['txn_date']));
				if (!array_key_exists($month,$current)) {
					$current[(int)$month] = $x['grand_amount'];
				}else{
					$current[(int)$month] += $x['grand_amount'];
				}
				$current_total += $x['grand_amount'];
			}

			while($y = mysqli_fetch_assoc($lastYrQ)){
				$month = date("m", strtotime($y['txn_date']));
				if (!array_key_exists($month,$last)) {
					$last[(int)$month] = $y['grand_amount'];
				}else{
					$last[(int)$month] += $y['grand_amount'];
				}
				$last_total += $y['grand_amount'];
			}
			$dataProvided = array();
			$colors = array("#FF0F00","#FF6600","#FF9E01","#FCD202","#F8FF01","#B0DE09","#04D215","#0D8ECF","#0D52D1","#2A0CD0","#8A0CCF","#CD0D74");
			for($i = 1; $i <= 12; $i++){
				$dt = DateTime::createFromFormat('!m',$i);
				$dataPerMon = array(
					"country"	=>	$dt->format("F"),
					"visits"	=>	((array_key_exists($i, $current))?$current[$i]:0),
					"color"		=>	$colors[$i-1],
				);
				$dataProvided[] = json_encode($dataPerMon);
			}
		?>
        <!-- Chart code -->
		<script>
			var dataArray = new Array();

			<?php foreach ($dataProvided as $data): ?>
				dataArray.push(JSON.parse('<?= $data; ?>'));
			<?php endforeach; ?>
			var chart = AmCharts.makeChart("chartdiv", {
			    "theme": "light",
			    "type": "serial",
			    "startDuration": 2,
			    "dataProvider": dataArray,
			    "valueAxes": [{
			        "position": "left",
			        "axisAlpha":0,
			        "gridAlpha":0
			    }],
			    "graphs": [{
			        "balloonText": "[[category]]: <b>[[value]]</b>",
			        "colorField": "color",
			        "fillAlphas": 0.85,
			        "lineAlpha": 0.1,
			        "type": "column",
			        "topRadius":1,
			        "valueField": "visits"
			    }],
			    "depth3D": 40,
				"angle": 30,
			    "chartCursor": {
			        "categoryBalloonEnabled": false,
			        "cursorAlpha": 0,
			        "zoomable": false
			    },
			    "categoryField": "country",
			    "categoryAxis": {
			        "gridPosition": "start",
			        "axisAlpha":0,
			        "gridAlpha":0

			    },
			    "export": {
			    	"enabled": true
			     }

			}, 0);
		</script>

        <style>
			#chartdiv {
			  width: 100%;
			  height: 500px;
			}													
		</style>
        
	</head>
	<body>