<?php
	require_once('../../config/config.php');
	session_start();
	if(!isset($_SESSION['estateManager'])){
		header("Location:".__PUBLIC__."/view/estateManager/login.php");
	}
?>