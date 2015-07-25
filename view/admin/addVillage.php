<?php
require_once('head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>添加小区</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
	<ul class="nav nav-pills">
			<li><a href=<?php echo __PUBLIC__.'/view/admin/index.php'; ?>>首页</a></li>
			<li class="dropdown active"><a class="dropdown-toggle" data-toggle="dropdown" href="#">小区管理<span class="caret"></span></a>
      			<ul class="dropdown-menu">
      				<li><a href=<?php echo __PUBLIC__.'/control/villageControl.php?method=getAll';?>>小区列表</a></li>
         			<li class="active"><a href=<?php echo __PUBLIC__.'/control/villageControl.php?method=add'?>>添加小区</a></li>
      			</ul>
   			</li>
			<li><a href=<?php echo __PUBLIC__.'/control/estateManagerControl.php?method=getAll';?>>小区管理员账号管理</a></li>
			<li><a href=<?php echo __PUBLIC__.'/control/adminLoginControl.php'; ?>>退出</a></li>
	</ul>
	<hr>
	<div align="center">
		<form class="form-horizontal" role="form" method="POST" action=<?php echo __PUBLIC__.'/control/villageControl.php?method=add';?>>
			<div class="row form-group">
				<label for="villageName" class="col-sm-4">小区名字</label>
				<div class="col-sm-4">
					<input type='text' id='villageName' class="form-control">
				</div>
			</div>
			<div class="row form-group">
				<label class="col-sm-4" for="address">小区地址</label>
				<div class="col-sm-4">
					<input class="form-control" type='text' id='address'>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
					<button type="submit" class="btn btn-primary">登录</button>
				</div>
			</div>
		</form>
	</div>
</body>
</html>