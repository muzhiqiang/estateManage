<?php
  require_once('../leancloud/AV.php');
  require_once('../utils/message.php');
	Class adminUserModel{
		public function login($username,$password){
          $message = new message();
			    $query = new leancloud\AVQuery('adminManager');
        	$query->where('username',$username);
        	$user = (array)$query->find();
        	$user = $user['results'];
          if(!empty($user)){
            $user = (array)$user[0];
          }else{
            $message->setCode(401);
            
          }
        	
      		if($user['username']!=""&&$user['password']==$password){
      			return $user;
      		}
        }
    }
?>