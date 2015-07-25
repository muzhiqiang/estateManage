<?php
require_once('head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>小区修改</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
<body>
<table>
	<form method="POST" action=<?php echo __PUBLIC__.'/control/villageControl.php?method=update&id='.$_GET['id']; ?>>
		小区名字:<input name='villageName' type="text"/></br>
		地址:<input name="address" type="text"/></br>
		<input type="submit" value="提交"/>
	</form>
</table>
</body>
</html>