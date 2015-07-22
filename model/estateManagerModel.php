<?php
require_once('../leancloud/AV.php');
Class estateManagerModel{
    /**
    *注册管理员账号
    *
    **/
	public function register($estateName,$estatePassword,$villageId){
        $query = new leancloud\AVQuery('estateManager');
        $query->where('estateName',$estateName);
        $estateManager = (array)$query->find();
        $estateManager = $estateManager['results'];
        if(empty($estateManager)){                      //注册成功
            $obj = new leancloud\AVObject('estateManager');
            $obj->estateName = $estateName;
            $obj->estatePassword = $estatePassword;
            $obj->villageId = $villageId;
            $obj->save();
        }else{                          //注册失败

        }
		
	}
    /**
    *获取所有管理员账号信息
    **/
	public function getAll(){
		$query = new leancloud\AVQuery('estateManager');
        $estateManagerList = (array)$query->find();
        $estateManagerList = $estateManagerList['results'];
        $estateManager = array();
        foreach ($estateManagerList as $key => $value) {
            $estateManager = array_merge($estateManager,array($key =>(array)$value));
        }
        return $estateManager;
        // $estateManagerList = (array)
	}
    /**
    *管理员登录处理
    **/
    public function login($username,$password){
        $query = new leancloud\AVQuery('estateManager');
        $query->where('estateName',$username);
        $estateManager = (array)$query->find();
        $estateManager = $estateManager['results'];
        if(!empty($estateManager)){
            session_start();
            $_SESSION['estateManager'] = (array)$estateManager[0];
            return true;
        }   
        return false;
    }
}

?>