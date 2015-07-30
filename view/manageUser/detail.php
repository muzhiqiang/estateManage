<?php
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
	<title>用户详细</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
	<?php require_once('../estateManager/navigation.php');?>
	<h1>基本信息</h1>
<?php

	echo "账号：".$json['userInfo']['username']."</br>";
	echo "姓名：".$json['userInfo']['name']."</br>";
	
	if($json['userInfo']['gender']==1)
		echo "性别：男</br>";
	else if($json['userInfo']['gender']==2)
		echo "性别：女</br>";
	else
		echo "性别：</br>";
	
	if($json['userInfo']['type']=="tenant")
		echo "用户类型：租户</br>";
	else if($json['userInfo']['type']=="owner")
		echo "用户类型：房东</br>";
	else
		echo "用户类型：</br>";
	echo "联系电话：".$json['userInfo']['mobilePhoneNumber']."</br>";
	echo "邮箱地址：".$json['userInfo']['email']."</br>";
	echo "年龄：".$json['userInfo']['age']."</br>";
	echo "职业：".$json['userInfo']['occupation']."</br>";
	echo "婚姻状况：".$json['userInfo']['isMarried']."</br>";
	echo "住址：".$json['houseInfo']['building']."栋".$json['houseInfo']['floor']."层".$json['houseInfo']['unit']."号</br>";
	echo "停车位：";
	if(!empty($json['parkingInfo']))
		echo $json['parkingInfo']['building']."栋".$json['parkingInfo']['floor']."层".$json['parkingInfo']['unit']."</br>";
	else
		echo "</br>";
?>

<h1>当月账单</h1>
<?php require_once('../estateManager/navigation.php');?>
	<script type="text/javascript">
		document.getElementById('user').setAttribute('class','dropdown active');
		document.getElementById('userPass').setAttribute('class','active');
	</script>
<table class="table table-hover table-bordered table-responsive">
<tr>
	<th>类型</th>
	<th>用量</th>
	<th>单价</th>
	<th>总额</th>
</tr>
<?php
$sum=0;
	if(!empty($json['bill']['house']))
	foreach ($json['bill']['house'] as $key => $value) {
		echo '<tr>';
		echo "<td>".$value['type']."</td>";
		echo "<td>".$value['usage']."</td>";
		echo "<td>".$value['price']."</td>";
		echo "<td>".$value['total']."</td>";
		echo '</tr>';
		$sum+=$value['total'];
	}
	if(!empty($json['bill']['parking']))
		foreach ($json['bill']['parking'] as $key => $value) {
			echo '<tr>';
			echo "<td>".$value['type']."</td>";
			echo "<td>".$value['usage']."</td>";
			echo "<td>".$value['price']."</td>";
			echo "<td>".$value['total']."</td>";
			echo '</tr>';
			$sum+=$value['total'];
		}
?>

</table>
<?php
echo "总价：".$sum."</br>";
?>
<a <?php echo "href=\"../../control/billControl.php?method=showUserBill&userId=".$json['userInfo']['objectId']."\"";?>>点击查看详细账单</a></br>

<a <?php echo "href=\"../../control/manageUserControl.php?getMethod=modify&objectId=".$json['userInfo']['objectId']."\"";?>>修改该用户资料</a>


</body>
</html>
