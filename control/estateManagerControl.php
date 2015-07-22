<?php
require_once('../model/estateManagerModel.php');
require_once('../model/villageModel.php');
if(isset($_GET['method'])){
	$method = $_GET['method'];

	$estateManagerModel = new estateManagerModel();
	$villageModel = new villageModel();
	if($method=='getAll'){				//获得所有管理员信息
		$estateManagerList = $estateManagerModel->getAll();
		session_start();
		$_SESSION['estateManagerList']=$estateManagerList;
		header("Location:../view/admin/estateManagerIndex.php");
	}else if($method=='register'){     //注册管理员账号
		$villageId = $_GET['id'];
		if(!isset($_POST['username'])||!isset($_POST['password'])){
			header("Location:../../view/admin/registerManager.php?id=".$villageId);
		}else{
			$estateName = $_POST['username'];
			$estatePassword = $_POST['password'];
			$estateManagerModel->register($estateName,$estatePassword,$villageId);
			header("Location:estateManagerControl.php?method=getAll");
		}
		
	}else if($method=='look'){   		//查看管理员所属小区信息
		$villageId = $_GET['id'];
		$villageInfo = $villageModel->getByVillageId($villageId);
		session_start();
		$_SESSION['villageInfo'] = $villageInfo;
		header("Location:../view/admin/lookVillage.php");
	}else if($method=='login'){			//管理员登录处理
		if(isset($_POST['username'])&&isset($_POST['password'])){
			if($estateManager->login($_POST['username'],$_POST['password'])){
				session_start();
				$villageId = $_SESSION['estateManager']['villageId'];
				$villageInfo = $villageModel->getByVillageId($villageId);
				$_SESSION['villageInfo'] = $villageInfo;
				
			}
		}
		header("Location:../view/estateManager/index.php");
	}	
}


?>