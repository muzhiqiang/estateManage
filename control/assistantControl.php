<?php
require_once('../config/config.php');
require_once('../model/assistantModel.php');
require_once('../model/manageUserModel.php');
require_once('../model/uploadFileModel.php');
session_start();
if(isset($_GET['method'])){
	$method = $_GET['method'];
	$assistantModel = new assistantModel();
	$manageUserModel = new manageModel();
	$uploadFileModel = new uploadFileModel();
	if($method == 'getAll'){
		$assistantList = $assistantModel->getAll();
		$_SESSION['assistantList'] = $assistantList;
		header("Location:".__PUBLIC__."/view/admin/assistantIndex.php");
	}
	else if($method == 'register'){
		$villageId = $_GET['id'];
		if(isset($_POST['username'])&&isset($_POST['password'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$assistantModel->register($villageId,$username,$password);
			header("Location:".__PUBLIC__."/control/assistantControl.php?method=getAll");
		}else{
			header("Location:".__PUBLIC__."/view/admin/registerAssistant.php?id=".$villageId);
		}
		
	}
	else if($method == 'delete'){
		$id = $_GET['id'];
		$assistantModel->delete($id);
		header("Location:".__PUBLIC__."/control/assistantCOntrol.php?method=getAll");
	}
	else if($method=='login'){					//登陆
		if(isset($_POST['username'])&&isset($_POST['password'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$assistant = $assistantModel->login($username,$password);
			if(!empty($assistant)){
				
				$_SESSION['assistant'] = $assistant[0];
				$_SESSION['aCookie']='201';
				header("Location:".__PUBLIC__."/view/assistant/index.php");
			}
			else
			{
				$_SESSION['aCookie']='301';
				header("Location:".__PUBLIC__."/view/assistant/login.php");
			}
				
		}
	}
	else if($method=='logout'){
		$_SESSION['assistant']=null;
		header("Location:".__PUBLIC__."/view/assistant/login.php");
	}
	else if($method == 'add'){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$name = $_POST['name'];
		$gender = $_POST['gender'];
		$age = $_POST['age'];
		$mobilePhoneNumber = $_POST['mobilePhoneNumber'];
		$type = $_POST['type'];
		$email = $_POST['email'];
		$isMarry = $_POST['isMarried'];
		$occupation = $_POST['occupation'];
		$houseNum = $_POST['houseNum'];
		$parkingNum = $_POST['parkingNum'];
		$houseArr = array();
		$parkingArr = array();
		for ($i=0; $i < $houseNum; $i++) { 
			$houseBuilding = $_POST['houseBuilding'.$i];
			$houseFloor = $_POST['houseFloor'.$i];
			$houseUnit = $_POST['houseUnit'.$i];
			$temp = array("building"=>$houseBuilding,"floor"=>$houseFloor,"unit"=>$houseUnit);
			$houseArr = array_merge($houseArr, array($i=>$temp));
		}
		for ($i=0; $i < $parkingNum; $i++) { 
			$parkingBuilding = $_POST['parkingBuilding'.$i];
			$parkingFloor = $_POST['parkingFloor'.$i];
			$parkingUnit = $_POST['parkingUnit'.$i];
			$temp = array("building"=>$parkingBuilding,"floor"=>$parkingFloor,"unit"=>$parkingUnit);
			$parkingArr = array_merge($parkingArr, array($i=>$temp));
		}
		$code=$manageUserModel->addUser($username,$password,$name,$gender,$age,$mobilePhoneNumber,$type,$email,$isMarry,$occupation,$houseArr,$parkingArr);
		$_SESSION['assCode']=$code;
		header("Location:".__PUBLIC__."/view/assistant/addUser.php");
	}
	else if($method == 'getFiles'){
		$assistant = $_SESSION['assistant'];
		$villageId = $assistant['villageId'];
		$fileList = $uploadFileModel->getFiles($villageId);
		$_SESSION['fileList']= $fileList;
		header("Location:".__PUBLIC__."/view/assistant/fileList.php");
	}
	else if($method=='showUserInfo')
	{
		echo json_encode($assistantModel->showUserList($_GET['villageId']));
	}
	else if($method='deleteUser')
	{
		$assistantModel->deleteUser($_GET['userId']);
		header("Location:".__PUBLIC__."/view/assistant/userList.php");
	}
}
?>
