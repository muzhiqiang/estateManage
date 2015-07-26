<!DOCTYPE html>
<?php
	#require_once('head.php');
	require ('../../utils/getInformation.php');
	HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
	$HttpClient->get("http://localhost/estateManagement/control/manageUserControl.php?getMethod=getInformation&objectId=".$_SESSION['estateManager']['villageId']);
	#$HttpClient->get("http://localhost/estateManagement/control/manageUserControl.php?getMethod=getInformation&objectId=55b4b3d500b0bb80c44cf209");
	$json=json_decode($HttpClient->buffer,true);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>用户列表</title>
</head>
<body>
<center>
<h2>用户信息：</h2>
	<table border=1>
	<tr>
		<th>用户姓名</th>
		<th>性别</th>
		<th>联系电话</th>
		<th>座别</th>
		<th>楼层</th>
		<th>单元</th>
		<th>查看详细</th>
	</tr>
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
	</table>
<h2>申请名单：</h2>
	<table border=1>
	<tr>
		<th>用户姓名</th>
		<th>性别</th>
		<th>联系电话</th>
		<th>座别</th>
		<th>楼层</th>
		<th>单元</th>
		<th>通过</th>
		<th>拒绝</th>
	</tr>
	<?php
		foreach ($json as $key => $value) {
			if(!$value['isConfirm'])
			{
				echo "<tr>";
				echo "<td>".$value['name']."</td>";
				echo "<td>".$value['gender']."</td>";
				echo "<td>".$value['mobilePhoneNumber']."</td>";
				echo "<td>".$value['building']."</td>";
				echo "<td>".$value['floor']."</td>";
				echo "<td>".$value['unit']."</td>";
				echo "<td><a href=\"\">通过</a></td>";
				echo "<td><a href=\"\">拒绝</a></td>";
				echo "</tr>";
			}
		}
	?>
	</table>
</center>
</body>
</html>