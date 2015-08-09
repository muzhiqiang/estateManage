<?php
require_once('head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>注册专员账号</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    	function check(){
    		if($("#password").val()!=$("#password2").val()){
    			alert("两次密码不一样");
    			return false;
    		}
    		return true;
    	}
    </script>
</head>
<body>
	<?php require_once('navigation.php');?>
	<div align="center">
	<form class="form-horizontal" role="form" method="post" action=<?php if(isset($_GET['id'])){echo __PUBLIC__.'/control/assistantControl.php?method=register&id='.$_GET['id'];} ?>>
		<div class="row form-group">
			<label for="username" class="col-sm-4 control-label">账号</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="username"></br>
			</div>
		</div>
		<div class="row form-group">
			<label for="password" class="col-sm-4 control-label">密码</label>
			<div class="col-sm-4">
				<input type="password" class="form-control" name="password" id="password"></br>
			</div>
		</div>
		<div class="row form-group">
			<label for="password2" class="col-sm-4 control-label">确认密码</label>
			<div class="col-sm-4">
				<input type="password" class="form-control" name="password2" id="password2"></br>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-6">
				<button type="submit" class="btn btn-primary" onclick="return check();">注册</button>
			</div>
		</div>
	</form>
	</div>
</body>
</html>