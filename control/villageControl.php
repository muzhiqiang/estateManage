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
	}
	

?>