<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');
//查询
	
	$query = new leancloud\AVQuery('_User');
    $query->where('houses',getPointer('House','55bc4c7c00b042e65a5f5582'));
	
    $return = $query->find();
    print_r(json_encode($return));
//删除 将所有已加的houseId去除，但不会改变表House中的数据
/*	$u=new leancloud\AVObject('_User');
	$objectId="55bb693e00b0efdcbe46a502";
	$u->houses=null;
	$return=$u->update("55b8426340ac7c6193061d74");
	print_r($return);
	*/
	
/*	$query= new leancloud\AVQuery('_User');
	
	$query->where("objectId","55b8426340ac7c6193061d74");
	$return = $query->find();
	print_r(json_encode($return));*/
//更新 此方法仅能将原有的全部删除，然后加上我们给与的数据，所以，需要先取出内部所存的数据
/*	$u=new leancloud\AVObject('_User');
	$objectId="55bb693e00b0efdcbe46a502";
	$u->houses=array(getPointer('House',$objectId),getPointer('House',"55bb844300b0efdcbe485231"));
	$return=$u->update("55b8426340ac7c6193061d74");
	print_r($return);*/
/*
//快捷查询方式
$query = new leancloud\AVQuery('_User');
$return = $query->find();
print_r(json_encode($return));*/