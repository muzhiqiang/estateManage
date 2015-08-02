<!DOCTYPE html>
<?php
	require_once('../estateManager/head.php');
	require ('../../utils/getInformation.php');
	require ('../../utils/function.php');
	HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
	$HttpClient->get("http://localhost/estateManagement/control/manageUserControl.php?getMethod=getInformation&objectId=".$_SESSION['estateManager']['villageId']);
	$json=json_decode($HttpClient->buffer,true);
?>
<html>
<head>
	<title>用户列表</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
	<?php require_once('../estateManager/navigation.php');?>
	<script type="text/javascript">
		document.getElementById('user').setAttribute('class','dropdown active');
		document.getElementById('userPass').setAttribute('class','active');
	</script>
	<table class="table table-hover table-bordered table-responsive">
		<thead>
			<tr>
				<th>座别</th>
				<th>楼层</th>
				<th>单元</th>
				<th>查看详细</th>
			</tr>
		</thead>
		<tbody>
		<?php
			foreach ($json as $key => $value) {
				if(!empty($value['user']))
					{
						echo "<tr>";
						if(empty($value['building']))
							echo "<td>未知</td>";
						else
							echo "<td>".$value['building']."</td>";
						if(empty($value['floor']))
							echo "<td>未知</td>";
						else
							echo "<td>".$value['floor']."</td>";
						if(empty($value['unit']))
							echo "<td>未知</td>";
						else
							echo "<td>".$value['unit']."</td>";

						echo "<td><a href=\"detail.php?getMethod=toDetail&objectId=".$value['objectId']."\">查看详细</a></td>";
						echo "</tr>";
					}
			}
			foreach ($json as $key => $value) {
				if(empty($value['user']))
					{
						echo "<tr>";
						if(empty($value['building']))
							echo "<td>未知</td>";
						else
							echo "<td>".$value['building']."</td>";
						if(empty($value['floor']))
							echo "<td>未知</td>";
						else
							echo "<td>".$value['floor']."</td>";
						if(empty($value['unit']))
							echo "<td>未知</td>";
						else
							echo "<td>".$value['unit']."</td>";

						echo "<td>尚未绑定用户</td>";
						echo "</tr>";
					}
			}
		?>
		</tbody>
	</table>
</body>
</html>
