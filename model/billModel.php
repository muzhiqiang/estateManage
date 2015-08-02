<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');
class billModel
{
	function getUserBill($userId)
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
		if(!empty($userInfo[0]['parkingId']))
		{
			$query=new leancloud\AVQuery('Bill');
			$query->where('parkingId',getPointer('Parking',$userInfo[0]['parkingId']));
			$returnParking=toArray($query->find(),array('houseId','parkingId'));
			$returnBill=array('house'=>$returnHouse,'parking'=>$returnParking,'userInfo'=>$userInfo);
		}
		else
			$returnBill=array('house'=>$returnHouse,'parking'=>'','userInfo'=>$userInfo);
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
		$queryUser->where('houses',getPointer('House',$houseId));
		$userInfo=toArray($queryUser->find(),array(''));
		
		if(empty($userInfo))
			return array('code'=>'700');
		$queryParking=new leancloud\AVQuery('Parking');
		$queryParking->where('user',getPointer('_User',$userInfo[0]['objectId']));
		$parkingInfo=toArray($queryParking->find(),array('villageId','user'));
		
		$queryHouse=new leancloud\AVQuery('Bill');
		$queryHouse->where('houseId',getPointer('House',$houseId));
		$queryHouse->where('month',(int)$month);
		$queryHouse->where('year',(int)$year);
		$houseBill=toArray($queryHouse->find(),array('parkingId','houseId'));
		
		$parkingBill=array();
		if(!empty($parkingInfo))
		{
			foreach($parkingInfo as $key => $value)
			{
				$queryParking=new leancloud\AVQuery('Bill');
				$queryParking->where('month',(int)$month);
				$queryParking->where('year',(int)$year);
				$queryParking->where('parkingId',getPointer('Parking',$value['objectId']));
				$result=toArray($queryParking->find(),array('parkingId','houseId'));
				if(!empty($result))
				{
					$parkingBill=array_merge($parkingBill,$result);
				}
			}
		}
		$returnList=array('house'=>$houseBill,'parking'=>$parkingBill,'userInfo'=>$userInfo[0]);
		return $returnList;
		
	}
	function search($building,$floor,$unit)
	{
		$query=new leancloud\AVQuery('House');
		if($building!='unset')
			$query->where('building',$building);
		if($floor!='unset')
			$query->where('floor',$floor);
		if($unit!='unset')
			$query->where('unit',$unit);
		$return=toArray($query->find(),array('villageId','user'));
		return $return;
	}
	function getId($houseId)
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
	function getOld($houseId)
	{
		$year=date('Y');
		$month=date('m');
		if($month[0]=='0')
			$month=$month[1];
		
		$queryUser=new leancloud\AVQuery('_User');
		$queryUser->where('houses',getPointer('House',$houseId));
		$userInfo=toArray($queryUser->find(),array(''));
		
		if(empty($userInfo))
			return array('code'=>'700');
		$queryParking=new leancloud\AVQuery('Parking');
		$queryParking->where('user',getPointer('_User',$userInfo[0]['objectId']));
		$parkingInfo=toArray($queryParking->find(),array('villageId','user'));
		
		$queryHouse=new leancloud\AVQuery('Bill');
		$queryHouse->where('houseId',getPointer('House',$houseId));
		$queryHouse->whereNotEqualTo('month',(int)$month);
		$houseBill=toArray($queryHouse->find(),array('parkingId','houseId'));
		
		$parkingBill=array();
		if(!empty($parkingInfo))
		{
			foreach($parkingInfo as $key => $value)
			{
				$queryParking=new leancloud\AVQuery('Bill');
				$queryParking->whereNotEqualTo('month',(int)$month);
				$queryParking->where('parkingId',getPointer('Parking',$value['objectId']));
				$result=toArray($queryParking->find(),array('parkingId','houseId'));
				if(!empty($result))
				{
					$parkingBill=array_merge($parkingBill,$result);
				}
			}
		}
		$returnList=array('house'=>$houseBill,'parking'=>$parkingBill,'userInfo'=>$userInfo[0]);
		return $returnList;
		
	}
}