<?php
require_once '../model/billModel.php';
require_once('../config/config.php');
function getUserBill($userId)
{
	$bill=new billModel();
	$json=$bill->getUserBill($userId);
	print_r(json_encode($json));
}
if(isset($_GET['method']))
{
	switch($_GET['method'])
	{
		case 'showUserBill':
			if(!empty($_GET['userId']))
			{
				header("Location:".__PUBLIC__."/view/bill/index.php?userId=".$_GET['userId']);
			}
			break;
		case 'getUserBill':
			getUserBill($_GET['userId']);
			break;
		default:
			break;
	}
	
}
