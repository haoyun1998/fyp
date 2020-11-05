<?php
session_start();
error_reporting(0);

include("../includes/config.php");
include("../function/script_user_login.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.5.0-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/user_login.css">
	<link rel="stylesheet" type="text/css" href="../css/product_trend.css">
</head>
<body>
	<?php
	include("../includes/top_bar.php")
	?>

	<div class="contact">
		<div id="piechart" style="width: 1400px; height: 500px; padding: 0 20%;"></div>
  </div>

	<?php
	include("../includes/footer.php")
	?>

</body>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Phone',     11],
          ['Charger',      2],
          ['Earphone',  2],
          ['Others', 2]
        ]);

        var options = {
          title: 'Phone Accessories Product Trend'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
</html>