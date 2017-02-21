<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
#container_pos, #sliders {
    min-width: 310px; 
    max-width: 800px;
    margin: 0 auto;
}
#container_pos {
    height: 400px; 
}
		</style>
		<script type="text/javascript">
$(function () {
    // Set up the chart
    var dashnewpos="";
    for (var t in dashpos) 
    {
        if(dashpos[t])
            dashnewpos+=dashpos[t]+",";
    }
    dashnewpos=JSON.stringify(dashnewpos);
    dashnewpos=dashnewpos.substr(1, dashnewpos.length-2);
    var arrpos=dashnewpos.split(',');
    var arr1pos=dash2pos;

    var chart_pos = new Highcharts.Chart({
        chart: {
            renderTo: 'container_pos',
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
            text: 'POS'
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
                            var addr="../Pos/region_pos_kpi.php?idno="+dash3pos+"&idno1="+dash4pos;
                            location.href = addr;
                        }
                    }
                }
            }
        },
         xAxis: {
           //var arr=["SIM KIT","SERVICE KIT","DATA KIT","DEVICE"];
           //alert("arr[0]");
            categories: arrpos
        },
        yAxis: {
            title: {
                text: "Units"
            }
        },
        series: [{
            name: "Total POS",
            data: arr1pos
        }
        ]
    });

    function showValues() {
        $('#alpha-value').html(chart_pos.options.chart.options3d.alpha);
        $('#beta-value').html(chart_pos.options.chart.options3d.beta);
        $('#depth-value').html(chart_pos.options.chart.options3d.depth);
    }

    // Activate the sliders
    $('#sliders input').on('input change', function () {
        chart_pos.options.chart.options3d[this.id] = this.value;
        showValues();
        chart_pos.redraw(false);
    });

    showValues();
});
		</script>
	</head>
	<body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<div id="container_pos"></div>

	</body>
  
</html>