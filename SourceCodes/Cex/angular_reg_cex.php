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
	<th colspan='2'>
		Select column to sort : by default it is ascending : 
		<select ng-model='header'>
		<option value='Region_Name'>Region</option>
		<option value='Centre_Name'>Centre</option>
        <option value='rec'>Achieved</option>
        <option value='targ'>Target</option>
		<select>
	</th>
	<th colspan='2'>
		Select ascending/descending : 
        
		<input type='button' value='{{buttonname}}' ng-click='sort()'/>
	</th>
</tr>
<tr>
<th colspan='4' align='left'>
Search Data : <input type='text' ng-model='searchdata.Region_Name' placeholder='Search Data'/>
</th>
</tr>
<tr>
<th>Region</th>
<th>Centre</th>
<th>Achieved</th>
<th>Target</th>
</tr>
<tr ng-repeat="emp in emplist | orderBy : header : type |filter : searchdata" ng-class="'color' + ($index % 3)" >

<td>{{emp.Region_Name}}</td>
<td>{{emp.Centre_Name}}</td>
<td>{{emp.rec}}</td>
<td>{{emp.targ}}</td>
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
	$scope.header='Region_Name';
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