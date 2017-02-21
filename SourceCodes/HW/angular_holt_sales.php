<html>
<head>
<script src="angular.js"></script>
</head>
<body ng-app="mymodule">
  <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
<div class="panel-heading">
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table  ng-controller="mycontroller" width="100%" class="table table-bordered" id="dataTables1-example">
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
<th><script>document.write(head11)</script></th>
<th><script>document.write(head21)</script></th>
</tr>
<tr ng-repeat="emp in emplist | orderBy : header : type |filter : searchdata" ng-class="'color' + ($index % 3)" >

<td>{{emp.head1}}</td>
<td>{{emp.head2}}</td>
<tr>
</table>
</body>
</html>
<script>
var temptype=false;
var tempbname="DSC";
var myapp=angular.module("mymodule",[])
	.controller("mycontroller",function($scope){
	
	var emplist1=disp1;

	$scope.emplist=emplist1;
//	$scope.header='head1';
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