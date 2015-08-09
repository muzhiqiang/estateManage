<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');
Class uploadFileModel{
	public function upload($fileName,$type,$content,$villageId){
		$file = new leancloud\AVFile($type,$content);
		$result = (array)$file->save($fileName);
		$obj = new leancloud\AVObject("FileToVillage");
		$obj->villageId = getPointer("Village",$villageId);
		$obj->fileId = getPointer("_File",$result['objectId']);
		$obj->save();
	}
	public function getFiles($villageId){
		$query = new leancloud\AVQuery("FileToVillage");
		$query->where("villageId",getPointer("Village",$villageId));
		$fileIds = toArray($query->find(),array("villageId","fileId"));
		$fileList = array();
		foreach ($fileIds as $key => $value) {
			$query = new leancloud\AVQuery("_File");
			$query->where("objectId",$value['fileId']);
			$file = toArray($query->find());
			$fileList = array_merge($fileList,$file);
		}
		return $fileList;
	}
}
?>