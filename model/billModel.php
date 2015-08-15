<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');
class billModel
{
	function getUserBill($userId)		//返回房屋用户所需信息
	{
		$query=new leancloud\AVQuery('_User');
		$query->where('objectId',$userId);
		$userInfo=toArray($query->find(),array('parkingId','houseId'));
		if(empty($userInfo))
			return array('code'=>'401');
		
		if(empty($userInfo[0]['houseId']))
			return array('code'=>'405');
		$query=new leancloud\AVQuery('Bill');
		$query->where('houseId',getPointer('House',$userInfo[0]['houseId']));
		$returnHouse=toArray($query->find(),array('houseId','parkingId'));
		
		$returnBill=array('house'=>$returnHouse,'userInfo'=>$userInfo);
		return $returnBill;
	}
	function deleteBill($billId)
	{
		$d=new leancloud\AVObject('Bill');
		$return=$d->delete($billId);
		return $return;
	}
	function insertHouseBill($houseId,$type,$usage,$price,$total,$unit)
	{
		$year=date('Y');
		$month=date('m');
		if($month[0]=='0')
			$month=$month[1];
		$obj=new leancloud\AVObject('Bill');
		$obj->houseId=getPointer('House',$houseId);
		$obj->unit=$unit;
		$obj->type=$type;
		$obj->usage=(double)$usage;
		$obj->price=(double)$price;
		$obj->total=(double)$total;
		$obj->year=(int)$year;
		$obj->month=(int)$month;
		$save=$obj->save();
		return $save;
	}
	function insertParkingBill($parkingId,$type,$usage,$price,$total,$unit)
	{
		$year=date('Y');
		$month=date('m');
		if($month[0]=='0')
			$month=$month[1];
		$obj=new leancloud\AVObject('Bill');
		$obj->parkingId=getPointer('Parking',$parkingId);
		$obj->unit=$unit;
		$obj->type=$type;
		$obj->usage=(double)$usage;
		$obj->price=(double)$price;
		$obj->total=(double)$total;
		$obj->year=(int)$year;
		$obj->month=(int)$month;
		$save=$obj->save();
		return $save;
	}
	function getTomonth($houseId)
	{
		$year=date('Y');
		$month=date('m');
		if($month[0]=='0')
			$month=$month[1];
		
		$queryUser=new leancloud\AVQuery('_User');
		$queryHouse = new leancloud\AVQuery("House");
		$queryHouse->where('objectId',$houseId);
		$houseInfo=toArray($queryHouse->find(),array('villageId','user'));
		$queryUser->where('objectId',$houseInfo[0]['user']);
		$userInfo = toArray($queryUser->find());
		if(empty($userInfo))
			return array('code'=>'700');
		
		$queryHouse=new leancloud\AVQuery('Bill');
		$queryHouse->where('houseId',getPointer('House',$houseId));
		$queryHouse->where('month',(int)$month);
		$queryHouse->where('year',(int)$year);
		$houseBill=toArray($queryHouse->find(),array('parkingId','houseId'));
		
		
		$returnList=array('house'=>$houseBill,'userInfo'=>$userInfo[0]);
		return $returnList;
		
	}
	function getToParking($parkingId)
	{
		$year=date('Y');
		$month=date('m');
		if($month[0]=='0')
			$month=$month[1];
		
		$queryUser=new leancloud\AVQuery('_User');
		$queryParking = new leancloud\AVQuery("Parking");
		$queryParking->where('objectId',$parkingId);
		$parkingInfo=toArray($queryParking->find(),array('villageId','user'));
		$queryUser->where('objectId',$parkingInfo[0]['user']);
		$userInfo = toArray($queryUser->find());
		
		if(empty($userInfo))
			return array('code'=>'700');
		
		$queryParking=new leancloud\AVQuery('Bill');
		$queryParking->where('parkingId',getPointer('Parking',$parkingId));
		$queryParking->where('month',(int)$month);
		$queryParking->where('year',(int)$year);
		$parkingBill=toArray($queryParking->find(),array('parkingId','parkingId'));
		
		
		$returnList=array('parking'=>$parkingBill,'userInfo'=>$userInfo[0]);
		return $returnList;
		
	}
	function search($building,$floor,$unit,$villageId)
	{
		$query=new leancloud\AVQuery('House');
		if($building!='unset')
			$query->where('building',$building);
		if($floor!='unset')
			$query->where('floor',$floor);
		if($unit!='unset')
			$query->where('unit',$unit);
		$query->where('villageId',getPointer('Village',$villageId));
		$houseInfo=toArray($query->find(),array('villageId','user'));
		
		$query=new leancloud\AVQuery('Parking');
		if($building!='unset')
			$query->where('building',$building);
		if($floor!='unset')
			$query->where('floor',$floor);
		if($unit!='unset')
			$query->where('unit',$unit);
		$query->where('villageId',getPointer('Village',$villageId));
		$parkingInfo=toArray($query->find(),array('villageId','user'));
		$return=array('house'=>$houseInfo,'parking'=>$parkingInfo);
		return $return;
	}
	function getId($houseId)
	{
		$queryUser=new leancloud\AVQuery('_User');
		$queryHouse = new leancloud\AVQuery("House");
		$queryHouse->where('objectId',$houseId);
		$houseInfo=toArray($queryHouse->find(),array('villageId','user'));
		$queryUser->where('objectId',$houseInfo[0]['user']);
		$userInfo = toArray($queryUser->find());
		
		$queryHouse=new leancloud\AVQuery('House');
		$queryHouse->where('objectId',$houseId);
		$houseInfo=toArray($queryHouse->find(),array('villageId','user'));
		if(empty($userInfo))
			$returnList=array('userInfo'=>'','houseInfo'=>$houseInfo[0]);
		else
			$returnList=array('userInfo'=>$userInfo[0],'houseInfo'=>$houseInfo[0]);
		return $returnList;
	}
	function getParkingMessage($parkingId)
	{
		$queryUser=new leancloud\AVQuery('_User');
		$queryParking = new leancloud\AVQuery("Parking");
		$queryParking->where('objectId',$parkingId);
		$parkingInfo=toArray($queryParking->find(),array('villageId','user'));
		$queryUser->where('objectId',$parkingInfo[0]['user']);
		$userInfo = toArray($queryUser->find());
		
		$queryParking=new leancloud\AVQuery('Parking');
		$queryParking->where('objectId',$parkingId);
		$parkingInfo=toArray($queryParking->find(),array('villageId','user'));
		if(empty($userInfo))
			$returnList=array('userInfo'=>'','parkingInfo'=>$parkingInfo[0]);
		else
			$returnList=array('userInfo'=>$userInfo[0],'parkingInfo'=>$parkingInfo[0]);
		return $returnList;
	}
	function getOld($houseId)
	{
		$year=date('Y');
		$month=date('m');
		if($month[0]=='0')
			$month=$month[1];
		
		$queryUser=new leancloud\AVQuery('_User');
		$queryHouse = new leancloud\AVQuery("House");
		$queryHouse->where('objectId',$houseId);
		$houseInfo=toArray($queryHouse->find(),array('villageId','user'));
		$queryUser->where('objectId',$houseInfo[0]['user']);
		$userInfo = toArray($queryUser->find());
		
		
		
		
		
		$queryHouse=new leancloud\AVQuery('Bill');
		$queryHouse->where('houseId',getPointer('House',$houseId));
		$queryHouse->whereNotEqualTo('month',(int)$month);
		$houseBill=toArray($queryHouse->find(),array('parkingId','houseId'));
		if(empty($userInfo))
			$returnList=array('house'=>$houseBill,'userInfo'=>'');
		else
			$returnList=array('house'=>$houseBill,'userInfo'=>$userInfo[0]);
		return $returnList;
		
	}
	function getOldParking($parkingId)
	{
		$year=date('Y');
		$month=date('m');
		if($month[0]=='0')
			$month=$month[1];
		
		$queryUser=new leancloud\AVQuery('_User');
		$queryParking = new leancloud\AVQuery("Parking");
		$queryParking->where('objectId',$parkingId);
		$parkingInfo=toArray($queryParking->find(),array('villageId','user'));
		$queryUser->where('objectId',$parkingInfo[0]['user']);
		$userInfo = toArray($queryUser->find());
		
		
		
		
		$queryParking=new leancloud\AVQuery('Bill');
		$queryParking->where('parkingId',getPointer('Parking',$parkingId));
		$queryParking->whereNotEqualTo('month',(int)$month);
		$parkingBill=toArray($queryParking->find(),array('parkingId','houseId'));
		
		if(empty($userInfo))
			$returnList=array('parking'=>$parkingBill,'userInfo'=>'');
		else
			$returnList=array('parking'=>$parkingBill,'userInfo'=>$userInfo[0]);
		return $returnList;
	}
}