<!DOCTYPE html>
<?php
	require_once('../estateManager/head.php');
	require ('../../utils/getInformation.php');
	HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
	$HttpClient->get("http://localhost/estateManagement/control/manageUserControl.php?getMethod=getInformation&objectId=".$_SESSION['estateManager']['villageId']);
	#$HttpClient->get("http://localhost/estateManagement/control/manageUserControl.php?getMethod=getInformation&objectId=55b4b3d500b0bb80c44cf209");
	$json=json_decode($HttpClient->buffer,true);

?>
<html>
<head>
	<title></title>
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
				<th>用户姓名</th>
				<th>性别</th>
				<th>联系电话</th>
				<th>座别</th>
				<th>楼层</th>
				<th>单元</th>
				<th>查看详细</th>
			</tr>
		</thead>
		<tbody>
		<?php
			foreach ($json as $key => $value) {
				if($value['isConfirm'])
				{
					echo "<tr>";
					echo "<td>".$value['name']."</td>";
					echo "<td>".$value['gender']."</td>";
					echo "<td>".$value['mobilePhoneNumber']."</td>";
					echo "<td>".$value['building']."</td>";
					echo "<td>".$value['floor']."</td>";
					echo "<td>".$value['unit']."</td>";
					echo "<td><a href=\"detail.php?objectId=".$value['objectId']."\">查看详细</a></td>";
					echo "</tr>";
				}
			}
		?>
		</tbody>
	</table>
</body>
</html>
