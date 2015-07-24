<?php
	require_once('head.php');
	$estateManager = $_COOKIE['estateManager'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>首页</title>
</head>
<body>
<?php echo $estateManager['villageName']?>
<a href="">账号管理</a></br>
<a href="">业主管理</a></br>
<a href=<?php echo __PUBLIC__.'/control/noticeControl.php?method=getAll&id='.$estateManager['villageId'];?>>通知管理</a><br>
<a href="">账单管理</a><br>
<a href="">维修管理</a><br>
</body>
</html>