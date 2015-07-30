<?php
require_once '../model/billModel.php';
require_once('../config/config.php');
function getUserBill($userId)
{
	$bill=new billModel();
	$json=$bill->getUserBill($userId);
	echo (json_encode($json));
}
function deleteBill($billId)
{
	$bill=new billModel();
	$return=$bill->deleteBill($billId);
	return($return);
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
		case 'deleteBill':
			deleteBill($_GET['billId']);
			header("Location".__PUBLIC__."/view/bill/index.php");
			break;
		case 'newBill':
			//print_r($_GET['parkingId']);
			//print_r($_GET['houseId']);
			header("Location:".__PUBLIC__."/view/bill/add.php?houseId=".$_GET['houseId']."&parkingId=".$_GET['parkingId']);
			break;
		default:
			break;
	}
}
function insertHouseBill($houseId,$type,$usage,$price,$total,$unit)
{
	$bill=new billModel();
	$return=$bill->insertHouseBill($houseId,$type,$usage,$price,$total,$unit);
	return $return;
}
function insertParkingBill($parkingId,$type,$usage,$price,$total,$unit)
{
	$bill=new billModel();
	$return=$bill->insertParkingBill($parkingId,$type,$usage,$price,$total,$unit);
	return $return;
}
if(isset($_POST['submit']))
{
	if($_POST['source']=="houseId")
		$return=insertHouseBill($_POST['houseId'],$_POST['type'],$_POST['usage'],$_POST['price'],$_POST['total'],$_POST['unit']);
	else if($_POST['source']=="parkingId")
		$return=insertParkingBill($_POST['parkingId'],$_POST['type'],$_POST['usage'],$_POST['price'],$_POST['total'],$_POST['unit']);
	header("Location:".__PUBLIC__."/view/bill/index.php");
}
