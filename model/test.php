<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');

        $obj = new leancloud\AVObject("_User");
       /*$obj->username = $username;
        $obj->password = $password;
        $obj->name = $name;
        $obj->gender = $gender;
        $obj->age = $age;
        $obj->mobilePhoneNumber = $mobilePhoneNumber;
        $obj->type = $type;
        $obj->email = $email;
        $obj->isMarried = $isMarry;
        $obj->occupation = $occupation;
        $obj->isConfirm = true;*/
        $obj->username ='15626470210';
        $obj->email = "ddd@163.com";
        $obj->password='ddddd';
        $obj->mobilePhoneNumber ='555';
        try
        {
            $result = (array)$obj->save();
        }
        catch(Exception $e)
        {
            if($e=="AVOSCloud.com error: The mobile phone number was invalid. It must be a string,numbers and '-' are the only valid characters.")
                echo ' 此电子邮箱已经被占用。';
            //echo $e;
        }
       
        //print_r($result);