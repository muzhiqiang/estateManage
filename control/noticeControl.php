<?php
require_once('../model/noticeModel.php');
require_once('../config/config.php');
if(isset($_GET['method'])){
	$method = $_GET['method'];
	$noticeModel = new noticeModel();
	if($method == 'getAll'){
		$villageId = $_GET['id'];
		$noticList = $noticModel->getAll($villageId);
		session_start();
		$_SESSION['noticeList'] = $noticeList;
		header("Location:".__PUBLIC__."/view/notice/index.php");
	}else if($method='add'){
		$villageId = $_POST['id'];
		$title = $_POST['title'];
		$content = $_POST['content'];
		$noticeModel->add($villageId,$title,$content);

	}
}

?>