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
		<option value='REGION'>Distributor Name</option>
		<option value='COUNT'>Sales Count</option>
		<select>
	</th>
	<th colspan='2'>
		Select asending/decending : 
		<input type='button' value='{{buttonname}}' ng-click='sort()'/>
	</th>
</tr>
<tr>
<th colspan='5' align='left'>
Search Data : <input type='text' ng-model='searchdata.DISTRIBUTOR_NAME' placeholder='Search Data'/>
</th>
</tr>
<tr>
<th colspan="3">Distributor Name</th>
<th colspan="2">Sales Count</th>
</tr>
<tr ng-repeat="emp in emplist | orderBy : header : type |filter : searchdata" ng-class="'color' + ($index % 3)" >

<td colspan="3">{{emp.DISTRIBUTOR_NAME}}</td>
<td colspan="2">{{emp.COUNT}}</td>
<tr>
</table>
</body>
</html>
<script>
var temptype=false;
var tempbname="DSC";
var myapp=angular.module("mymodule",[])
	.controller("mycontroller",function($scope){
	
	var emplist=dis1;

	$scope.emplist=emplist;
	$scope.header='DISTRIBUTOR_NAME';
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