<html>
<head>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
    <script type="text/javascript" src="http://www.pittss.lv/jquery/gomap/js/jquery.gomap-1.3.1.min.js"></script>
    <script type="text/javascript" src="js/highcharts.js"></script>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>NoSQL</title>
    <style type="text/css">
        html{
            font: normal 15px Tahoma;
        }
        body {
            margin: 50px;
        }
    </style>
</head>
<body>
<?php

require_once "paczka/lib/couch.php";
require_once "paczka/lib/couchClient.php";
require_once "paczka/lib/couchDocument.php";

require_once "skrypt.php";

error_reporting(E_ALL);

?>
    Liczba e-maili w domenie Hotmail.com: <b><?php echo $view->total_rows; ?></b>
    <h2>Miasta i kraje pochodzenia użytkowników e-maili:</h2>

<div id="map" style="width: 850px; height: 600px;"></div>
<div id="container" style="width: 800px; height: 400px;"></div>

<script type="text/javascript">
$(function() {
    $("#map").goMap({
        address: 'Libya',
        markers: [
            <?php foreach ($znacznik as $zn):
                echo $zn;
             endforeach; ?>
        ],
        zoom: 2,
        maptype: 'TERRAIN'
    });

});

var chart;
$(document).ready(function() {
        chart = new Highcharts.Chart({
                chart: {
                        renderTo: 'container',
                        defaultSeriesType: 'column',
                        margin: [ 50, 50, 100, 80]
                },
                title: {
                        text: 'Liczba studentów z danego kraju'
                },
                xAxis: {
                        categories: [
                                <?php echo $wykres['kraje']; ?>
                        ],
                        labels: {
                                rotation: -45,
                                align: 'right',
                                style: {
                                         font: 'normal 13px Verdana, sans-serif'
                                }
                        }
                },
                yAxis: {
                        min: 0,
                        title: {
                                text: 'Liczba studentów'
                        }
                },
                legend: {
                        enabled: false
                },
                tooltip: {
						formatter: function() {
							return '<b>'+ this.x +'</b><br/>'+
								 'Liczba studentów: '+ Highcharts.numberFormat(this.y, 1) +
								 ' ';
						}
					},
                series: [{
                        name: 'Population',
                        data: [<?php echo $wykres['count']; ?>],
                        dataLabels: {
                                enabled: true,
                                rotation: -90,
                                color: '#FFFFFF',
                                align: 'right',
                                x: -3,
                                y: 2,
                                formatter: function() {
                                        return this.y;
                                },
                                style: {
                                        font: 'normal 13px Verdana, sans-serif'
                                }
                        }
                }]
        });


});
</script>
</body>
</html>
