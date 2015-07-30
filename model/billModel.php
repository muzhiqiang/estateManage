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
}