<?php 

function toArray($obj,$point=array()){
	$obj = (array)$obj;
	$obj = $obj['results'];
	$return = array();
	foreach ($obj as $key => $value) {
		$temp = array();
		foreach ((array)$value as $key1 => $value1) {	
			if(in_array($key1, $point)){
				$value1 = (array)$value1;
				$temp = array_merge($temp,array($key1=>$value1['objectId']));
			}else{
				$temp = array_merge($temp,array($key1=>$value1));
			}
		}
		$return = array_merge($return,array($key=>$temp));
	}
	return $return;
}

function getPointer($className,$objectId){
	$pointer = array('__type'=>'Pointer','className'=>$className,'objectId'=>$objectId);
	return $pointer;

}
?>