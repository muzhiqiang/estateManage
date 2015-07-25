<?php
require_once('head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>注册管理员账号</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
<body>
	<form method="POST" action=<?php if(isset($_GET['id'])){echo __PUBLIC__.'/control/estateManagerControl.php?method=register&id='.$_GET['id'];} ?>>
		账号<input type='text' name='username'>
		密码<input type='password' name='password'>
		<input type='submit' value="提交">
	</form>
</body>
</html>