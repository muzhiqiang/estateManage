<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');

class manageModel
{
	function showUserList($objectId)				//获取用户信息列表
	{  	
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
	function showUserDetail($objectId)				//返回用户详细信息
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



		$d=date("m");
		if($d[0]=='0')
			$month=$d[1];
		else
			$month=$d;
		$year=date("Y");
		$query_h=new leancloud\AVQuery('Bill');
		$query_h->where('houseId',getPointer('House',$houseInfo[0]['objectId']));
		$billOfhouse=toArray($query_h->find(),array('houseId'));
		
		$query_p=new leancloud\AVQuery('Bill');
		$query_p->where('parkingId',getPointer('Parking',$parkingInfo[0]['objectId']));
		$billOfParking=toArray($query_p->find(),array('parkingId'));
		$return=array();
		foreach ($billOfhouse as $key => $value) {
			if($value['month']==$month&&$value['year']==$year)
				$return['house'][$key]=$value;
		}
		foreach ($billOfParking as $key => $value) {
			if($value['month']==$month&&$value['year']==$year)
				$return['parking'][$key]=$value;
		}
		$result['bill']=$return;




		return $result;
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
		/*$deleteObject = new leancloud\AVObject('GameScore');
    $return = $deleteObject->delete($objectId);*/
    	$d=new leancloud\AVObject('_User');
    	$return=$d->delete($objectId);
    	return $return;
	}
	function updateUser($message)
	{
		$u=new leancloud\AVObject('_User');
		$u->name=$message['name'];
		$u->gender=$message['gender'];
		$u->type=$message['type'];
		$u->isMarried=$message['isMarried'];
		$u->mobilePhoneNumber=$message['mobilePhoneNumber'];
		$u->email=$message['email'];
		$u->age=$message['age'];
		$u->occupation=$message['occupation'];
		$return=$u->update($message['userId']);

		$house=new leancloud\AVQuery('House');
		$house->where('building',$message['house']['building']);
		$house->where('floor',$message['house']['floor']);
		$house->where('unit',$message['house']['unit']);
		$isCover=toArray($house->find(),array('villageId'));
		if(!empty($isCover))
		{
			if($isCover[0]['objectId']!=$message['house']['houseId'])	
				return array('code'=>'301');
		}
		$parking=new leancloud\AVQuery('Parking');
		$parking->where('building',$message['parking']['building']);
		$parking->where('floor',$message['parking']['floor']);
		$parking->where('unit',$message['parking']['unit']);
		$isCover=toArray($parking->find(),array('villageId'));
		if(!empty($isCover))
		{
			if($isCover[0]['objectId']!=$message['parking']['parkingId'])
				return array('code'=>'302');
		}
			

		$P=new leancloud\AVObject('Parking');
		$P->building=$message['parking']['building'];
		$P->floor=$message['parking']['floor'];
		$P->unit=$message['parking']['unit'];
		$return=$P->update($message['parking']['parkingId']);

		$updateHouse=new leancloud\AVObject('House');
		$updateHouse->building=$message['house']['building'];
		$updateHouse->floor=$message['house']['floor'];
		$updateHouse->unit=$message['house']['unit'];
		$updateHouse->update($message['house']['houseId']);


		return $return;
	}
}
