<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
#container_count, #sliders {
    min-width: 310px; 
    max-width: 800px;
    margin: 0 auto;
}
#container_count {
    height: 400px; 
}
		</style>
		<script type="text/javascript">
$(function () {
    // Set up the chart
    var dashnewct="";
    for (var t in namect[0]) 
    {
        if(namect[t])
            dashnewct+=namect[t]+",";
    }
    dashnewct=JSON.stringify(dashnewct);
    dashnewct=dashnewct.substr(1, dashnewct.length-2);
    var arrct=dashnewct.split(',');
    var arr1ct=name2ct;

    var chart_count = new Highcharts.Chart({
        chart: {
            renderTo: 'container_count',
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
            text: 'Sales Count'
        },
        credits: {
            enabled: false
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
                            var addr="../SalesCount/region_count_kpi.php?idno="+name3ct+"&idno1="+name4ct;
                            location.href = addr;
                        }
                    }
                }
            }
        },
         xAxis: {
           //var arr=["SIM KIT","SERVICE KIT","DATA KIT","DEVICE"];
           //alert("arr[0]");
            categories: arrct
        },
        yAxis: {
            title: {
                text: "Units"
            }
        },
        series: [{
            name: "Total Sales Count",
            data: arr1ct
        }
        ]
    });

    function showValues() {
        $('#alpha-value').html(chart_count.options.chart.options3d.alpha);
        $('#beta-value').html(chart_count.options.chart.options3d.beta);
        $('#depth-value').html(chart_count.options.chart.options3d.depth);
    }

    // Activate the sliders
    $('#sliders input').on('input change', function () {
        chart_count.options.chart.options3d[this.id] = this.value;
        showValues();
        chart_count.redraw(false);
    });

    showValues();
});
		</script>
	</head>
	<body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<div id="container_count"></div>

	</body>
  
</html>