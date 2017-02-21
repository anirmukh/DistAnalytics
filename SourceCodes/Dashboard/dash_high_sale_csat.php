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
        <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script type="text/javascript">
$(function () {
    var chart_csat = new Highcharts.Chart({

        chart: {
            renderTo: 'container_csat',
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false,
            events:{
                click:function(){
                addr="../Cex/cex_reg_kpi.php?idno="+dash4csat+"&idno1="+dash3csat;
                location.href=addr;
                }
            }
        },
        credits: {
            enabled: false
        },
        title: {
            text: 'CEX'
        },

        pane: {
            startAngle: -90,
            endAngle: 90,
            background: [{
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#FFF'],
                        [1, '#333']
                    ]
                },
                borderWidth: 0,
                outerRadius: '109%'
            }, {
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#333'],
                        [1, '#FFF']
                    ]
                },
                borderWidth: 1,
                outerRadius: '107%'
            }, {
                // default background
            }, {
                backgroundColor: '#DDD',
                borderWidth: 0,
                outerRadius: '105%',
                innerRadius: '103%'
            }]
        },

        // the value axis
        yAxis: {
            min: 0,
            max: 200,

            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside',
            minorTickColor: '#666',

            tickPixelInterval: 30,
            tickWidth: 2,
            tickPosition: 'inside',
            tickLength: 10,
            tickColor: '#666',
            labels: {
                step: 2,
                rotation: 'auto'
            },
            title: {
                text: 'Units'
            },
            plotBands: [{
                from: 0,
                to: 120,
                color: '#55BF3B' // green
            }, {
                from: 120,
                to: 160,
                color: '#DDDF0D' // yellow
            }, {
                from: 160,
                to: 200,
                color: '#DF5353' // red
            }]
        },

        series: [
        {name: 'Recommendation',
            data: [dash5csat],
            tooltip: {
                valueSuffix: ' Units'
            }
        },{
            
            name: 'Target',
            data: [dash2csat],
            tooltip: {
                valueSuffix: ' Units'
            }
        }
        ]

    }
    );
    

    showValues();
});
		</script>
	</head>
	<body>

</body>
<div id="container_csat"></div>
</html>