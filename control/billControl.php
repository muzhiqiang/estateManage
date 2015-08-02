<?php
require_once '../model/billModel.php';
require_once('../config/config.php');
function getUserBill($houseId)
{
	$bill=new billModel();
	$json=$bill->getUserBill($houseId);
	echo (json_encode($json));
}
function deleteBill($billId)
{
	$bill=new billModel();
	$return=$bill->deleteBill($billId);
	return($return);
}
function getTomonth($houseId)
{
	$bill=new billModel();
	$result=$bill->getTomonth($houseId);
	return $result;
}
function getOld($houseId)
{
	$bill=new billModel();
	$result=$bill->getOld($houseId);
	return $result;
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
function getId($houseId)
{
	$bill=new billModel();
	$result=$bill->getId($houseId);
	return $result;
}
function search($building,$floor,$unit)
{
	$bill=new billModel();
	$result=$bill->search($building,$floor,$unit);
	return $result;
}
if(isset($_GET['method']))
{
	switch($_GET['method'])
	{
		case 'showUserBill':
			if(!empty($_GET['houseId']))
			{
				header("Location:".__PUBLIC__."/view/bill/index.php?houseId=".$_GET['houseId']);
			}
			break;
		case 'getUserBill':
			echo json_encode(getTomonth($_GET['houseId']));
			break;
		case 'deleteBill':
			deleteBill($_GET['billId']);
			header("Location:".__PUBLIC__."/view/bill/index.php");
			break;
		case 'newBill':
			header("Location:".__PUBLIC__."/view/bill/add.php?houseId=".$_GET['houseId']."&parkingId=".$_GET['parkingId']);
			break;
		case 'getTomonth':
			echo json_encode(getTomonth($_GET['objectId']));
			break;
		case 'getOldBill':
			echo json_encode(getOld($_GET['houseId']));
			break;
		case 'getId':
			echo json_encode(getId($_GET['houseId']));
			break;
		case 'search':
			echo json_encode(search($_GET['building'],$_GET['floor'],$_GET['unit']));
			break;
		default:
			break;
	}
}

if(isset($_POST['submit']))
{
	//echo $_POST[$_POST['source']];
	if($_POST['source']=="houseId")
		$return=insertHouseBill($_POST['houseId'],$_POST['type'],$_POST['usage'],$_POST['price'],$_POST['total'],$_POST['unit']);
	else 
	{
		$return=insertParkingBill($_POST[$_POST['source']],$_POST['type'],$_POST['usage'],$_POST['price'],$_POST['total'],$_POST['unit']);
	}
		
	header("Location:".__PUBLIC__."/view/bill/index.php");
}
