<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');
	Class villageModel{
		public function getAll(){
			$query = new leancloud\AVQuery('Village');
			$villageList = $query->find();
			$villageList = toArray($villageList);
			return $villageList;
		}
		public function add($villageName,$address,$province,$city){
			$obj = new leancloud\AVObject('Village');
   		 	$obj->name = $villageName;
   		 	$obj->city = $city;
   		 	$obj->province = $province;
   			$obj->address = $address;
    		$obj->save();

		}
		public function getByVillageId($villageId){
			$query = new leancloud\AVQuery('Village');
			$query->where('objectId',$villageId);
			$villageInfo = $query->find();
			$villageInfo = toArray($villageInfo);
			return $villageInfo[0];
		}
		public function update($villageName,$address,$villageId,$province,$city){
			$query = new leancloud\AVQuery('Village');
			$query->where('name',$villageName);
			$villageInfoList = $query->find();
			$villageInfoList = toArray($villageInfoList);
			foreach ($villageInfoList as $key => $value) {
				if($value['province']==$province&&$value['city']==$city&&$value['address'] == $address){
					return false;
				}
			}
			$obj = new leancloud\AVObject('Village');
			$obj->villageName = $villageName;
			$obj->address = $address;
			$obj->province = $province;
			$obj->city = $city;
			$obj->update($villageId);
			return true;
		}
		public function updateWater($fee,$villageId){
			$obj = new leancloud\AVObject('Village');
			$obj->waterPrice = $fee;
			$obj->update($villageId);
			return true;

		}
		public function updatePower($fee,$villageId){
			$obj = new leancloud\AVObject('Village');
			$obj->powerPrice = $fee;
			$obj->update($villageId);
			return true;
		}
	}

?>