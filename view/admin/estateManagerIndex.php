<?php
require_once('head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
<body>
	<table>
		<tr>
			<th>用户名</th>
			<th>密码</th>
		</tr>
		<?php
		if(isset($_SESSION['estateManagerList'])&&!empty($_SESSION['estateManagerList'])){
			$estateManagerList = $_SESSION['estateManagerList'];
			foreach ($estateManagerList as $key => $value) {
				
				echo '<tr>';
					echo '<th>'. $value['estateName'].'</th>';
					echo '<th>'. $value['estatePassword'].'</th>';
					echo '<th>'.'<a href="'.__PUBLIC__.'/control/estateManagerControl.php?method=update&id='.$value['objectId'].'">修改</a>'.'</th>';
					echo '<th>'.'<a href="'.__PUBLIC__.'/control/estateManagerControl.php?method=delete&id='.$value['objectId'].'">删除</a>'.'</th>';
					echo '<th>'.'<a href="'.__PUBLIC__.'/control/estateManagerControl.php?method=look&id='.$value['villageId'].'">查看小区</a>'.'</th>';
				echo '</tr>';
			}
		}
		?>
	</table>
	<a href=<?php echo __PUBLIC__.'/view/admin/index.php'?>>返回</a>
</body>
</html>