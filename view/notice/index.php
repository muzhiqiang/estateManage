<?php
require('../estateManager/head.php');
$noticeList = $_SESSION['noticeList'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>通知首页</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
<body>
<table>
	<tr>
		<th>标题</th>
		<th>时间</th>
	</tr>
	<?php
	foreach ($noticeList as $key => $value) {
		echo '<tr>'.
				'<th>'.$value['title'].'</th>'.
				'<th>'.substr($value['createdAt'], 0,10).'</th>'.
				'<th><a href="'.__PUBLIC__.'/view/notice/noticeDetail.php?key='.$key.'">查看详情</a></th>'.
			 '</tr>';
	}
	
	?>
</table>
<a href=<?php echo __PUBLIC__.'/view/notice/noticeEdit.php' ?>>编辑通知</a>
</body>
</html>