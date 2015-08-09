<?php
require_once('head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>添加用户</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    	var i = 0;
    	var j = 0;
    	function addHouse(){
    		$("#house").append('<hr><div class="row form-group"><label for=houseBuilding'+i+' class="col-sm-4 control-label">座别</label><div class="col-sm-4"><input class="form-control" type="text" name=houseBuilding'+i+'></div></div>');
    		$("#house").append('<div class="row form-group"><label for=houseFloor'+i+' class="col-sm-4 control-label">楼层</label><div class="col-sm-4"><input class="form-control" type="text" name=houseFloor'+i+'></div></div>');
    		$("#house").append('<div class="row form-group"><label for=houseUnit'+i+' class="col-sm-4 control-label">单元</label><div class="col-sm-4"><input class="form-control" type="text" name=houseUnit'+i+'></div></div>')
    		i++;
    	};
    	function addParking(){
    		$("#parking").append('<hr><div class="row form-group"><label for=parkingBuilding'+j+' class="col-sm-4 control-label">座别</label><div class="col-sm-4"><input class="form-control" type="text" name=parkingBuilding'+j+'></div></div>');
    		$("#parking").append('<div class="row form-group"><label for=parkingFloor'+j+' class="col-sm-4 control-label">楼层</label><div class="col-sm-4"><input class="form-control" type="text" name=parkingFloor'+j+'></div></div>');
    		$("#parking").append('<div class="row form-group"><label for=parkingUnit'+j+' class="col-sm-4 control-label">单元</label><div class="col-sm-4"><input class="form-control" type="text" name=parkingUnit'+j+'></div></div>')
    		j++;
    	};
    	function add(){
    		$("#content").append('<input type="hidden" name="houseNum" value='+i+'>');
    		$("#content").append('<input type="hidden" name="parkingNum" value='+j+'>');
    	};
    </script>
</head>
<body>
	<?php require_once('navigation.php');?>
	<script type="text/javascript">
		document.getElementById('user').setAttribute('class','dropdown active');
		document.getElementById('addUser').setAttribute('class','active');
	</script>
	<div align="center">
		<form method="POST" action=<?php echo __PUBLIC__."/control/assistantControl.php?method=add"?> role="form" class="form-horizontal" id="content">
 			<div class="row form-group">
 				<label for="username" class="col-sm-4 control-label">账号</label>
 				<div class="col-sm-4">
 					<input class="form-control" type="text" name="username"/>*
 				</div>
 			</div>
 			<div class="row form-group">
 				<label for="password" class="col-sm-4 control-label">密码</label>
 				<div class="col-sm-4">
 					<input class="form-control" type="text" name="password">*
 				</div>
 			</div>
 			<div class="row form-group">
 				<label for="name" class="col-sm-4 control-label">姓名</label>
 				<div class="col-sm-4">
 					<input class="form-control" type="text" name="name"/>
 				</div>
 			</div>
 			<hr>
 			<div class="row form-group">
 				<label for="gender" class="col-sm-4 control-label">性别</label>
 				<div class="col-sm-4">
					<input  type="radio" name="gender" value="0" checked="true">未知
					<input type="radio" name="gender" value="1">男
					<input type="radio" name="gender" value="2">女
				</div>
			</div>
			<hr>
			<div class="row form-group">
				<label for="age" class="col-sm-4 control-label">年龄</label>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="age">
				</div>
			</div>
			<hr>
			<div class="row form-group">
				<label for="mobilePhoneNumber" class="col-sm-4 control-label">联系电话</label>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="mobilePhoneNumber">*
				</div>
			</div>
			<hr>
			<div class="row form-group">
				<label for="type" class="col-sm-4 control-label">用户类型</label>
				<div class="col-sm-4">
					<input type="radio" name="type" value="tenant">租户
					<input type="radio" name="type" value="owner" checked="true">业主
				</div>
			</div>
			<hr>
			<div class="row form-group">
				<label for="email" class="col-sm-4 control-label">邮箱地址</label>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="email"/>
				</div>
			</div>
			<hr>
			<div class="row form-group">
				<label for="isMarried" class="col-sm-4 control-label">婚姻状况</label>
				<div class="col-sm-4">
					<input type="radio" name="isMarried" value="未知" checked="true">未知
					<input type="radio" name="isMarried" value="已婚">已婚
					<input type="radio" name="isMarried" value="未婚">未婚
				</div>
			</div>
			<hr>
			
		
			<div class="row form-group">
				<label for="occupation" class="col-sm-4 control-label">职业</label>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="occupation">
				</div>	
			</div>
			<hr>
			<h4>房屋地址</h4>
			<a href="#" class="btn btn-primary" onclick="addHouse()">添加房屋</a>
			<div id="house">
				
			</div>
			<hr>
			<h4>停车位地址</h4>
			<a href="#" class="btn btn-primary" onclick="addParking()">添加车位</a>
			<div id="parking">
				
			</div>
			<hr>
			
			
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
					<button type="submit" class="btn btn-primary" onclick="add()">确定</button>
				</div>
			</div>
		</form>
	</div>
</body>
</html>