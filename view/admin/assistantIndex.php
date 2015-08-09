<?php 
require_once('head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>专员首页</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
	<?php require_once('navigation.php');?>
	<script type="text/javascript">
		document.getElementById('assistant').setAttribute('class','active');
	</script>
	<table class="table table-hover table-bordered table-responsive">
		<thead>
			<tr>
				<th>用户名</th>
				<th>密码</th>
				<th>删除</th>
				<th>查看小区</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(isset($_SESSION['assistantList'])&&!empty($_SESSION['assistantList'])){
			$assistantList = $_SESSION['assistantList'];
			foreach ($assistantList as $key => $value) {
				
				echo '<tr>';
					echo '<th>'. $value['username'].'</th>';
					echo '<th>'. $value['password'].'</th>';
					echo '<th>'.'<a href="'.__PUBLIC__.'/control/assistantControl.php?method=delete&id='.$value['objectId'].'">删除</a>'.'</th>';
					echo '<th>'.'<a href="'.__PUBLIC__.'/control/estateManagerControl.php?method=look&id='.$value['villageId'].'">查看小区</a>'.'</th>';
				echo '</tr>';
			}
		}
		?>
		</tbody>
	</table>
</body>
</html>