<?php
	require_once('../model/adminUserModel.php');
	if(!isset($_POST["adminName"])||!isset($_POST["adminPassword"])){
		header("Location:../view/login.php");
	}
	$username = $_POST["adminName"];
	$password = $_POST["adminPassword"];
	$adminUserModel = new adminUserModel();
	$adminUserModel->login($username,$password);
	header("Location:../view/index.php");
?>