<?php
require_once '../model/manageUserModel.php';
require_once(dir(__FILE__).'../config/config.php');
function forUserList()
{
	echo "test";
	$userList=showUserList();
	foreach ($$userList as $key_1 => $userMessage) {
		
		foreach ($userMessage as $key => $value) {
			#
		}
	}
}
if(isset($_GET['getMethod']))
{
	$choice=$_GET['getMethod'];
	switch ($choice) {
		case 'showUserList':
			header("Location:".__PUBLIC__."/view/manageUser/index.php");
			break;
		
		default:
			# code...
			break;
	}
}	