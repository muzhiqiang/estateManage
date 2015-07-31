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
		<title>用户账单</title>
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
	<div align="center" class="col-sm-5">
	<form role="form">
        <div class="input-group">
            <input type="text" class="form-control" name="username">
            <span class="input-group-btn">
          	    <button class="btn btn-default" type="submit" name="findUser">
                    搜索用户
                </button>
            </span>
        </div>
	</form>
	
	<?php 
		if(isset($json))
		{	
			
			$len=sizeof($json['house'])+sizeof($json['parking']);
		
			while($len!=0)
			{
				
				$sum=0;
				echo "<h1>".$year."  ".$month."</h1>";
				echo "<table class='table table-hover table-bordered table-responsive'>
						<thead>
						<tr>
							<th>类型</th>
							<th>用量</th>
							<th>单价</th>
							<th>总额</th>";
							if($isToMonth)
								echo "<th>删除</th>";
				echo	"</tr></thead>";
				echo "<tbody>";
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
				echo "</tbody>";
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
	</div>
	<div class="container col-sm-4">
		<div class="jumbotron">
			<h3>用户</h3>
				<?php echo $json['userInfo'][0]['name'];?>
			<h3>联系电话</h3>
				<?php echo $json['userInfo'][0]['mobilePhoneNumber'];?>
		</div>
	</div>
		
	
	</body>
</html>