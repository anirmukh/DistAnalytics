<html>
<head>
<script src="../../Displayfiles/angular.js"></script>
</head>
<body ng-app="mymodule">
  <link href="../../Displayfiles/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
<div class="panel-heading">
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table  ng-controller="mycontroller" width="100%" class="table table-bordered" id="dataTables-example">
<style>
           .color0 {
        background-color: #e6ffff;
    }

    .color1 {
        background-color: #f2e6ff;
    }

    .color2 {
        background-color: #ffffcc;
    }
</style>
<tr>
	<th colspan='3'>
		Select column to sort : by default it is asending : 
		<select ng-model='header'>
		<option value='region'>Region</option>
		<option value='SIM_KIT'>Sim Kit</option>
		<option value='DATA_CARD'>Data Card</option>
		<option value='SERVICE_KIT'>Service Kit</option>
        <option value='HANDSET'>Handset</option>
		<select>
	</th>
	<th colspan='2'>
		Select asending/decending : 
		<input type='button' value='{{buttonname}}' ng-click='sort()'/>
	</th>
</tr>
<tr>
<th colspan='5' align='left'>
Search Data : <input type='text' ng-model='searchdata.region' placeholder='Search Data'/>
</th>
</tr>
<tr>
<th>Region</th>
<th><a href='../SalesVolume/vol_region_kpi.php?idno=SIM%20KIT&idno2=style=text-decoration:none;'><font color=000000>Sim Kit</a></th>
<th><a href='../SalesVolume/vol_region_kpi.php?idno=DATA%20CARD&idno2=style=text-decoration:none;'><font color=000000>Data Card</a></th>
<th><a href='../SalesVolume/vol_region_kpi.php?idno=SERVICE%20KIT&idno2=style=text-decoration:none;'><font color=000000>Service Kit</a></th>
<th><a href='../SalesVolume/vol_region_kpi.php?idno=HANDSET&idno2=style=text-decoration:none;'><font color=000000>Handset</a></th>
</tr>
<tr ng-repeat="emp in emplist | orderBy : header : type |filter : searchdata" ng-class="'color' + ($index % 3)" >
<td>{{emp.region}}</td>
<td>{{emp.SIM_KIT}}</td>
<td>{{emp.DATA_CARD}}</td>
<td>{{emp.SERVICE_KIT}}</td>
<td>{{emp.HANDSET}}</td>
<tr>
</table>
</body>
</html>
<script>
var temptype=false;
var tempbname="DSC";
var myapp=angular.module("mymodule",[])
	.controller("mycontroller",function($scope){
	var emplist=disp;
	$scope.emplist=emplist;
	$scope.header='region';
	$scope.type= temptype;
	$scope.buttonname=tempbname;
	$scope.sort=function(){
		if(temptype)
		{
			temptype=false;
			tempbname="DSC";
		}
		else
        {
            temptype=true;
            tempbname="ASC";	
		}	
		$scope.type= temptype;
		$scope.buttonname=tempbname;	
	}
	});
</script>