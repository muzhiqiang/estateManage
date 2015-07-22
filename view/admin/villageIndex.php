<!DOCTYPE html>
<html>
<head>
	<title>小区管理</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
<body>
	<table>
		<tr>
			<th>小区名字</th>
			<th>地址</th>
		</tr>
		<?php
		session_start();
		if(isset($_SESSION['villageInfo'])&&!empty($_SESSION['villageInfo'])){
			$villageList = $_SESSION['villageInfo'];
			foreach ($villageList as $key => $value) {
				
				echo '<tr>';
					echo '<th>'. $value['villageName'].'</th>';
					echo '<th>'. $value['address'].'</th>';
					echo '<th>'.'<a href="../../control/villageControl?method=update&id='.$value['objectId'].'">修改</a>'.'</th>';
					echo '<th>'.'<a href="../../control/villageControl?method=delete&id='.$value['objectId'].'">删除</a>'.'</th>';
					echo '<th>'.'<a href="../../control/estateManagerControl.php?method=register&id='.$value['objectId'].'">注册管理员账号</a>'.'</th>';
				echo '</tr>';
			}
		}
		?>
	</table>
	<a href="../../control/villageControl.php?method=add">添加小区</a></br>
	<a href="index.php">返回</a>
</body>
</html>