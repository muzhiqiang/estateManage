<?php
require_once('head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>修改密码</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
<body>
<form method="POST" action=<?php echo __PUBLIC__.'/control/estateManagerControl.php?method=update' ?>>
	新密码:<input name="password" type="password"/></br>
	确认密码:<input name="password2" type ="password"/></br>
	<input name='id' type="hidden" value=<?php echo $_GET['id']?>>
	<input type="submit" value="提交"/>
</form>
</body>
</html>