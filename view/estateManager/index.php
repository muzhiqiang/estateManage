<?php
	session_start();
	if(isset($_SESSION['estateManager'])){
		$estateManager = $_SESSION['estateManager'];
		$villageId = $estateManager['villageId'];

	}else{
		header("Location:login.php");
	}
?>