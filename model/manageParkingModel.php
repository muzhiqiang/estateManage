<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');

class manageModel
{
	function showParkingList($objectId)				//获取停车位用户信息列表
	{  	
		$villageId=$objectId;
		$query=new leancloud\AVQuery('Parking');
		$result=toArray($query->find(),array('villageId','user'));
		return $result;
	}
	function showParkingDetail($objectId)				//返回房屋用户详细信息
	{
		$parkingId=$objectId;
		
		
		
		$queryParking=new leancloud\AVQuery('Parking');
		
		$queryParking->where('objectId',$parkingId);
		$parkingInfo=toArray($queryParking->find(),array('villageId','user'));
		
		$queryUser=new leancloud\AVQuery('_User');
		$queryUser->where('objectId',$parkingInfo[0]['user']);
		$userInfo=toArray($queryUser->find(),array(''));
		
		if(empty($userInfo))
			return array('code'=>'700');
		
		
		$returnList=array('userInfo'=>$userInfo[0],'parkingInfo'=>$parkingInfo[0]);
		
		return $returnList;
	}
	function modifyParking($parkingId)	//传回修改停车位用户信息所需要的信息
	{
		$queryUser=new leancloud\AVQuery('_User');
		$queryUser->where('parkings',getPointer('House',$parkingId));
		$userInfo=toArray($queryUser->find(),array(''));
		
		$queryParking=new leancloud\AVQuery('Parking');
		$queryParking->where('objectId',$parkingId);
		$parkingInfo=toArray($queryParking->find(),array('villageId','user'));
		
		$returnList=array('userInfo'=>$userInfo[0],'parkingInfo'=>$parkingInfo[0]);
		
		return $returnList;
	}

	function updateUser($message)
	{
		$u=new leancloud\AVObject('_User');
		if(isset($message['name']))
			$u->name=$message['name'];
		if(isset($message['gender']))
			$u->gender=$message['gender'];
		if(isset($message['type']))
			$u->type=$message['type'];
		if(isset($message['isMarried']))
			$u->isMarried=$message['isMarried'];
		if(isset($message['mobilePhoneNumber']))
			$u->mobilePhoneNumber=$message['mobilePhoneNumber'];
		if(isset($message['email']))
			$u->email=$message['email'];
		if(isset($message['age']))
			$u->age=$message['age'];
		if(isset($message['occupation']))
			$u->occupation=$message['occupation'];
		$return=$u->update($message['userId']);
		if(isset($message['parking']['building'])&&isset($message['parking']['floor'])&&isset($message['parking']['unit']))
		{
			$parking=new leancloud\AVQuery('Parking');
			$parking->where('building',$message['parking']['building']);
			$parking->where('floor',$message['parking']['floor']);
			$parking->where('unit',$message['parking']['unit']);
			$isCover=toArray($parking->find(),array('villageId','user'));
			if(!empty($isCover))
			{
				if($isCover[0]['objectId']!=$message['parking']['parkingId'])	
					return array('code'=>'301');
			}
			$updateParking=new leancloud\AVObject('Parking');
			$updateParking->building=$message['parking']['building'];
			$updateParking->floor=$message['parking']['floor'];
			$updateParking->unit=$message['parking']['unit'];
			$updateParking->update($message['parking']['parkingId']);
		}
		
		return $return;
	}
	function deleteUserInfo($objectId)
	{
		$update=new leancloud\AVObject('Parking');
		$update->user=null;
		$return=$update->update($objectId);
		return $return;
	}
}