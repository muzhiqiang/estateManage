<?php
require_once('../utils/function.php');
require_once('../leancloud/AV.php');
Class assistantModel{
	public function getAll(){
		$query = new leancloud\AVQuery("Assistant");
		$assistantList = toArray($query->find(),array('villageId'));
		return $assistantList;
	}
	public function register($villageId,$username,$password){
		$obj = new leancloud\AVObject("Assistant");
		$obj->username = $username;
		$obj->password = $password;
		$obj->villageId = getPointer('Village',$villageId);
		$obj->save();
	}
	public function delete($id){
		$obj = new leancloud\AVObject("Assistant");
		$obj->delete($id);
	}
	public function login($username,$password){
		$query = new leancloud\AVQuery("Assistant");
		$query->where("username",$username);
		$query->where("password",$password);
		$assistant = toArray($query->find(),array("villageId"));
		return $assistant;
	}
}
?>