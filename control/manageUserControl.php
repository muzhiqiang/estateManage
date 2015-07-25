<?php
require_once '../model/manageUserModel.php';
require_once('../config/config.php');

function forUserList()
{
 $userList=showUserList();
 /*$json=array();
 foreach ($userList as $key => $value) {
  if(isset($value['ifConfirm']))
   $temp="1";
  else
   $temp="2";
  $json[$key]=array('email'=>$value['email'],'mobilePhoneVerified'=>$value['mobilePhoneVerified'],'username' =>$value['username'] ,'createdAt'=>$value['createdAt'],'gender'=>$value['gender'],'age'=>$value['age'],'isMarried'=>$value['isMarried'],'name'=>$value['name'],'occupation'=>$value['occupation'],'type'=>$value['type'],'houseId'=>$value['houseId'],'parkingId'=>$value['parkingId'],'ifConfirm'=>$temp);
  
 }*/
 echo json_encode($userList);

}
if(isset($_GET['getMethod']))
{
	$choice=$_GET['getMethod'];
	switch ($choice) {
		case 'showUserList':
			header("Location:".__PUBLIC__."/view/manageUser/index.php");
			break;
		case 'getInformation':
			forUserList();
			break;
		default:
			# code...
			break;
	}
}	