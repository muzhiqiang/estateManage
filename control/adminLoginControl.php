<?php
	require_once('../model/adminUserModel.php');
	require_once('../config/config.php');
	if(!isset($_POST["adminName"])||!isset($_POST["adminPassword"])){
		header("Location:".__PUBLIC__."/view/login.php");
	}
	$username = $_POST["adminName"];
	$password = $_POST["adminPassword"];
	$adminUserModel = new adminUserModel();
	$adminUser = $adminUserModel->login($username,$password);
	session_start();
	if(!empty($adminUser)){
		$_SESSION['adminUser'] = $adminUser;

	}
	header("Location:".__PUBLIC__."/view/admin/index.php");
?>