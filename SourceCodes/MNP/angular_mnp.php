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
	<th colspan='4'>
		Select column to sort : by default it is ascending : 
		<select ng-model='header'>
		<option value='region'>Region</option>
		<select>
	</th>
	<th colspan='3'>
		Select ascending/descending : 
		<input type='button' value='{{buttonname}}' ng-click='sort()'/>
	</th>
</tr>
<tr>
<th colspan='7' align='left'>
Search Data : <input type='text' ng-model='searchdata.region' placeholder='Search Data'/>
</th>
</tr>
<tr>
<th>#</th>
<th colspan="2"><?php echo $date3;?></th>
<th colspan="2"><?php echo $date2;?></th>
<th colspan="2"><?php echo $date1;?></th>
</tr>
<tr>
<th>Region</th>
<th>Port IN</th>
<th>Port OUT</th>
<th>Port IN</th>
<th>Port OUT</th>
<th>Port IN</th>
<th>Port OUT</th>
</tr>
<tr ng-repeat="emp in emplist | orderBy : header : type |filter : searchdata" ng-class="'color' + ($index % 3)" >

<td>{{emp.region}}</td>
<td>{{emp.p1}}</td>
<td>{{emp.p2}}</td>
<td>{{emp.p3}}</td>
<td>{{emp.p4}}</td>
<td>{{emp.p5}}</td>
<td>{{emp.p6}}</td>
<tr>
</table>
</body>
</html>
<script>
var temptype=false;
var tempbname="DSC";
var myapp=angular.module("mymodule",[])
	.controller("mycontroller",function($scope){
	
	var emplist=dis2;

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