<?php
require_once('../leancloud/AV.php');
	Class villageModel{
		public function getAll(){
			$query = new leancloud\AVQuery('villageInfo');
			$villageList = (array)$query->find();
			$villageList = $villageList['results'];
			$villageInfo = array();
			foreach ($villageList as $key => $value) {
				$valueArray = (array)$value;
				$villageInfo = array_merge($villageInfo,array($key=>$valueArray));
			}
			return $villageInfo;
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
			$villageInfo = (array)$query->find();
			$villageInfo = $villageInfo['results'];
			if(!empty($villageInfo)){
				$villageInfo = (array)$villageInfo[0];
			}
			return $villageInfo;
		}
	}

?>