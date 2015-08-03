<?php
	require_once('../../utils/getInformation.php');
	require_once('../estateManager/head.php');
	if(isset($_GET['objectId']))
		$_SESSION['objectId']=$_GET['objectId'];				//houseId
	if(isset($_SESSION['objectId']))
	{
		HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
		$HttpClient->get("http://localhost/estateManagement/control/manageUserControl.php?getMethod=getDetailData&objectId=".$_SESSION['objectId']);
		$json=json_decode($HttpClient->buffer,true);
		if(!empty($json['userInfo']))
			$_SESSION['userId']=$json['userInfo']['objectId'];
		if(empty($json))
			$json=array('userInfo'=>'','houseInfo'=>'','parkingInfo'=>'');
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
	<div class="well" align="center">账号:<?php 
	if(empty($json['userInfo']['username']))
		echo "尚未填写";
	else
		echo $json['userInfo']['username'];?></div>
	<div class="well" align="center">姓名:<?php 
	if(empty($json['userInfo']['name']))
		echo "尚未填写";
	else
		echo $json['userInfo']['name'];?></div>
	<div class="well" align="center">性别:
				<?php
				if(!isset($json['userInfo']['gender']))
				{
					echo "尚未填写";
				} 
  				else if($json['userInfo']['gender']==1)
					echo "男";
				else if($json['userInfo']['gender']==2)
					echo "女";
				?>
	</div>
	<div class="well" align="center">用户类型:
				<?php 
				if(empty($json['userInfo']['type']))
					echo "尚未填写";
				else if($json['userInfo']['type']=="tenant")
					echo "租户";
				else if($json['userInfo']['type']=="owner")
					echo "房东";
				?>
	</div>
	<div class="well" align="center">联系电话:<?php 
	if(empty($json['userInfo']['mobilePhoneNumber']))
		echo "尚未填写";
	else
	echo $json['userInfo']['mobilePhoneNumber'];?></div>
	<div class="well" align="center">邮箱地址:<?php 
	if(empty($json['userInfo']['email']))
		echo "尚未填写";
	else
	echo $json['userInfo']['email'];?></div>
	<div class="well" align="center">年龄:<?php 
	if(empty($json['userInfo']['age']))
		echo "尚未填写";
	else
	echo $json['userInfo']['age'];?></div>
	<div class="well" align="center">职业:<?php 
	if(empty($json['userInfo']['occupation']))
		echo "尚未填写";
	else
	echo $json['userInfo']['occupation'];?></div>
	<div class="well" align="center">婚姻状况:<?php 
	if(empty($json['userInfo']['isMarried']))
		echo "尚未填写";
	else
		echo $json['userInfo']['isMarried'];?></div>
	<?php 
	if(!empty($json['houseInfo']))
	{
		foreach($json['houseInfo'] as $key =>$value)
		{
			if($value['objectId']==$_SESSION['objectId'])
				$owner="住址";
			else
				$owner="其他住址";
			echo "<div class=\"well\" align=\"center\">".$owner.": ".$value['building']."栋".$value['floor']."层".$value['unit']."号"."</div>";
		}
	}
	else
	{
		echo "<div class=\"well\" align=\"center\">住址:尚未拥有</div>";
	}		
		
	?>
	<?php
		if(!empty($json['parkingInfo']))
		{
			foreach($json['parkingInfo'] as $k =>$v)
			{
				$number=$k+1;
				echo "<div class=\"well\" align=\"center\">停车位: ".$v['building']."栋".$v['floor']."层".$v['unit']."号"."</div>";
			}
		}
		else
		{
			echo "<div class=\"well\" align=\"center\">停车位:尚未拥有</div>";
		}
	?>

</div>
<div class="well col-sm-2">
	<a <?php echo "href=\"../../control/manageUserControl.php?getMethod=deleteUser&userId=".$_SESSION['objectId']."\"";?>>删除该用户</a></br> 
</div>





</body>
</html>
