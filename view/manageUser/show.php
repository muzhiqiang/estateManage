<?php
function showUserDetail($json)
{
	echo "账号：".$json['userInfo']['username']."</br>";
	echo "姓名：".$json['userInfo']['name']."</br>";
	if($json['userInfo']['gender']==0)
		echo "性别：未知</br>";
	else if($json['userInfo']['gender']==1)
		echo "性别：男</br>";
	else
		echo "性别：女</br>";
	if($json['userInfo']['type']=="tenant")
		echo "用户类型：租户</br>";
	else
		echo "用户类型：房东</br>";
	echo "联系电话：".$json['userInfo']['mobilePhoneNumber']."</br>";
	echo "邮箱地址：".$json['userInfo']['email']."</br>";
	echo "年龄：".$json['userInfo']['age']."</br>";
	echo "职业：".$json['userInfo']['occupation']."</br>";
	echo "婚姻状况：".$json['userInfo']['isMarried']."</br>";
	echo "住址：".$json['houseInfo']['building']."栋".$json['houseInfo']['floor']."层".$json['houseInfo']['unit']."号</br>";
	echo "停车位：";
	if(!empty($json['parkingInfo']))
		echo $json['parkingInfo']['building']."栋".$json['parkingInfo']['floor']."层".$json['parkingInfo']['unit']."</br>";
	else
		echo "</br>";
}

?>