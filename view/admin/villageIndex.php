<?php
require_once('head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>小区管理</title>
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
      				<li class="active"><a href=<?php echo __PUBLIC__.'/control/villageControl.php?method=getAll';?>>小区列表</a></li>
         			<li><a href=<?php echo __PUBLIC__.'/control/villageControl.php?method=add'?>>添加小区</a></li>
      			</ul>
   			</li>
			<li><a href=<?php echo __PUBLIC__.'/control/estateManagerControl.php?method=getAll';?>>小区管理员账号管理</a></li>
			<li><a href=<?php echo __PUBLIC__.'/control/adminLoginControl.php'; ?>>退出</a></li>
	</ul>
	<table class="table table-hover table-bordered table-responsive">
		<thead>
			<tr>
				<th>小区名字</th>
				<th>地址</th>
				<th>修改</th>
				<th>删除</th>
				<th>注册管理员账号</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(isset($_SESSION['villageInfoList'])&&!empty($_SESSION['villageInfoList'])){
			$villageList = $_SESSION['villageInfoList'];
			foreach ($villageList as $key => $value) {
				echo '<tr>';
					echo '<th>'. $value['villageName'].'</th>';
					echo '<th>'. $value['address'].'</th>';
					echo '<th>'.'<a href="'.__PUBLIC__.'/view/admin/villageUpdate.php?id='.$value['objectId'].'">修改</a>'.'</th>';
					echo '<th>'.'<a href="'.__PUBLIC__.'/control/villageControl?method=delete&id='.$value['objectId'].'">删除</a>'.'</th>';
					echo '<th>'.'<a href="'.__PUBLIC__.'/control/estateManagerControl.php?method=register&id='.$value['objectId'].'">注册管理员账号</a>'.'</th>';
				echo '</tr>';
			}
		}
		?>
		</tbody>
	</table>
	</br>
</body>
</html>