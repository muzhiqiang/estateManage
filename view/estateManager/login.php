<?php
require_once('../../config/config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>管理员登录</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
<body>
	<form method="POST" action=<?php echo __PUBLIC__.'/control/estateManagerControl.php?method=login'?>>
		账号:<input type="text" name="username"></br>
		密码:<input type="password" name="password"></br>
		<input type="submit" value="提交">
	</form>
</body>
</html>