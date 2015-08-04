<?php
	require_once('../model/villageModel.php');
	require_once('../config/config.php');
	session_start();
	if(isset($_GET['method'])){
		$method = $_GET['method'];
		$villageModel = new villageModel();
		
		if($method == 'getAll'){			//获得所有小区信息	
			$villageList = $villageModel->getAll();
			$_SESSION['villageInfoList'] = $villageList;
			header('Location:'.__PUBLIC__.'/view/admin/villageIndex.php');
		}

		else if($method == 'add'){			//添加小区信息
			if(!isset($_POST['villageName'])||!isset($_POST['address'])||!isset($_POST['province'])||!isset($_POST['city'])){
				header('Location:'.__PUBLIC__.'/view/admin/addVillage.php');
			}else{
				$villageName = $_POST['villageName'];
				$address = $_POST['address'];
				$province = $_POST['province'];
				$city = $_POST['city'];
				$villageModel->add($villageName,$address,$province,$city);
				header('Location:'.__PUBLIC__.'/control/villageControl.php?method=getAll');
			}
		
		}

		else if($method == 'getByVillageId'){			//根据小区Id取得小区信息
			
			$villageId = $_GET['id'];
			$villageInfo = $villageModel->getByVillageId($villageId);
			$_SESSION['villageInfo'] = $villageInfo;
			header('Location:'.__PUBLIC__.'/view/admin/lookVillage.php');
		}

		else if($method =='update'){					//修改小区信息
			if(!isset($_POST['villageName'])||!isset($_POST['address'])||!isset($_POST['province'])||!isset($_POST['city'])){
				header('Location:'.__PUBLIC__.'/view/admin/villageUpdate.php');
			}else{
				$villageId = $_GET['id'];
				$villageName = $_POST['villageName'];
				$address = $_POST['address'];
				$province = $_POST['province'];
				$city = $_POST['city'];
				$villageModel->update($villageName,$address,$villageId,$province,$city);
				header('Location:'.__PUBLIC__.'/control/villageControl.php?method=getAll');
			}
		}

		else if($method == 'delete'){ 					//删除小区
			$villageId = $_GET['id'];
			
		}
		else if($method == 'inputHouse'){
			$floorArr = array();
			$unitArr = array();
			$floorsNum = $_POST['floorsNum'];
			$unitsNum = $_POST['unitsNum'];
			$floorNum = $_POST['floorNum'];
			$unitNum = $_POST['unitNum'];
			$building = $_POST['building'];
			for($i=0;$i<$floorNum;$i++){
				array_push($floorArr, $_POST['floor'.($i+1)]);
			}
			for($i=0;$i<$floorsNum;$i+=2){
				for($j=$_POST['floors'.($i+1)];$j<=$_POST['floors'.($i+2)];$j++){
					array_push($floorArr, $j."");
				}
			}
			for($i=0;$i<$unitNum;$i++){
				array_push($unitArr, $_POST['unit'.($i+1)]."");
			}
			for($i=0;$i<$unitsNum;$i+=2){
				for($j=$_POST['units'.($i+1)];$j<=$_POST['units'.($i+2)];$j++){
					array_push($unitArr, $j."");
				}
			}
			$villageModel->addHouse($building,$floorArr,$unitArr,$_GET['id']);
			header("Location:".__PUBLIC__.'/view/estateManager/index.php');
		}
		else if($method == 'getBuilding'){
			$building = "";
			if(isset($_GET['building'])){
				$building = $_GET['building'];
			}
			$floor = "";
			if(isset($_GET['floor'])){
				$floor = $_GET['floor'];
			}
			$unit = "";
			if (isset($_GET['unit'])) {
				$unit = $_GET['unit'];
			}
			$villageId = $_SESSION['estateManager']['villageId'];
			echo json_encode($villageModel->getBuilding($building,$floor,$unit,$villageId));
		}
		else if($method == 'deleteHouse'){
			$id = $_GET['id'];
			$villageModel->deleteHouse($id);
			echo json_encode(array("code"=>200));
		}
		else if($method == 'updateHouse'){
			$id = $_GET['id'];
			$building = $_GET['building'];
			$floor = $_GET['floor'];
			$unit = $_GET['unit'];
			$villageModel->updateHouse($id,$building,$floor,$unit);
			echo json_encode(array("code"=>200));
		}
		else if($method == 'inputParking'){
			$floorArr = array();
			$unitArr = array();
			$floorsNum = $_POST['floorsNum'];
			$unitsNum = $_POST['unitsNum'];
			$floorNum = $_POST['floorNum'];
			$unitNum = $_POST['unitNum'];
			$building = $_POST['building'];
			for($i=0;$i<$floorNum;$i++){
				array_push($floorArr, $_POST['floor'.($i+1)]);
			}
			for($i=0;$i<$floorsNum;$i+=2){
				for($j=$_POST['floors'.($i+1)];$j<=$_POST['floors'.($i+2)];$j++){
					array_push($floorArr, $j."");
				}
			}
			for($i=0;$i<$unitNum;$i++){
				array_push($unitArr, $_POST['unit'.($i+1)]."");
			}
			for($i=0;$i<$unitsNum;$i+=2){
				for($j=$_POST['units'.($i+1)];$j<=$_POST['units'.($i+2)];$j++){
					array_push($unitArr, $j."");
				}
			}
			$villageModel->addParking($building,$floorArr,$unitArr,$_GET['id']);
			header("Location:".__PUBLIC__.'/view/estateManager/index.php');
		}
		else if($method == 'getParking'){
			$building = "";
			if(isset($_GET['building'])){
				$building = $_GET['building'];
			}
			$floor = "";
			if(isset($_GET['floor'])){
				$floor = $_GET['floor'];
			}
			$unit = "";
			if (isset($_GET['unit'])) {
				$unit = $_GET['unit'];
			}
			$villageId = $_SESSION['estateManager']['villageId'];
			echo json_encode($villageModel->getParking($building,$floor,$unit,$villageId));
		}
		else if($method == 'deleteParking'){
			$id = $_GET['id'];
			$villageModel->deleteParking($id);
			echo json_encode(array("code"=>200));
		}
		else if($method == 'updateParking'){
			$id = $_GET['id'];
			$building = $_GET['building'];
			$floor = $_GET['floor'];
			$unit = $_GET['unit'];
			$villageModel->updateParking($id,$building,$floor,$unit);
			echo json_encode(array("code"=>200));
		}
	}
	

?>