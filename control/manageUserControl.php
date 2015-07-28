<?php
require_once '../model/manageUserModel.php';
require_once('../config/config.php');

function forUserList($objectId)
{
	$message=new manageModel();
	$userList=$message->showUserList($objectId);

	echo json_encode($userList);

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
if(isset($_GET['getMethod']))
{
	$choice=$_GET['getMethod'];
	switch ($choice) {
		case 'showUserList':
			header("Location:".__PUBLIC__."/view/manageUser/index.php");
			break;
		case 'getInformation':
			forUserList($_GET['objectId']);
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

		default:
			# code...
			break;
	}
}