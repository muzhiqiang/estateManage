<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');
session_start();

function showUserList()				//获取用户信息列表
{
	$tempId="55ae78fe00b096856ad76b35";
	$query=new leancloud\AVQuery('House');
	$query->where('villageId',getPointer('villageInfo',$tempId));
	$result=toArray($query->find(),array('villageId'));
	//print_r($result);
	$HouseId=array();
	foreach ($result as $key => $value) {
		$HouseId[$key]=$value['objectId'];
	}
	
	$userList=array();
	$query=new leancloud\AVQuery('_User');
	foreach ($HouseId as $key => $value) {
		$query->where('houseId',getPointer('House',$value));
		$result=toArray($query->find(),array('houseId','parkingId','villageId'));
		$userList=array_merge($userList,$result);
		//print_r($result);
	}
	return $userList;
}
