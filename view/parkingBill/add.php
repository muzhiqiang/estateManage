﻿<?php
	require_once('../../utils/getInformation.php');
	require_once('../estateManager/head.php');
	if(isset($_SESSION['parkingId']))
	{
		HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
		$HttpClient->get("http://localhost/estateManagement/control/billControl.php?method=addParking&parkingId=".$_SESSION['parkingId']);
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
		echo "<div class='container'>";
		require_once('navigation.php');
	?>
	<script type="text/javascript">
		document.getElementById("bill").setAttribute("class","active");
		document.getElementById("addBill").setAttribute("class","active");
	</script>
	<div align="center" class="col-sm-5">
	<form class="form-horizontal" role="form" method="post" action=<?php echo __PUBLIC__.'/control/billControl.php'?>>
		<input type="hidden" name="parkingId" <?php  echo "value=\"".$_SESSION['parkingId']."\""; ?>>
		<div class="row form-group">
			<label for="source" class="col-sm-4 control-label">停车位</label>
			<div class="col-sm-4">
				<?php echo $json['parkingInfo']['building']."栋".$json['parkingInfo']['floor']."层".$json['parkingInfo']['unit']."号" ;?><input checked="true" type="radio" class="form-control" name="source" value=<?php echo "\"parkingId\"";?>></br>
			</div>
			
				
		</div>
		<div class="row form-group">
			<label for="type" class="col-sm-4 control-label">类型</label>
			<div class="col-sm-4">
				<select name="type" class="form-control">
					<option name="water" value="停车费" checked=true>停车费</option>
				</select></br>
			</div>
		</div>
		<div class="row form-group">
			<label for="usage" class="col-sm-4 control-label">用量</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="usage"     value="1"></br>
			</div>
		</div>
		<div class="row form-group">
			<label for="price" class="col-sm-4 control-label">单价</label>
			<div class="col-sm-4">
				<input type="text" name="price" class="form-control"></br>
			</div>
		</div>
		<div class="row form-group">
			<label for="total" class="col-sm-4 control-label">总价</label>
			<div class="col-sm-4">
				<input class="form-control" type="text" name="total"></br>
			</div>
		</div>
		<div class="row form-group">
			<label for="unit" class="col-sm-4 control-label">单位</label>
			<div class="col-sm-4">
				<input class="form-control" type="text" name="unit" value="月"></br>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-6">
				<button type="submit" class="btn btn-primary">提交</button>
			</div>
		</div>
	</form>
	</div>
	<div class="container col-sm-4">
		<div class="jumbotron">
			<h3>用户</h3>
				<?php 
				if(empty($json['userInfo']['name']))
					echo "尚未绑定用户";
				else
					echo $json['userInfo']['name'];?>
			<h3>联系电话</h3>
				<?php 
				if(!empty($json['userInfo']['name']))
					echo $json['userInfo']['mobilePhoneNumber'];?>
		</div>
	</div>
	</div>
	</body>
</html>