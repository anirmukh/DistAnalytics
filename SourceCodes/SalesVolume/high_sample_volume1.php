<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
#container1, #sliders {
    min-width: 310px; 
    max-width: 800px;
    margin: 0 auto;
}
#container1 {
    height: 400px; 
}
		</style>
		<script type="text/javascript">
$(function () {
    // Set up the chart
    var arrx=name1.split(',');
    var arrx1=name21;

    var chart   = new Highcharts.Chart({
        chart: {
            renderTo: 'container1',
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 0,
                beta: 0,
                depth: 20,
                viewDistance: 25
            }
        },
        title: {
            text: 'ITEM WISE SALES VOLUME'
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
                            var addr="../SalesVolume/region2_kpi.php?idno="+name31+"&idno1="+name41;
                            location.href = addr;
                        }
                    }
                }
            }
        },
         xAxis: {
           //var arr=["SIM KIT","SERVICE KIT","DATA KIT","DEVICE"];
           //alert("arr[0]");
            categories: arrx
        },
        series: [{
            name: "TOTAL SALES VOLUME",
            data: arrx1
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
<div id="container1"></div>

	</body>
  
</html>