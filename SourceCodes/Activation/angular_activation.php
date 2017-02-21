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
<tr><th colspan="4">Unit Activation Outlets</th></tr>
<tr>
	<th colspan='2'>
		Select column to sort : <br/>by default it is ascending : 
		<select ng-model='header'>
		<option value='REGION'>Region</option>
		<option value='MONTH2'><?php echo $date3;?></option>
        <option value='MONTH1'><?php echo $date2;?></option>
        <option value='MONTH'><?php echo $date1;?></option>
		<select>
	</th>
	<th colspan='2'>
		Select ascending/descending : 
		<input type='button' value='{{buttonname}}' ng-click='sort()'/>
	</th>
</tr>
<tr>
<th colspan='4' align='left'>
Search Data : <input type='text' ng-model='searchdata.REGION' placeholder='Search Data'/>
</th>
</tr>
<tr>
<th>Region</th>
<th><?php echo $date3;?></th>
<th><?php echo $date2;?></th>
<th><?php echo $date1;?></th>
</tr>
<tr ng-repeat="emp in emplist | orderBy : header : type |filter : searchdata" ng-class="'color' + ($index % 3)" >
<td>{{emp.REGION}}</td>
<td>{{emp.MONTH2}}</td>
<td>{{emp.MONTH1}}</td>
<td>{{emp.MONTH}}</td>
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
	$scope.header='REGION';
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