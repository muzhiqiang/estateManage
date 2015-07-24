<?php
require_once('head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>查看小区</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
<body>
	<table>
		<tr>
			<th>小区名字</th>
			<th>小区地址</th>
		</tr>
		<?php
			session_start();
			if(isset($_SESSION['villageInfo'])){
				$villageInfo = $_SESSION['villageInfo'];
				echo '<th>'.$villageInfo['villageName'].'</th>';
				echo '<th>'.$villageInfo['address'].'</th>';
			}
		?>
	</table>
	<a href=<?php echo __PUBLIC__.'/view/admin/estateManagerIndex.php'?>>返回</a>
</body>
</html>