<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');
session_start();

function showUserList()
{
	$tempId="55ae78fe00b096856ad76b35";
	/*$query_x=new leancloud\AVQuery('House');
	$query_y=new leancloud\AVQuery('House');
	//$query->where('objectId',$tempId);
	$query_x->where('villageId',getPointer('villageInfo',$tempId));
	$query_y->where('building','12');
	$result_1=$query_x->find();
	$result_2=$query_y->find();

	print_r(toArray($result_1,array('villageId')));
	echo "</br>";
	print_r($result_2);*/
	$query=new leancloud\AVQuery('House');
	$query->where('villageId',getPointer('villageInfo',$tempId));
	$result=toArray($query->find(),array('villageId'));
	//print_r($result);
	$HouseId=array();
	foreach ($result as $key => $value) {
		$HouseId[$key]=$value['objectId'];
	}
	print_r($HouseId);
	print_r("=====================================");
	$userList=array();
	$query=new leancloud\AVQuery('_User');
	foreach ($HouseId as $key => $value) {
		echo $value;
		$query->where('houseId',getPointer('House',$value));
		$result=toArray($query->find(),array('houseId','parkingId'));
		print_r($result);
		print_r("=====================================");
	}
}
showUserList();