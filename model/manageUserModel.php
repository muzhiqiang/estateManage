<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');


function showUserList($objectId)				//获取用户信息列表
{  	
	#$tempId="55ae78fe00b096856ad76b35";
	$tempId=$objectId;
	$query=new leancloud\AVQuery('House');
	#$query->where('villageId',getPointer('villageInfo',$_SESSION['estateManager']['villageId']));
	$query->where('villageId',getPointer('villageInfo',$tempId));
	$usefulResult=toArray($query->find(),array('villageId'));
	
	$HouseId=array();
	foreach ($usefulResult as $key => $value) {
		$HouseId[$key]=$value['objectId'];
	}
	
	$userList=array();
	$query=new leancloud\AVQuery('_User');
	foreach ($HouseId as $key => $value) {
		$query->where('houseId',getPointer('House',$value));
		$result=toArray($query->find(),array('houseId','parkingId','villageId'));
		$userList=array_merge($userList,$result);
		
	}
	
	foreach ($usefulResult as $key => $value) {
		foreach ($value as $key_1 => $value_1) {
			$returnList[$key][$key_1]=$value_1;
		}
	}
	foreach ($userList as $key => $value) {
		foreach ($value as $key_1 => $value_1) {
			$returnList[$key][$key_1]=$value_1;
		}
	}
	
	return $returnList;
}