<html>
<head>
<script src="../../Displayfiles/angular.js"></script>
</head>
<body ng-app="myymodule">
  <link href="../../Displayfiles/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
<div class="panel-heading">
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table  ng-controller="myycontroller" width="100%" class="table table-bordered" id="dataTables-example">
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
    <th colspan="2"></th>
	<th colspan="3">
		Select column to sort : by default it is ascending : 
		<select ng-model='header'>
		<option value='co'>Coefficient</option>
		<option value='l1'>Lo 80</option>
		<option value='h1'>Hi 80</option>
        <option value='l2'>Lo 95</option>
		<option value='h2'>Hi 95</option>
		<select>
	</th>
	<th colspan="2">
		Select ascending/descending : 
		<input type='button' value='{{buttonname}}' ng-click='sort()'/>
	</th>
</tr>
<tr>
<th colspan="2"></th>
<th colspan="5" align='left'>
Search Data : <input type='text' ng-model='searchdata.co' placeholder='Search Data'/>
</th>
</tr>
<tr>
<th colspan="2">Initial Data</th>
<th colspan="5">Forcasting Data</th></tr>
<tr>
<th><script>document.write(head11)</script></th>
<th><script>document.write(head21)</script></th>
<th>Coefficient</th>
<th>Lo 80</th>
<th>Hi 80</th>
<th>Lo 95</th>
<th>Hi 95</th>
</tr>
<tr ng-repeat="emp in emplist | orderBy : header : type |filter : searchdata" ng-class="'color' + ($index % 3)" >
<td align=center>{{emp.head1}}</td>
<td align=center>{{emp.head2}}</td>
<td ng-if="emp.co" align=center>{{emp.co}}</td>
<td ng-if="!emp.co" align=center>-</td>
<td ng-if="emp.l1" align=center >{{emp.l1}}</td>
<td ng-if="!emp.l1" align=center >-</td>
<td ng-if="emp.h1" align=center>{{emp.h1}}</td>
<td ng-if="!emp.h1" align=center>-</td>
<td ng-if="emp.l2" align=center>{{emp.l2}}</td>
<td ng-if="!emp.l2" align=center>-</td>
<td ng-if="emp.h2" align=center>{{emp.h2}}</td>
<td ng-if="!emp.h2" align=center>-</td>
<tr>
</table>
</body>
</html>
<script>
var temptype=false;
var tempbname="DSC";
var myappp=angular.module("myymodule",[])
	myappp.controller("myycontroller",function($scope){
	
	var emplist=disp;

	$scope.emplist=emplist;
	$scope.header='co';
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