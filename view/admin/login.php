<?php
require_once('../../config/config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>后台登陆</title>
	<meta http-equiv="Content-Type:" content="text/html;charset=utf-8">
</head>
<body>
	<form method="post" action=<?php echo __PUBLIC__.'/control/adminLoginControl.php'?>>
		账号:<input type="text" name="adminName"></br>
		密码:<input type="password" name="adminPassword"></br>
		<input type="submit" value="提交">
	</form>
</body>
</html>