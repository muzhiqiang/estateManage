<!DOCTYPE html>
<?php
include 'config/config.php';
require_once('leancloud/AV.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
</head>
<body>
<?php
	$query = new leancloud\AVQuery('villageInfo');
    $query->where('objectId','55ae78fe00b096856ad76b35');
    $return = $query->find();
    print_r($return);
?>
</body>
</html>

