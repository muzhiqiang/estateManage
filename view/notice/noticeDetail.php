<?php
require_once('../estateManager/head.php');
$key = $_GET['key'];

$noticeList = $_SESSION['noticeList'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>详细通知</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php require_once('../estateManager/navigation.php');?>
	<table class="table table-hover table-bordered table-responsive">
		<thead>
			<tr>
				<th>标题</th>
				<th>内容</th>
				<th>时间</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th><?php echo $noticeList[$key]['title']; ?></th>
				<th><?php echo $noticeList[$key]['content'];?></th>
				<th><?php echo substr($noticeList[$key]['createdAt'],0,10); ?></th>
			</tr>
		</tbody>
	</table>
</body>
</html>