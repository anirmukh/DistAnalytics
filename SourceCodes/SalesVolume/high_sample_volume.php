<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
#container, #sliders {
    min-width: 310px; 
    max-width: 800px;
    margin: 0 auto;
}
#container {
    height: 400px; 
}
		</style>
		<script type="text/javascript">
$(function () {
    // Set up the chart
    var arr=name.split(',');
    var arr1=name2;

    var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 0,
                beta: 0,
                depth: 20,
                viewDistance: 25
            }
        },
        credits: {
            enabled: false
        },
        title: {
            text: 'Sales Volume'
        },
        plotOptions: {
            column: {
                depth: 25
            },
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function(event) {
                            //var rname=event.point.name;
                            //var temp=name2[rname];
                            var addr="../SalesVolume/region2_kpi.php?idno="+name3+"&idno1="+name4;
                            location.href = addr;
                        }
                    }
                }
            }
        },
         xAxis: {
           //var arr=["SIM KIT","SERVICE KIT","DATA KIT","DEVICE"];
           //alert("arr[0]");
            categories: arr
        },
        yAxis: {
            title: {
                text: "Volume"
            }
        },
        series: [{
            name: "Total Sales Volume",
            data: arr1
        }
        ]
    });

    function showValues() {
        $('#alpha-value').html(chart.options.chart.options3d.alpha);
        $('#beta-value').html(chart.options.chart.options3d.beta);
        $('#depth-value').html(chart.options.chart.options3d.depth);
    }

    // Activate the sliders
    $('#sliders input').on('input change', function () {
        chart.options.chart.options3d[this.id] = this.value;
        showValues();
        chart.redraw(false);
    });

    showValues();
});
		</script>
	</head>
	<body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<div id="container"></div>

	</body>
  
</html>