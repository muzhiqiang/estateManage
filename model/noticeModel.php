<?php
require_once('../leancloud/AV.php');
Class noticeModel{
	public function getAll($villageId){
		$query = new leancloud\AVQuery('Notice');
		$query->where('villageId',$villageId);
		$noticeList = (array)$query->find();
		$noticeList = $noticeList['results'];
		$noticeArr = array();
		foreach ($noticeList as $key => $value) {
			$noticeArr = array_merge($noticeArr,array($key=>(array)$value));
		}
		return $noticeArr;
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