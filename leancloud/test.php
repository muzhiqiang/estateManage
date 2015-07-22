<?php
include_once 'AV.php';
$avUser = new leancloud\AVUser;
$avUser->email = 'killme2008@gmail.com';
$user = $avUser->signup('dennis', 'password');
print_r($user);
?>