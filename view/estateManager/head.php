<?php
	require_once('../../config/config.php');
	if(!isset($_COOKIE['estateManager'])){
		header("Location:".__PUBLIC__."/view/estateManager/login.php");
?>