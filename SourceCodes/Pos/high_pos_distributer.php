
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
${demo.css}
		</style>
		<script type="text/javascript">
        
        
$(function () {

    var name = Array();
var data = Array();
var dataArrayFinal = Array();
for(i=0;i<d.length;i++) { 
   name[i] = d[i].DISTRIBUTOR_NAME; 
   data[i] = d[i].COUNT;  
}

for(j=0;j<name.length;j++) { 
   var temp = new Array(name[j],data[j]); 
   dataArrayFinal[j] = temp;     
}
var chart = new Highcharts.Chart({
        chart: {
            type: 'pie',
            renderTo: 'container',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'POS Count- Distributor Wise'
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
                        }
                    }
                }
            }
        },
          credits: {
            enabled: false
        },
        series: [{
            type: 'pie',
            name: 'AREA_POS',
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
<link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
<div class="panel-heading">
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table id='datatable' width="100%" class="table table-striped table-bordered table-hover" >
<div id="container" style="height: 400px"></div>
	</body>
</html>