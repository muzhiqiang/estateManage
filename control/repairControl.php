<?php
require_once('../model/repairModel.php');
require_once('../config/config.php');
session_start();
if(isset($_GET['method'])){
	$repairModel = new repairModel();
	$method = $_GET['method'];
	if($method == 'waitRepair'){
		$villageId = $_GET['id'];
		$waitRepair = $repairModel->getWaitRepair($villageId);
		$_SESSION['waitRepair'] = $waitRepair;
		header("Location:".__PUBLIC__."/view/repair/waitRepair.php");
	}
	else if($method == 'haveRepair'){
		$villageId = $_GET['id'];
		$haveRepair = $repairModel->getHaveRepair($villageId);
		$_SESSION['haveRepair'] = $haveRepair;
		header("Location:".__PUBLIC__."/view/repair/haveRepair.php");
	}
}
?>