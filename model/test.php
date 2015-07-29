<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');

	$h="55b4a3da00b0bb80c44c4516";
	$p="55b4b47000b0bb80c44cf833";
	$d=date("m");
	if($d[0]=='0')
		$month=$d[1];
	else
		$month=$d;
	$year=date("Y");
	$query_h=new leancloud\AVQuery('Bill');
	$query_h->where('houseId',getPointer('House',$h));
	$billOfhouse=toArray($query_h->find(),array('houseId','parkingId'));
			//如果不存在停车位，则不需要进行停车费用的搜索
	
		$query_p=new leancloud\AVQuery('Bill');
		$query_p->where('parkingId',getPointer('Parking',$p));
		$billOfParking=toArray($query_p->find(),array('parkingId','houseId'));
	
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
	/*print_r($billOfhouse);
	print_r("=================");
	print_r($billOfParking);
	print_r("=================");*/
	
	print_r($return);
	
	echo $month;
	echo $year;
	