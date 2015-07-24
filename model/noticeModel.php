<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');
Class noticeModel{
	public function getAll($villageId){
		$query = new leancloud\AVQuery('Notice');
		$query->where('villageId',$villageId);
		$noticeList = $query->find();
		$noticeList = toArray($noticeList,array('villageId'));
		return $noticeList;
	}
	public function add($villageId,$title,$content){
		$obj = new leancloud\AVObject('Notice');
		$obj->villageId = $villageId;
		$obj->title = $title;
		$obj->content = $content;
		$obj->save();
	}
}
?>