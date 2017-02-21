<!DOCTYPE HTML>
<html>
	<head>
    <link href="../../Displayfiles/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
<div class="panel-heading">
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
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
        title: {
            text: 'SIM Activations - Area Wise'
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
                            var rname=event.point.category;
                           var addr="../SIM/sms_distributor_kpi.php?idno="+rname;
                            location.href = addr;
                        }
                    }
                }
            }
        },
         yAxis: {
            title: {
                text: "Activations"
            }
        },
         xAxis: {
            categories: d
        },
        series: [{
            name: "Total SIM Activations",
            data: ss3
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