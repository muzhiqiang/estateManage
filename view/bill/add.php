<?php
	require_once('../../utils/getInformation.php');
	require_once('../estateManager/head.php');
	if(isset($_GET['houseId']))
	{
		$_SESSION['houseBill']=$_GET['houseId'];
		if($_GET['parkingId']!='unset')
			$_SESSION['parkingBill']=$_GET['parkingId'];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<title>添加新账单</title>
	</head>
	<body>
		<form action="../../control/billControl.php" method="POST">
		请选择产生费用来源</br>
			<input type="hidden" name="houseId" <?php  echo "value=\"".$_SESSION['houseBill']."\""; ?>>
			<input type="hidden" name="parkingId" <?php  echo "value=\"".$_SESSION['parkingBill']."\""; ?>>
			房屋<input type="radio" name="source" value=<?php echo "\"houseId\"";?>>
			停车位<input type="radio" name="source" value=<?php echo "\"parkingId\"";?>></br>
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
	</body>
</html>