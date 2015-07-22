<?php
  require_once('../leancloud/AV.php');
	Class adminUserModel{
		public function login($username,$password){
			    $query = new leancloud\AVQuery('adminManager');
        	$query->where('username',$username);
        	$user = (array)$query->find();
        	$user = (array)$user['results'];
        	$user = (array)$user[0];
      		if($user['username']!=""&&$user['password']==$password){
      			session_start();
      			$_SESSION['adminUser'] = $user['username'];
      		}
        }
    }
?>