<?php
	require_once('../../utils/getInformation.php');
	require_once('../estateManager/head.php');
	if(isset($_SESSION['billHouseId']))
	{
		HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
		$HttpClient->get("http://localhost/estateManagement/control/billControl.php?method=getId&houseId=".$_SESSION['billHouseId']);
		$json=json_decode($HttpClient->buffer,true);
		
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    	<link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    	<script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    	<script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
		<title>添加新账单</title>
	</head>
	<body>
	<?php 
		require_once('../estateManager/navigation.php');
		require_once('navigation.php');
	?>
		<form action="../../control/billControl.php" method="POST">
		请选择产生费用来源</br>
			<input type="hidden" name="houseId" <?php  echo "value=\"".$json['houseInfo']['objectId']."\""; ?>>
			
			房屋:<?php echo $json['houseInfo']['building']."栋".$json['houseInfo']['floor']."层".$json['houseInfo']['unit']."号" ;?><input type="radio" name="source" value=<?php echo "\"houseId\"";?>></br>
			<?php 
				foreach($json['parkingInfo'] as $key=>$value)
				{
					echo "停车位:".$value['building']."栋".$value['floor']."层".$value['unit']."号" ;
					echo "<input type=\"radio\" name=\"source\" value=\"parkingId".$key."\"></br>";
					echo "<input type=\"hidden\" name=\"parkingId".$key."\" value=\"".$value['objectId']."\">";
				}
			?>
			
			类型
			<select name="type">
				<option name="water" value="水费">水费</option>
				<option name="elc" value="电费" >电费</option>
				<option name="parking" value="停车费">停车费</option>
			</select></br>
			用量<input type="text" name="usage"></br>
			单价<input type="text" name="price"></br>
			总量<input type="text" name="total"></br>
			单位<input type="text" name="unit"></br>
			<input type="submit" name="submit" value="提交">
		</form>
		<div class="container col-sm-4">
		<div class="jumbotron">
			<h3>用户</h3>
				<?php echo $json['userInfo']['name'];?>
			<h3>联系电话</h3>
				<?php echo $json['userInfo']['mobilePhoneNumber'];?>
		</div>
	</div>
	</body>
</html>