<?php
	require_once('../../config/config.php');
	if(!isset($_COOKIE["adminUser"])){
		header("Location:".__PUBLIC__."/view/admin/login.php");
	}
?>