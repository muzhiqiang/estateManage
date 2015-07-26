<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');

class manageModel
{
	function showUserList($objectId)				//获取用户信息列表
	{  	
		#$tempId="55ae78fe00b096856ad76b35";
		$tempId=$objectId;
		$query=new leancloud\AVQuery('House');
		#$query->where('villageId',getPointer('villageInfo',$_SESSION['estateManager']['villageId']));
		$query->where('villageId',getPointer('Village',$tempId));
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
	function showUserDetail($objectId)
	{
		#$tempId=$objectId;
		$tempId=$objectId;
		
		$query=new leancloud\AVQuery('_User');
		$query->where('objectId',$tempId);
		$userInfo=toArray($query->find(),array('houseId','parkingId','villageId'));
		
		$query_h=new leancloud\AVQuery('House');
		$query_h->where('objectId',$userInfo[0]['houseId']);
		$houseInfo=toArray($query_h->find(),array('villageId'));

		$query_p=new leancloud\AVQuery('Parking');
		$query_p->where('objectId',$userInfo[0]['parkingId']);
		$parkingInfo=toArray($query_p->find(),array('villageId'));
		$result=array('userInfo'=>$userInfo[0],'houseInfo'=>$houseInfo[0],'parkingInfo'=>$parkingInfo[0]);
		return $result;
	}
}
