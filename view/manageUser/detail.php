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
<?php 
require_once('../estateManager/navigation.php');
require_once('navigation.php');
?>
<script type="text/javascript">
	document.getElementById('user').setAttribute('class','dropdown active');
	document.getElementById('userPass').setAttribute('class','active');
	document.getElementById('detail').setAttribute('class','active');
</script>

<div class="col-sm-7">
	<div class="well" align="center">账号:<?php echo $json['userInfo']['username'];?></div>
	<div class="well" align="center">姓名:<?php echo $json['userInfo']['name'];?></div>
	<div class="well" align="center">性别:
				<?php 
  				if($json['userInfo']['gender']==1)
					echo "男";
				else if($json['userInfo']['gender']==2)
					echo "女";
				else
					echo "";
				?>
	</div>
	<div class="well" align="center">用户类型:
				<?php 
				if($json['userInfo']['type']=="tenant")
					echo "租户";
				else if($json['userInfo']['type']=="owner")
					echo "房东";
				else
					echo "";
				?>
	</div>
	<div class="well" align="center">联系电话:<?php echo $json['userInfo']['mobilePhoneNumber'];?></div>
	<div class="well" align="center">邮箱地址:<?php echo $json['userInfo']['email'];?></div>
	<div class="well" align="center">年龄:<?php echo $json['userInfo']['age'];?></div>
	<div class="well" align="center">职业:<?php echo $json['userInfo']['occupation'];?></div>
	<div class="well" align="center">婚姻状况:<?php echo $json['userInfo']['isMarried'];?></div>
	<div class="well" align="center">住址:<?php echo $json['houseInfo']['building']."栋".$json['houseInfo']['floor']."层".$json['houseInfo']['unit']."号";?></div>
	<div class="well" align="center">停车位:<?php
														if(!empty($json['parkingInfo']))
															echo $json['parkingInfo']['building']."栋".$json['parkingInfo']['floor']."层".$json['parkingInfo']['unit']."</br>";
														else
															echo "无";?>
	</div>
</div>



<<<<<<< HEAD
</table>
<?php
echo "总价：".$sum."</br>";
?>
<a <?php echo "href=\"../../control/billControl.php?method=showUserBill&userId=".$json['userInfo']['objectId']."\"";?>>点击查看详细账单</a></br>
=======
>>>>>>> bd9e1bbde5acc87f93e334f32b0001d46bbc5265



</body>
</html>
