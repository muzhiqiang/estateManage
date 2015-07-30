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
			$returnBill=array('house'=>$returnHouse,'parking'=>$returnParking);
		}
		else
			$returnBill=array('house'=>$returnHouse,'parking'=>'');
		return $returnBill;
	}
}