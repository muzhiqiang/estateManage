<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');
	Class villageModel{
		public function getAll(){
			$query = new leancloud\AVQuery('villageInfo');
			$villageList = $query->find();
			$villageList = toArray($villageList);
			return $villageList;
		}
		public function add($villageName,$address){
			$obj = new leancloud\AVObject('villageInfo');
   		 	$obj->villageName = $villageName;
   			$obj->address = $address;
    		$obj->save();

		}
		public function getByVillageId($villageId){
			$query = new leancloud\AVQuery('villageInfo');
			$query->where('objectId',$villageId);
			$villageInfo = $query->find();
			$villageInfo = toArray($villageInfo);
			return $villageInfo[0];
		}
	}

?>