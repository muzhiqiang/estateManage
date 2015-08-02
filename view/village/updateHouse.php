<?php
require_once('../estateManager/head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>房屋修改</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
 	<link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
  	<script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
  	<script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  	<script type="text/javascript">
  		function getBuilding(){
  			$("#content").empty();
  			var building = $("#building").val();
  			var floor = $("#floor").val();
  			var unit = $("#unit").val();
  			var url = "http://localhost/estateManagement/control/villageControl.php?method=getBuilding";
  			if(building!=""){
  				url+=("&building="+building);
  			}
  			if(floor!=""){
  				url+=("&floor="+floor);
  			}
  			if(unit!=""){
  				url+=("&unit="+unit);
  			}
  			$.ajax({
  				type:"GET",
  				url:url,
  				dataType:"json",
  				success:function(data){
  					if(!$.isEmptyObject(data)){
  						$("#content").append('<thead><tr><th>栋</th><th>楼层</th><th>单元</th><th>删除</th></tr></thead><tbody id="tableBody"></tbody>')
  					}
  					else{
  						alert("查找无结果");
  					}
  					$.each(data,function(i,n){
  						$("#tableBody").append("<tr id="+n["objectId"]+"><th>"+n["building"]+"</th><th>"+n["floor"]+"</th><th>"+n["unit"]+"</th><th><button onclick='deleteHouse(\""+n["objectId"]+"\")' class='btn btn-primary'>删除</button></th></tr>")
  					});

  				}
  			});
  			return false;
  		};
  		function deleteHouse(objectId){
  			var url = "http://localhost/estateManagement/control/villageControl.php?method=deleteHouse&id="+objectId;
  			$.ajax({
  				type:"GET",
  				url:url,
  				dataType:"json",
  				success:function(data){
  					
  					$(document.getElementById(objectId)).remove();
  				}
  			});
  			return false;
  		};
  	</script>
</head>
<body>
<?php require_once('../estateManager/navigation.php');?>
<script type="text/javascript">
	document.getElementById('village').setAttribute('class','dropdown active');
	document.getElementById('updateHouse').setAttribute('class','active');
</script>
<div class="container">
   	<div class="jumbotron" align="center">
   		<div class='input-group col-sm-4'>
   			<input type='text' class='form-control' id='building'>
   			<span class='input-group-addon'>栋</span>
   			<input type='text' class='form-control' id='floor'>
   			<span class='input-group-addon'>层</span>
   			<input type='text' class='form-control' id='unit'>
   			<span class='input-group-addon'>单元</span>
   		</div>
   		<button onclick="getBuilding()" class="btn btn-primary">确定</button>
   		<table class="table table-hover table-bordered table-responsive" id="content">
			
		</table>
</div>
</body>
</html>