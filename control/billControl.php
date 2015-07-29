<?php
require_once '../model/billModel.php';
require_once('../config/config.php');
if(isset($_GET['method']))
{
	switch($_GET['method'])
	{
		case 'showUserBill':
			header("Location:".__PUBLIC__."/view/bill/index.php?houseId=".$_GET['houseId']."&parkingId=".$_GET['parkingId']);
			break;
		default:
			break;
	}
	
}
