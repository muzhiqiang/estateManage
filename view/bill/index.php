<?php
	require_once('../../utils/getInformation.php');
	require_once('../estateManager/head.php');
	if(!empty($_GET['userId']))
		$_SESSION['userBillId']=$_GET['userId'];
	if(isset($_SESSION['userBillId']))
	{
		HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
		$HttpClient->get("http://localhost/estateManagement/control/billControl.php?method=getUserBill&userId=".$_SESSION['userBillId']);
		
		$json=json_decode($HttpClient->buffer,true);
		$isToMonth=true;
		$year=date('Y');
		$month=date('m');
		if($month[0]=='0')
			$month=$month[1];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		
		
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<title>用户账单</title>
	</head>
	
	<body>
	<form>
		搜索用户：<input type="text" name="username">
		<input type="submit" name="findUser">
	</form>
	
	<?php 
		if(isset($json))
		{	
			echo "用户:".$json['userInfo'][0]['name']."   联系电话：".$json['userInfo'][0]['mobilePhoneNumber'];
			$len=sizeof($json['house'])+sizeof($json['parking']);
		
			while($len!=0)
			{
				
				$sum=0;
				echo "<h1>".$year."  ".$month."</h1>";
				echo "<table>
						<tr>
							<th>类型</th>
							<th>用量</th>
							<th>单价</th>
							<th>总额</th>";
							if($isToMonth)
								echo "<th>删除</th>";
				echo	"</tr>";
				if(!empty($json['house']))
					foreach($json['house'] as $key=>$value)
					{
						if($value['year']==$year&&$value['month']==$month)
						{
							echo "<tr>";
							echo "<td>".$value['type']."</td>";
							echo "<td>".$value['usage']."</td>";
							echo "<td>".$value['price']."</td>";
							echo "<td>".$value['total']."</td>";
							if($isToMonth)
							{	
								echo "<td><a href=\"../../control/billControl.php?method=deleteBill&billId=".$value['objectId']."\">删除</a></td>";
								$houseId=$value['houseId'];
							}
							echo "</tr>";
							$len--;
							$sum+=$value['total'];
						}
					}
				if(!empty($json['parking']))
					foreach($json['parking'] as $key=>$value)
					{
						if($value['year']==$year&&$value['month']==$month)
						{
							echo "<tr>";
							echo "<td>".$value['type']."</td>";
							echo "<td>".$value['usage']."</td>";
							echo "<td>".$value['price']."</td>";
							echo "<td>".$value['total']."</td>";
							if($isToMonth)
							{	
								echo "<td><a href=\"../../control/billControl.php?method=deleteBill&billId=".$value['objectId']."\">删除</a></td>";
								$parkingId=$value['parkingId'];
							}
							echo "</tr>";
							$len--;
							$sum+=$value['total'];
						}
					}
				echo "</table>";
				if($isToMonth)
				{	
					if(empty($parkingId))
						$parkingId='unset';
					if(empty($houseId))
						$houseId='unset';
					echo "<a href=\"../../control/billControl.php?method=newBill&houseId=".$houseId."&parkingId=".$parkingId."\">增加新账单</a>";
				}
				echo "<h3>总价:".$sum."</h3>";
				if($month!=1)
					$month--;
				else
				{
					$year--;
					$month='12';
				}
				$isToMonth=false;
			}
		}
	?>
		
		
		
	
	</body>
</html>