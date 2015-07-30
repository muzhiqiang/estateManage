<?php
	require_once('../../utils/getInformation.php');
	require_once('../estateManager/head.php');
	if(!empty($_GET['userId']))
		$_SESSION['userBillId']=$_GET['userId'];
	if(isset($_SESSION['userBillId']))
	{
		HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
		$HttpClient->get("http://localhost/estateManagement/control/billControl.php?method=getUserBill&userId=".$_SESSION['userBillId']);
		print_r("http://localhost/estateManagement/control/billControl.php?method=getUserBill&userId=".$_SESSION['userBillId']);
		$json=json_decode($HttpClient->buffer,true);
		print_r($json);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<title>账单</title>
	</head>
	
	<body>
		<?php
			echo $_GET['userId'];
		?>
	
	</body>
</html>