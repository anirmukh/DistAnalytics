<!DOCTYPE HTML>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Highcharts Example</title>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
    #container_vol, #sliders {
    min-width: 310px; 
    max-width: 800px;
    margin: 0 auto;
}
#container_vol {
    height: 400px; 
}
${demo.css}
		</style>
		<script type="text/javascript">
        
        
$(function () {
    var name = Array();
var data = Array();
var dataArrayFinal = Array();
for(i=0;i<d.length;i++) { 
   name[i] = d[i].REGION; 
   data[i] = d[i].COUNT;  
}
for(j=0;j<name.length;j++) { 
   var temp = new Array(name[j],data[j]); 
   dataArrayFinal[j] = temp;     
}
var chart_vol = new Highcharts.Chart({
        chart: {
            renderTo: 'container_vol',
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        credits: {
            enabled: false
        },
        title: {
            text: 'Sales Volume - Region wise'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            },
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function(event) {
                            var reg_name=event.point.name;
                            var addr="../SalesVolume/vol_district_kpi.php?idno="+reg_name+"&idno1="+ss3;
                            location.href = addr;
                        }
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'REGION_VOLUME',
            data: dataArrayFinal
        }]
    });
});
		</script>
	</head>
	<body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<div id="container_vol" style="height: 400px"></div>
	</body>
</html>