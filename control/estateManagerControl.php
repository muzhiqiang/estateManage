<?php
require_once('../model/estateManagerModel.php');
require_once('../model/villageModel.php');
require_once('../config/config.php');
if(isset($_GET['method'])){
	$method = $_GET['method'];

	$estateManagerModel = new estateManagerModel();
	$villageModel = new villageModel();
	if($method=='getAll'){				//获得所有管理员信息
		$estateManagerList = $estateManagerModel->getAll();
		session_start();
		$_SESSION['estateManagerList']=$estateManagerList;
		header("Location:".__PUBLIC__."/view/admin/estateManagerIndex.php");
	}else if($method=='register'){     //注册管理员账号
		$villageId = $_GET['id'];
		if(!isset($_POST['username'])||!isset($_POST['password'])){
			header("Location:".__PUBLIC__."/view/admin/registerManager.php?id=".$villageId);
		}else{
			$estateName = $_POST['username'];
			$estatePassword = $_POST['password'];
			$estateManagerModel->register($estateName,$estatePassword,$villageId);
			header("Location:".__PUBLIC__."/cotrol/estateManagerControl.php?method=getAll");
		}
		
	}else if($method=='look'){   		//查看管理员所属小区信息
		$villageId = $_GET['id'];
		$villageInfo = $villageModel->getByVillageId($villageId);
		session_start();
		$_SESSION['villageInfo'] = $villageInfo;
		header("Location:".__PUBLIC__."/view/admin/lookVillage.php");
	}else if($method=='login'){			//管理员登录处理
		if(isset($_POST['username'])&&isset($_POST['password'])){
			if($estateManagerModel->login($_POST['username'],$_POST['password'])){
				session_start();
				$villageId = $_SESSION['estateManager']['villageId'];
				$villageInfo = $villageModel->getByVillageId($villageId);
				$_SESSION['villageInfo'] = $villageInfo;
				
			}
		}
		header("Location:".__PUBLIC__."/view/estateManager/index.php");
	}	
}


?>