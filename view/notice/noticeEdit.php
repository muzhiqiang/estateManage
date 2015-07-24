<?php
require_once('../estateManager/head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>编辑通知</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
<body>
<table>
	<form method="post" action=<?php echo __PUBLIC__.'/control/noticeControl.php?method=add'?>>
		标题:<input name='title' type="text" /></br>
		内容:<textarea name="content" rows="10" cols="20"></textarea></br>
		<input type="submit" value="提交"/>
	</form>
</table>
</body>
</html>