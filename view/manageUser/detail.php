<?php
=======
	require_once('../../utils/getInformation.php');
	require_once('../estateManager/head.php');
	if(isset($_GET['objectId']))
		$_SESSION['objectId']=$_GET['objectId'];
	if(isset($_SESSION['objectId']))
	{
		HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
		$HttpClient->get("http://localhost/estateManagement/control/manageUserControl.php?getMethod=getDetailData&objectId=".$_SESSION['objectId']);
		$json=json_decode($HttpClient->buffer,true);
	}
?>
<!DOCTYPE html>
<html>
<head>
=======
	<title>用户详细</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
	<?php require_once('../estateManager/navigation.php');?>
<?php
echo "账号：".$json['userInfo']['username']."</br>";
echo "姓名：".$json['userInfo']['name']."</br>";
if($json['userInfo']['gender']==0)
	echo "性别：未知</br>";
else if($json['userInfo']['gender']==1)
	echo "性别：男</br>";
else
	echo "性别：女</br>";
if($json['userInfo']['type']=="tenant")
	echo "用户类型：租户</br>";
else
	echo "用户类型：房东</br>";
echo "联系电话：".$json['userInfo']['mobilePhoneNumber']."</br>";
echo "邮箱地址：".$json['userInfo']['email']."</br>";
echo "年龄：".$json['userInfo']['age']."</br>";
echo "职业：".$json['userInfo']['occupation']."</br>";
echo "婚姻状况：".$json['userInfo']['isMarried']."</br>";
?>
<h1>当月账单</h1>
<a href="#">点击查看详细账单></a>
</body>
</html>
