<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');

class manageModel
{
	function showUserList($objectId)				//获取用户信息列表
	{  	
		$villageId=$objectId;
		$query=new leancloud\AVQuery('House');
		$result=toArray($query->find(),array('villageId','user'));
		return $result;
	}
	function showUserDetail($objectId)				//返回用户详细信息
	{
		$houseId=$objectId;
		
		$queryUser=new leancloud\AVQuery('_User');
		$queryUser->where('houses',getPointer('House',$houseId));
		$userInfo=toArray($queryUser->find(),array(''));
		
		if(empty($userInfo))
			return array('code'=>'700');
		
		$queryHouse=new leancloud\AVQuery('House');
		$queryHouse->where('user',getPointer('_User',$userInfo[0]['objectId']));
		$houseInfo=toArray($queryHouse->find(),array('villageId','user'));
		
		$queryParking=new leancloud\AVQuery('Parking');
		$queryParking->where('user',getPointer('_User',$userInfo[0]['objectId']));
		$parkingInfo=toArray($queryParking->find(),array('villageId','user'));
		
		$returnList=array('userInfo'=>$userInfo[0],'houseInfo'=>$houseInfo,'parkingInfo'=>$parkingInfo);
		
		return $returnList;
	}
	function modifyUser($houseId)
	{
		$queryUser=new leancloud\AVQuery('_User');
		$queryUser->where('houses',getPointer('House',$houseId));
		$userInfo=toArray($queryUser->find(),array(''));
		
		$queryHouse=new leancloud\AVQuery('House');
		$queryHouse->where('objectId',$houseId);
		$houseInfo=toArray($queryHouse->find(),array('villageId','user'));
		
		$queryParking=new leancloud\AVQuery('Parking');
		$queryParking->where('user',getPointer('_User',$userInfo[0]['objectId']));
		$parkingInfo=toArray($queryParking->find(),array('villageId','user'));
		
		$returnList=array('userInfo'=>$userInfo[0],'houseInfo'=>$houseInfo[0],'parkingInfo'=>$parkingInfo);
		
		return $returnList;
	}
	function passConfirm($objectId)					//通过验证
	{
	    $u=new leancloud\AVObject('_User');
	    $u->isConfirm=true;
	    $return=$u->update($objectId);
	    return $return;
	}
	function refuseConfirm($objectId)				//拒绝验证
	{
    	$d=new leancloud\AVObject('_User');
    	$return=$d->delete($objectId);
    	return $return;
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
		if(isset($message['house']['building'])&&isset($message['house']['floor'])&&isset($message['house']['unit']))
		{
			$house=new leancloud\AVQuery('House');
			$house->where('building',$message['house']['building']);
			$house->where('floor',$message['house']['floor']);
			$house->where('unit',$message['house']['unit']);
			$isCover=toArray($house->find(),array('villageId','user'));
			if(!empty($isCover))
			{
				if($isCover[0]['objectId']!=$message['house']['houseId'])	
					return array('code'=>'301');
			}
			$updateHouse=new leancloud\AVObject('House');
			$updateHouse->building=$message['house']['building'];
			$updateHouse->floor=$message['house']['floor'];
			$updateHouse->unit=$message['house']['unit'];
			$updateHouse->update($message['house']['houseId']);
		}
		if(!empty($message[parking]))
		{
			foreach($message['parking'] as $key => $value)
			{
				if(isset($value['building'])&&isset($value['floor'])&&isset($value['unit']))
				{
					$parking=new leancloud\AVQuery('Parking');
					$parking->where('building',$value['building']);
					$parking->where('floor',$value['floor']);
					$parking->where('unit',$value['unit']);
					$isCover=toArray($parking->find(),array('villageId','user'));
					if(!empty($isCover))
					{
						if($isCover[0]['objectId']!=$message['parking']['parkingId'])
							return array('code'=>'302');
					}
						
					if(!empty($value['parkingId']))
					{
						$P=new leancloud\AVObject('Parking');
						$P->building=$value['building'];
						$P->floor=$value['floor'];
						$P->unit=$value['unit'];
						$return=$P->update($value['parkingId']);
					}
				}
			}
		}
		return $return;
	}
	function deleteUserInfo($objectId)
	{
		$houseId=$objectId;
		$update=new leancloud\AVObject('House');
		$update->user=null;
		$return=$update->update($objectId);
		return $return;
	}
}
//$m=new manageModel();
//print_r($m->showUserDetail("55bb693e00b0efdcbe46a502"));