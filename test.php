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
	if(isset($_SESSION['estateManager']))
	echo $_SESSION['estateManager'];

?>
</body>
</html>

