<!DOCTYPE html>
<?php
		require_once('../estateManager/head.php');
		require ('../../utils/getInformation.php');
		if (isset($_GET['objectId']))
			$_SESSION['modifyId']=$_GET['objectId'];
		if(isset($_SESSION['objectId']))
		{
		HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
		$HttpClient->get("http://localhost/estateManagement/control/manageUserControl.php?getMethod=getDetailData&objectId=".$_SESSION['modifyId']);
		$json=json_decode($HttpClient->buffer,true);
		
		}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<title>修改用户信息</title>	
	</head>
	<body>
		<h1>基本信息</h1>
		<form method="POST" action="../../control/manageUserControl.php">
			<input type="hidden" name="userId" <?php  echo "value=\"".$json['userInfo']['objectId']."\""; ?>>
			<input type="hidden" name="parkingId" <?php  echo "value=\"".$json['parkingInfo']['objectId']."\""; ?>>
			<input type="hidden" name="houseId" <?php  echo "value=\"".$json['houseInfo']['objectId']."\""; ?>>
 			姓名<input type="text" name="name" <?php echo "value=\"".$json['userInfo']['name']."\""; ?>></br>

			性别<input type="radio" name="gender"
			<?php if($json['userInfo']['gender']==0)
			echo "checked";
			?> value="0">未知
			<input type="radio"
			<?php if($json['userInfo']['gender']==1)
			echo "checked";
			?>  name="gender" value="1">男
			<input type="radio" <?php if($json['userInfo']['gender']==2)
			echo "checked";
			?>  name="gender" value="2">女</br>

			用户类型<input type="radio" <?php if($json['userInfo']['type']=="tenant")
			echo "checked";
			?>  name="type" value="tenant">租户
			<input type="radio" <?php if($json['userInfo']['type']=="owner")
			echo "checked";
			?>   name="type" value="owner">业主</br>

			婚姻状况<input type="radio" <?php if($json['userInfo']['isMarried']=="未知")
			echo "checked";
			?> name="isMarried" value="未知">未知
			<input type="radio" 
			<?php if($json['userInfo']['isMarried']=="已婚")
			echo "checked";
			?> name="isMarried" value="已婚">已婚
			<input type="radio" <?php if($json['userInfo']['isMarried']=="未婚")
			echo "checked";
			?> name="isMarried" value="未婚">未婚
			</br>

			联系电话<input type="text" name="mobilePhoneNumber" <?php echo "value=\"".$json['userInfo']['mobilePhoneNumber']."\""; ?>></br>
			邮箱地址<input type="text" name="email" <?php echo "value=\"".$json['userInfo']['email']."\""; ?>></br>
			年龄<input type="text" name="age" <?php echo "value=\"".$json['userInfo']['age']."\""; ?>></br>
			职业<input type="text" name="occupation" <?php echo "value=\"".$json['userInfo']['occupation']."\""; ?>></br>
			房屋地址：</br>
				座别<input type="text" name="houseBuilding" <?php echo "value=\"".$json['houseInfo']['building']."\""; ?> ></br>
				楼层<input type="text" name="houseFloor" <?php echo "value=\"".$json['houseInfo']['floor']."\""; ?> ></br>
				单元<input type="text" name="houseUnit" <?php echo "value=\"".$json['houseInfo']['unit']."\""; ?> ></br>
			停车位地址：</br>
				座别<input type="text" name="parkingBuilding"  <?php echo "value=\"".$json['parkingInfo']['building']."\""; ?> ></br>
				楼层<input type="text" name="parkingFloor"  <?php echo "value=\"".$json['parkingInfo']['floor']."\""; ?> ></br>
				单元<input type="text" name="parkingUnit"  <?php echo "value=\"".$json['parkingInfo']['unit']."\""; ?> ></br>
			<input type="submit" name="submit">
		</form>
	</body>
</html>