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
		<option value='SC'>SC</option>
		<option value='ERS'>ERS</option>
		<option value='TELCO'>TELCO</option>
        <option value='MFS'>MFS</option>
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
<th><a href='../Pos/pos_region_kpi.php?idno=SC&idno2=style=text-decoration:none;'><font color=000000>SC</a></th>
<th><a href='../Pos/pos_region_kpi.php?idno=ERS&idno2=style=text-decoration:none;'><font color=000000>ERS</a></th>
<th><a href='../Pos/pos_region_kpi.php?idno=TELCO&idno2=style=text-decoration:none;'><font color=000000>TELCO</a></th>
<th><a href='../Pos/pos_region_kpi.php?idno=MFS&idno2=style=text-decoration:none;'><font color=000000>MFS</a></th>
</tr>
<tr ng-repeat="emp in emplist | orderBy : header : type |filter : searchdata" ng-class="'color' + ($index % 3)" >

<td>{{emp.region}}</td>
<td>{{emp.SC}}</td>
<td>{{emp.ERS}}</td>
<td>{{emp.TELCO}}</td>
<td>{{emp.MFS}}</td>
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
		else{
		
		temptype=true;
		tempbname="ASC";
		
		}
		
		$scope.type= temptype;
		$scope.buttonname=tempbname;
	
	}
	

	
	});
</script>