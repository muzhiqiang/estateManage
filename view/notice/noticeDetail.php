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
</head>
<body>
<h1><?php echo $noticeList[$key]['title'].'</br>'; ?></h1>
<h2><?php echo $noticeList[$key]['content'].'</br>'; ?></h2>
<h3><?php echo substr($noticeList[$key]['createdAt'],0,10); ?></h3>
</body>
</html>