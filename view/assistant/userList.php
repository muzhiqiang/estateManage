<!DOCTYPE html>
<?php
	require_once('head.php');
	require ('../../utils/getInformation.php');
	require ('../../utils/function.php');
	HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
	$HttpClient->get(__PUBLIC__."/control/assistantControl.php?method=showUserInfo&villageId=".$_SESSION['assistant']['villageId']);

	$json=json_decode($HttpClient->buffer,true);
?>
<html>
<head>
	<title>已录入用户</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
	<?php require_once('../assistant/navigation.php');?>
	<script type="text/javascript">
		document.getElementById('village').setAttribute('class','dropdown active');
		document.getElementById('lookHouse').setAttribute('class','active');
	</script>
	<div class="container">
	<table class="table table-hover table-bordered table-responsive">
		<h2>房屋对应用户:</h2>
		<thead>
			<tr>
				<th>账号</th>
				<th>姓名</th>
				<th>房屋地址</th>
				<th>性别</th>
				<th>年龄</th>
				<th>联系电话</th>
				<th>用户类型</th>
				<th>邮箱地址</th>
				<th>婚姻状况</th>
				<th>职业</th>
				<th>删除用户</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(!empty($json['house']))
		{
			foreach ($json['house'] as $key => $value) 
			{
				echo "<tr>";
				if(!empty($value['userInfo']['username']))
					echo "<td>".$value['userInfo']['username']."</td>";
				else 
					echo "<td>未知</td>";

				if(!empty($value['userInfo']['name']))
					echo "<td>".$value['userInfo']['name']."</td>";
				else 
					echo "<td>未知</td>";
				if(!empty($value['houseInfo']))
					echo "<td>".$value['houseInfo']['building']."座 ".$value['houseInfo']['floor']."层 ".$value['houseInfo']['unit']."单元</td>";
				else 
					echo "<td>未知</td>";

				if(!empty($value['userInfo']['gender']))
					{
						if($value['userInfo']['gender']==1)
							echo "<td>男</td>";
						else if($value['userInfo']['gender']==2)
							echo "<td>女</td>";
						else 
							echo "<td>未知</td>";
					}
				else 
					echo "<td>未知</td>";
				if(!empty($value['userInfo']['age']))
					echo "<td>".$value['userInfo']['age']."</td>";
				else 
					echo "<td>未知</td>";

				if(!empty($value['userInfo']['mobilePhoneNumber']))
					echo "<td>".$value['userInfo']['mobilePhoneNumber']."</td>";
				else 
					echo "<td>未知</td>";

				if(!empty($value['userInfo']['type']))
					{
						if($value['userInfo']['type']=='tenant')
							echo "<td>租户</td>";
						else if($value['userInfo']['type']=='owner')
							echo "<td>业主</td>";
						else 
							echo "<td>未知</td>";
					}
				else 
					echo "<td>未知</td>";

				if(!empty($value['userInfo']['email']))
					echo "<td>".$value['userInfo']['email']."</td>";
				else 
					echo "<td>未知</td>";
				if(!empty($value['userInfo']['isMarried']))
					echo "<td>".$value['userInfo']['isMarried']."</td>";
				else 
					echo "<td>未知</td>";
				if(!empty($value['userInfo']['occupation']))
					echo "<td>".$value['userInfo']['occupation']."</td>";
				else 
					echo "<td>未知</td>";

				echo "<td><a href=\"../../control/assistantControl.php?method=deleteUser&userId=".$value['userInfo']['objectId']."\">删除用户</a></td>";
				echo "</tr>";
			}
		}
			
		?>
		</tbody>
	</table>
	</div>
	<script type="text/javascript">
		document.getElementById('village').setAttribute('class','dropdown active');
		document.getElementById('lookHouse').setAttribute('class','active');
	</script>
	<div class="container">
	<table class="table table-hover table-bordered table-responsive">
		<h2>停车位对应用户:</h2>
		<thead>
			<tr>
				<th>账号</th>
				<th>姓名</th>
				<th>停车位地址</th>
				<th>性别</th>
				<th>年龄</th>
				<th>联系电话</th>
				<th>用户类型</th>
				<th>邮箱地址</th>
				<th>婚姻状况</th>
				<th>职业</th>
				<th>删除用户</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(!empty($json['parking']))
		{
			foreach ($json['parking'] as $key => $value) 
			{
				echo "<tr>";
				if(!empty($value['userInfo']['username']))
					echo "<td>".$value['userInfo']['username']."</td>";
				else 
					echo "<td>未知</td>";

				if(!empty($value['userInfo']['name']))
					echo "<td>".$value['userInfo']['name']."</td>";
				else 
					echo "<td>未知</td>";
				if(!empty($value['parkingInfo']))
					echo "<td>".$value['parkingInfo']['building']."座 ".$value['parkingInfo']['floor']."层 ".$value['parkingInfo']['unit']."单元</td>";
				else 
					echo "<td>未知</td>";

				if(!empty($value['userInfo']['gender']))
					{
						if($value['userInfo']['gender']==1)
							echo "<td>男</td>";
						else if($value['userInfo']['gender']==2)
							echo "<td>女</td>";
						else 
							echo "<td>未知</td>";
					}
				else 
					echo "<td>未知</td>";
				if(!empty($value['userInfo']['age']))
					echo "<td>".$value['userInfo']['age']."</td>";
				else 
					echo "<td>未知</td>";

				if(!empty($value['userInfo']['mobilePhoneNumber']))
					echo "<td>".$value['userInfo']['mobilePhoneNumber']."</td>";
				else 
					echo "<td>未知</td>";

				if(!empty($value['userInfo']['type']))
					{
						if($value['userInfo']['type']=='tenant')
							echo "<td>租户</td>";
						else if($value['userInfo']['type']=='owner')
							echo "<td>业主</td>";
						else 
							echo "<td>未知</td>";
					}
				else 
					echo "<td>未知</td>";

				if(!empty($value['userInfo']['email']))
					echo "<td>".$value['userInfo']['email']."</td>";
				else 
					echo "<td>未知</td>";
				if(!empty($value['userInfo']['isMarried']))
					echo "<td>".$value['userInfo']['isMarried']."</td>";
				else 
					echo "<td>未知</td>";
				if(!empty($value['userInfo']['occupation']))
					echo "<td>".$value['userInfo']['occupation']."</td>";
				else 
					echo "<td>未知</td>";

				echo "<td><a href=\"../../control/assistantControl.php?method=deleteParkingUser&userId=".$value['userInfo']['objectId']."\">删除用户</a></td>";
				echo "</tr>";
			}
		}
			
		?>
		</tbody>
	</table>
	</div>
</body>
</html>
