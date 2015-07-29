<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');

class manageModel
{
	function showUserList($objectId)				//获取用户信息列表
	{  	
		$tempId=$objectId;
		$query=new leancloud\AVQuery('House');
		
		$query->where('villageId',getPointer('Village',$tempId));
		$usefulResult=toArray($query->find(),array('villageId'));
		if(empty($usefulResult))
			return array('code','402');
		
		
		$HouseId=array();
		foreach ($usefulResult as $key => $value) {
			$HouseId[$key]=$value['objectId'];
		}
		
		$userList=array();
		$query=new leancloud\AVQuery('_User');
		foreach ($HouseId as $key => $value) {							//当出现两个人共用一个house记录时将会出错
			$query->where('houseId',getPointer('House',$value));
			$result=toArray($query->find(),array('houseId','parkingId','villageId'));
			if(sizeof($result)==1)
				$userList=array_merge($userList,$result);
			else
				return array('code','403');
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
		$tempId=$objectId;
		
		$query=new leancloud\AVQuery('_User');
		$query->where('objectId',$tempId);
		$userInfo=toArray($query->find(),array('houseId','parkingId','villageId'));
		if(empty($userInfo))
			return array('code','402');
		
		$query_h=new leancloud\AVQuery('House');
		$query_h->where('objectId',$userInfo[0]['houseId']);
		$houseInfo=toArray($query_h->find(),array('villageId'));
		
		if(isset($userInfo[0]['parkingId']))				//先判断是否有停车位
		{
			$query_p=new leancloud\AVQuery('Parking');
			$query_p->where('objectId',$userInfo[0]['parkingId']);
			$parkingInfo=toArray($query_p->find(),array('villageId'));
			$result=array('userInfo'=>$userInfo[0],'houseInfo'=>$houseInfo[0],'parkingInfo'=>$parkingInfo[0]);
			
		}
		else
			$result=array('userInfo'=>$userInfo[0],'houseInfo'=>$houseInfo[0],'parkingInfo'=>array('building'=>'','floor'=>'','unit'=>'','objectId'=>''));

		$d=date("m");
		if($d[0]=='0')
			$month=$d[1];
		else
			$month=$d;
		$year=date("Y");
		$query_h=new leancloud\AVQuery('Bill');
		$query_h->where('houseId',getPointer('House',$houseInfo[0]['objectId']));
		$billOfhouse=toArray($query_h->find(),array('houseId','parkingId'));
		if(isset($userInfo[0]['parkingId']))					//如果不存在停车位，则不需要进行停车费用的搜索
		{
			$query_p=new leancloud\AVQuery('Bill');
			$query_p->where('parkingId',getPointer('Parking',$parkingInfo[0]['objectId']));
			$billOfParking=toArray($query_p->find(),array('parkingId','houseId'));
		}
		$return=array();
		if(!empty($billOfhouse))
			foreach ($billOfhouse as $key => $value) {
				if($value['month']==$month&&$value['year']==$year)
					$return['house'][$key]=$value;
			}
		if(!empty($billOfParking))
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
			$isCover=toArray($house->find(),array('villageId'));
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
		if(isset($message['parking']['building'])&&isset($message['parking']['floor'])&&isset($message['parking']['unit']))
		{
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
				
			if(!empty($message['parking']['parkingId']))
			{
				$P=new leancloud\AVObject('Parking');
				$P->building=$message['parking']['building'];
				$P->floor=$message['parking']['floor'];
				$P->unit=$message['parking']['unit'];
				$return=$P->update($message['parking']['parkingId']);
			}
		}


		return $return;
	}
}
