<?php
	session_start();
	if(!isset($_SESSION["admin"])){
		header("Location:login.php");
	}else{
?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>后台管理</title>
		<meta http-equiv="Content-Type:" content="text/html;charset=utf-8">
	</head>
	<body>
		<a href="../../control/villageControl.php?method=getAll">小区管理</a>
		<a href="../../control/estateManagerControl.php?method=getAll">小区管理员账号管理</a>
	</body>
	</html>
<?php		
	}

?>