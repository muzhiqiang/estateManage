<?php
require_once('head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>添加小区</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
<body>
	<form method="POST" action=
	<?php
	
	echo __PUBLIC__.'/control/villageControl.php?method=add';
	?>>
		小区名字<input type='text' name='villageName'>
		小区地址<input type='text' name='address'>
		<input type='submit' value="提交">
	</form>
</body>
</html>