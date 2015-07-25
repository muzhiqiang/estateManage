<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');
require_once('../utils/function.php');
Class estateManagerModel{
    /**
    *注册管理员账号
    *
    **/
	public function register($estateName,$estatePassword,$villageId){
        $query = new leancloud\AVQuery('estateManager');
        $query->where('estateName',$estateName);
        $estateManager = $query->find();
        $estateManager = toArray($estateManager);
        if(empty($estateManager)){                      //注册成功
            $obj = new leancloud\AVObject('estateManager');
            $obj->estateName = $estateName;
            $obj->estatePassword = $estatePassword;
            $obj->villageId = getPointer('villageInfo',$villageId);
            $obj->save();
            return true;
        }else{                          //注册失败
            return false;
        }
		
	}
    /**
    *获取所有管理员账号信息
    **/
	public function getAll(){
		$query = new leancloud\AVQuery('estateManager');
        $estateManagerList = $query->find();
        $estateManager = toArray($estateManagerList,array('villageId'));

        return $estateManager;
        // $estateManagerList = (array)
	}
    /**
    *管理员登录处理
    **/
    public function login($username,$password){
        $query = new leancloud\AVQuery('estateManager');
        $query->where('estateName',$username);
        $estateManager = $query->find();
        $estateManager = toArray($estateManager,array('villageId'));
        if(!empty($estateManager)){
            if($estateManager[0]['estatePassword']==$password){
                return $estateManager[0];
            }
        
        }   
        return array();
    }

    /**
    *管理员密码修改
    **/
    public function update($password,$estateManagerId){
        $obj = new leancloud\AVObject('estateManager');
        $obj->estatePassword = $password;
        print_r($obj->update($estateManagerId));
        return true;
    }

    /**
    *删除管理员账号
    **/
    public function delete($estateManagerId){
        $obj = new leancloud\AVObject('estateManager');
        $obj->delete($estateManagerId);
        return true;
    }
}

?>