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
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {

    var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            type: 'column'
        },
        title: {
            text: 'Customer Experience - Region Wise Average'
        },
        xAxis: {
            categories: regname,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Average'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} units</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }},
        series: [{
            name: 'Target',
            data: regtar

        }, {
            color: '#ff99c2',
            name: 'Recommendations',
            data: regrec

        }]
    });
});
		</script>
	</head>
	<body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>