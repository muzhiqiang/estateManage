<!DOCTYPE html>
<?php
	require_once('head.php');
	require ('../../utils/getInformation.php');
	HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
	$HttpClient->get("http://localhost/estateManagement/control/manageUserControl.php?getMethod=getInformation");
	$json=json_decode($HttpClient->buffer,true);
	foreach ($json as $key => $value) {
		foreach ($value as $key_1 => $value_1) {
			echo $key_1.":".$value_1;
		}
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
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
		//selectMetthod();
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
	</tr>
	</table>
</center>
</body>
</html>