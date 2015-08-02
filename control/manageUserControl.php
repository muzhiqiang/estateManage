<?php
require_once '../model/manageUserModel.php';
require_once('../config/config.php');

function forUserList($objectId)
{
	$message=new manageModel();
	$userList=$message->showUserList($objectId);
	
	echo json_encode($userList);

}
function forApplyList($objectId)
{
	$message=new manageModel();
	$userList=$message->showUserList($objectId);
	$return=array();
	foreach ($userList as $key => $value) {
		if(!isset($value['isConfirm'])||$value['isConfirm']==false)
			$return[$key]=$value;
	}
	echo json_encode($return);
}
function forUserDetail($objectId)
{
	$message=new manageModel();
	$information=$message->showUserDetail($objectId);
	echo json_encode($information);
}
function passConfirm($objectId)
{
	$m=new manageModel();
	$return=$m->passConfirm($objectId);
	#echo $return;
}
function refuseConfirm($objectId)
{
	$m=new manageModel();
	$return=$m->refuseConfirm($objectId);
}
function getTomMnthBill($houseId,$parkingId)
{
	//$houseId="55b4a3da00b0bb80c44c4516";
	//$parkingId="55b4b47000b0bb80c44cf833";
	$m=new manageModel();
	$return=$m->showTomonthBill($houseId,$parkingId);
	echo json_encode($return);
}
function deleteUser($objectId)
{
	$m=new manageModel();
	$return=$m->deleteUserInfo($objectId);
	return $return;
}
function getModifyData($userId)
{
	$m=new manageModel();
	$return=$m->modifyUser($userId);
	return $return;
}
if(isset($_GET['getMethod']))
{
	$choice=$_GET['getMethod'];
	switch ($choice) {
		case 'showUserList':
			header("Location:".__PUBLIC__."/view/user/index.php");
			break;
		case 'getInformation':
			forUserList($_GET['objectId']);
			break;
		case 'modifyDetailData':
			echo json_encode(getModifyData($_GET['objectId']));
			break;
		case 'toDetail':
			header("Location:".__PUBLIC__."/view/manageUser/index.php?objectId=".$_GET['objectId']);
			break;
		case 'getDetailData':
			forUserDetail($_GET['objectId']);
			break;
		case 'getConfirm':
			if($_GET['isPass']=='true')
			{
				passConfirm($_GET['objectId']);
				header("Location:".__PUBLIC__."/view/manageUser/index.php");
			
				//返回格式数据是个object,如何处理?
			}
			else
			{
				refuseConfirm($_GET['objectId']);
				header("Location:".__PUBLIC__."/view/manageUser/index.php");
			}

			break;
		case 'modify':
			header("Location:".__PUBLIC__."/view/manageUser/modify.php?objectId=".$_GET['objectId']);
			//echo "Location:".__PUBLIC__."/view/manageUser/modify.php?objectId=".$_GET['objectId'];
			break;
		case 'deleteUser':
			deleteUser($_GET['userId']);
			header("Location:".__PUBLIC__."/view/manageUser/index.php");
			break;
		default:
			# code...
			break;
	}
}
if(isset($_POST['userId']))
{
	if(!isset($_POST['name']))
	{
		$_POST['name']='';
	}
	if(!isset($_POST['type']))
	{
		$_POST['type']='';
	}
	if(!isset($_POST['isMarried']))
	{
		$_POST['isMarried']='';
	}
	$name="parkingId";
	$number='0';
	while(isset($_POST[$name.$number]))
	{
		$parkingInfo[$number]=array('building' =>$_POST['parkingBuilding'.$number],'floor'=>$_POST['parkingFloor'.$number],'unit'=>$_POST['parkingUnit'.$number],'parkingId'=>$_POST['parkingId'.$number]);
		$number++;
	}
	$message=array('name'=>$_POST['name'],'gender'=>$_POST['gender'],'type'=>$_POST['type'],'isMarried'=>$_POST['isMarried'],'mobilePhoneNumber'=>$_POST['mobilePhoneNumber'],'email'=>$_POST['email'],'age'=>$_POST['age'],'occupation'=>$_POST['occupation'],'userId'=>$_POST['userId'],'house'=>array('building' =>$_POST['houseBuilding'],'floor'=>$_POST['houseFloor'],'unit'=>$_POST['houseUnit'],'houseId'=>$_POST['houseId']),'parking'=>$parkingInfo);
	
	
	$m=new manageModel();
	$return=$m->updateUser($message);
	header("Location:".__PUBLIC__."/view/manageUser/detail.php");
}