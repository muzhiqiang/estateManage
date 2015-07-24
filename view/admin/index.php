<?php
	require_once('head.php');
?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>后台管理</title>
		<meta http-equiv="Content-Type:" content="text/html;charset=utf-8">
	</head>
	<body>
		<a href=
		<?php 
		echo __PUBLIC__.'/control/villageControl.php?method=getAll';
		?>>
		小区管理</a>
		<a href=
		<?php
		echo __PUBLIC__.'/control/estateManagerControl.php?method=getAll';
		?>>
		小区管理员账号管理
		</a>
	</body>
	</html>