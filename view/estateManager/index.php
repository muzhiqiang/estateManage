<?php
	require_once('head.php');
	$estateManager = $_SESSION['estateManager'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>首页</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
<body>
<?php echo $estateManager['villageName']?></br>
<a href="">账号管理</a></br>
<a href="">业主管理</a></br>
<a href=<?php echo __PUBLIC__.'/control/noticeControl.php?method=getAll&id='.$estateManager['villageId'];?>>通知管理</a><br>
<a href="">账单管理</a><br>
<a href="">维修管理</a><br>

</body>
</html>